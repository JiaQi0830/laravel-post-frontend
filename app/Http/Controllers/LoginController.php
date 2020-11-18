<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    //
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $api_url = config('app.api');
        if(session('token')){
            $token = session('token');

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$token
                ])->post("{$api_url}/login", [
                    'email' => $request->email,
                    'password' => $request->password,
                ]);
        }else{
            $response = Http::post("{$api_url}/login", [
                'email' => $request->email,
                'password' => $request->password,
            ]);
        }

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

        if($response->status() == 200){
            $request->session()->put('token', $response['data']['token']);
            $request->session()->put('role', $response['data']['role']);
            return redirect('/posts')->with(['message' =>  $message]);;
        }
        else{
            return back()->with(['message' =>  $message]);
        }
    }

    public function logout(Request $request){
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
            ])->get("{$api_url}/logout");
        
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

        $request->session()->flush();
        
        return redirect('/posts')->with(['message' =>  $message]);
    }
}
