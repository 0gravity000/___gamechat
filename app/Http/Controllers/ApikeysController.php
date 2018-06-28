<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apikey;

class ApikeysController extends Controller
{
    public function create()
    {
      return view('apikeys.create');
    }

    public function store()
    {
      //Validate the form
      $this->Validate(request(),[
        'google_key' => 'required',
        'amazon_key' => 'required',
        'amazon_secret' => 'required',
      ]);

      //Create and save the user.
      $key = Apikey::create([
      	'user_id' => '1',
        'google_key' => encrypt(request('google_key')),
        'amazon_key' => encrypt(request('amazon_key')),
        'amazon_secret' => encrypt(request('amazon_secret')),
    	]);

      //redirect to the home page.
      return redirect()->home();
    }    
}
