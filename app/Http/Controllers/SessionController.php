<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest', ['except' => 'destroy']);
  }


  public function create()
  {
    return view('sessions.create');
  }

  public function store()
  {
  	//dd(request(['email', 'password']));
    //attempt to authenticate the user.
    if (! auth()->attempt(request(['email', 'password']))) {
      //If not, redirect back.
		  //dd(request(['email', 'password']));
      return back()->withErrors([
        'message' => 'Please check your credentials and try again.'
      ]);
    }

    //If so, sigh them in.

    //Redirect to the home page.
    return redirect()->home();

  }

  public function destroy()
  {
    auth()->logout();
    return redirect()->home();
  }

}
