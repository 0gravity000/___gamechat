<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Apikey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AmazonGameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($Page)
    {
       $this->page = $Page;
       //$this->min = $Min;
       //$this->max = $Max;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $apikey = Apikey::where('user_id', '1')->first();
      $amazon_key = $apikey->amazon_key;
      $amazon_secret = $apikey->amazon_secret;
          // Your Access Key ID, as taken from the Your Account page
      $access_key_id = decrypt($amazon_key);
          // Your Secret Key corresponding to the above ID, as taken from the Your Account page
      $secret_key = decrypt($amazon_secret);;
          // The region you are interested in
      $endpoint = "webservices.amazon.co.jp";
      $uri = "/onca/xml";

    //1度に取得できるのは10個なので、以降はページを指定して、繰り返す。
    //max100ページとする
    //for ($page=$this->min; $page < $this->max; $page++) {
      //sleep(15);
      //ｰｰｰ
      $params = array(
        "Service" => "AWSECommerceService",
        "Operation" => "ItemSearch",
        "AWSAccessKeyId" => decrypt($amazon_key),
        "AssociateTag" => "starfish860-22",
        "SearchIndex" => "VideoGames",
        "Keywords" => "ゲーム ソフト",
        "ResponseGroup" => "Images,ItemAttributes",
        "Sort" => "salesrank",
        "ItemPage" => $this->page,
      );
      // Set current timestamp if not set
      if (!isset($params["Timestamp"])) {
        $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
      }

      // Sort the parameters by key
      ksort($params);
      $pairs = array();
      foreach ($params as $key => $value) {
        array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
      }
      // Generate the canonical query
      $canonical_query_string = join("&", $pairs);
      // Generate the string to be signed
      $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
      // Generate the signature required by the Product Advertising API
      $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));
      // Generate the signed URL
      $request_url = 'https://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
      //echo "Signed URL: \"".$request_url."\"";
      $res = simplexml_load_string(file_get_contents($request_url));
      //$res = file_get_contents($request_url);
      //dd($res);

      $games = [];
      if($res != null) {
        foreach($res->Items->Item as $item) {
          if (!empty($item->DetailPageURL)) {
            $params = array(
              "title" => $item->ItemAttributes->Title->__toString(),
              //"detailPageURL" => $item->DetailPageURL->__toString(),
            );
            array_push($games, $params);
          } else {
            //No URL
          }
        }
      }

    //} //loopend

    $games = array_values(array_sort($games, function ($value) {
      return $value['title'];
    }));

    //dd($games);
    //$outputfile = 'gameslist.txt';
    $dt = Carbon::now();
    $folder = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).'/';
    $file = 'outputpage_'.$this->page.'.txt';
        //$storagePath = storage_path('app/public/games/'. $outputfile);
    $storagePath = ('/public/games/');
    $storagePathName = $storagePath. $folder. $file;

    $fileOutputString = "";
    for ($i=0; $i < count($games); $i++) { 
      $fileOutputString = $fileOutputString . array_get($games[$i],'title') .','. array_get($games[$i],'detailPageURL') .'\n';
    }
    Storage::put($storagePathName, $fileOutputString);
    echo $this->page. 'feach done!';
    /*
    $games = array_values(array_sort($games, function ($value) {
      return $value['title'];
    }));
    */
  }
}
