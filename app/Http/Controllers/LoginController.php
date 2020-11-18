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

        if(session('token')){
            $token = session('token');
            $api_url = config('app.api');

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


        if($response->status() == 200){
            $request->session()->put('token', $response['token']);
            $request->session()->put('role', $response['role']);
            return redirect('/posts');
        }
        else{
            return back();
        }
    }

    public function logout(Request $request){
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
            ])->get("{$api_url}/logout");
        $request->session()->flush();

        return redirect('/');
    }
}
