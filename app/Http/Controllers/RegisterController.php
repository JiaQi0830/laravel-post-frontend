<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    //
    public function index(){
        return view('register');
    }

    public function register(Request $request){

        $response = Http::post("http://localhost:1234/api/register", [
            'email'     => $request->email,
            'password'  => $request->password,
            'name'      => $request->name
        ]);
        if( $response->status() == 200 ){
            return redirect('login');
        }

        return redirect()->back();

    }
}
