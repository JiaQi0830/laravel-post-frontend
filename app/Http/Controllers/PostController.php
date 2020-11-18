<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //
        $currentPage = 1;
        if($request->page){
            $currentPage = $request->page;
        }
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts?page={$currentPage}");
        
        if($response->status() == 200){
            $result = $response->json();
            $paginator = $result['data']['posts'];
            $posts = $result['data']['posts']['data'];
            return view('post',compact('posts', 'currentPage', 'paginator'));
        }

        return redirect('/login');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd(session('token'));
        return view('post_register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("{$api_url}/posts", [
            'title' => $request->title,
            'content' => $request->content
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

        if($response->status() == 200){
            return redirect('/posts')->with(['message' =>  $message]);
        }
        else{
            return redirect()->back()->with(['message' =>  $message]);;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts/{$id}");

        if($response->status() == 200){
            $result     = $response->json()['data'];
            $post       = $result['post'];
            $comments   = $result['comments'];
            $hasLiked   = $result['hasLiked'];
            $totalLikes  = $result['totalLikes'];

            return view('post_content', compact('post', 'comments', 'hasLiked', 'totalLikes'));
        }
        
        return redirect('/posts');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $token = session('token');
        $api_url = config('app.api');

        if(session('role') != 2){
            return back();
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts/{$id}");

        if($response->status() == 200){
            $result = $response->json()['data'];
            $post = $result['post'];

            return view('post_edit', compact('post'));
        }

        return redirect('/posts');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("{$api_url}/posts/{$id}/update", [
            'title'     => $request->title,
            'content'   => $request->content
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

        if($response->status() == 200){
            return redirect("/posts/{$id}")->with(['message' =>  $message]);;
        }

        return redirect('/posts')->with(['message' =>  $message]);;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function comment(Request $request, $id){
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("{$api_url}/posts/{$id}/comment", [
            'content'     => $request->comment
        ]);

        if($response->status() == 200) {
            return redirect()->back();
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

        return redirect()->back()->with(['message' =>  $message]);

    }

    public function like($id){
        $token = session('token');
        $api_url = config('app.api');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts/{$id}/like");

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

        if($response->status() == 200 ){
            return redirect()->back();    
        }
        return redirect()->back()->with(['message' =>  $message]);
    }
}
