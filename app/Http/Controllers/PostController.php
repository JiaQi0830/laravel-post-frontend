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
        // dd($request->all());
        // dd(session('role'));
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
            $paginator = $result['posts'];
            $posts = $result['posts']['data'];
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
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts/{$id}");
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
        $api_url = config('app.api');

        if(session('role') != 2){
            return back();
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts/{$id}");

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
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("{$api_url}/posts/{$id}/update", [
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
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->post("{$api_url}/posts/{$id}/comment", [
            'content'     => $request->comment
        ]);

        return redirect()->back();

    }

    public function like($id){
        $token = session('token');
        $api_url = config('app.api');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->get("{$api_url}/posts/{$id}/like");
        return redirect()->back();
    }
}
