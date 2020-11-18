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

        $api_url = config('app.api');

        $response = Http::post("{$api_url}/register", [
            'email'     => $request->email,
            'password'  => $request->password,
            'password_confirmation'  => $request->password_confirmation,
            'name'      => $request->name
        ]);
        
        $message = '';
        if($response->json()){
            if(isset($response->json()['error'])){
                foreach($response->json()['error'] as $item){
                    foreach($item as $error_msg){
                        $message .= "{$error_msg}\n";
                    }
                }
            }else{
                $message = $response->json()['message'];
            }
        }

        if( $response->status() == 200 ){
            return redirect('login')->with(['message' =>  $message]);
        }

        return redirect()->back()->with(['message' =>  $message]);

    }
}
