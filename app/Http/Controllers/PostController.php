<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get('http://localhost:1234/api/posts');

        if($response->status() == 200){
            $result = $response->json();
            $posts = $result['posts'];
            return view('post',compact('posts'));
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post('http://localhost:1234/api/posts', [
            'title' => $request->title,
            'content' => $request->content
        ]);

        if($response->status() == 200){
            return redirect('/posts');
        }
        else{
            return redirect()->back();
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("http://localhost:1234/api/posts/{$id}");

        $result     = $response->json();
        $post       = $result['post'];
        $comments   = $result['comments'];
        $hasLiked   = $result['hasLiked'];
        $totalLikes  = $result['totalLikes'];

        return view('post_content', compact('post', 'comments', 'hasLiked', 'totalLikes'));
        
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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("http://localhost:1234/api/posts/{$id}");

        $result = $response->json();
        $post = $result['post'];

        return view('post_edit', compact('post'));
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
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("http://localhost:1234/api/posts/{$id}/update", [
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if($response->status() == 200){
            return redirect('/posts');
        }

        return redirect()->back();

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

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("http://localhost:1234/api/posts/{$id}/comment", [
            'content'     => $request->comment
        ]);

        return redirect()->back();

    }

    public function like($id){
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("http://localhost:1234/api/posts/{$id}/like");
        return redirect()->back();
    }
}
