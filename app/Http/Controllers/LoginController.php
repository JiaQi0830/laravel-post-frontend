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

        $response = Http::post("http://localhost:1234/api/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        if($response->status() == 200){
            $request->session()->put('token', $response['token']);
            $request->session()->put('role', $response['role']);
            return redirect('/posts');
        }
        else{
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
            ])->get('http://localhost:1234/api/logout');
        $request->session()->flush();

        return redirect('/');
    }
}
