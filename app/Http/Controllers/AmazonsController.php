<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;

class AmazonsController extends Controller
{
  public function index()
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
		$params = array(
		    "Service" => "AWSECommerceService",
		    "Operation" => "ItemSearch",
		    "AWSAccessKeyId" => decrypt($amazon_key),
		    "AssociateTag" => "starfish860-22",
		    "SearchIndex" => "VideoGames",
		    "Keywords" => "ゲーム ソフト",
		    "ResponseGroup" => "Images,ItemAttributes,Offers",
		    "Sort" => "salesrank"
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
		//return view('amzs.index', compact('res'));
		return view('layouts.sidebar_left', compact('res'));
	}

  public function search()
  {
	}

}
