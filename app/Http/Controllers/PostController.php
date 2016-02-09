<?php

namespace App\Http\Controllers;

use Log;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('post_date', 'desc')->
            orderBy('created_at', 'desc')->get(
              array('id', 'post_title', 'post_date', 'post_content',
                'post_author', 'created_at'));
        return Response::json(array(
            'posts' => $posts
        ), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(Input::all(), [
            'post_title' => 'required|min:2|max:50',
            'post_content' => 'required|min:2|max:1024',
            'post_date' => 'required',
            'post_author' => 'required',
        ]);

        if ($validator->fails()) {
          return Response::json(array('errors' => $validator->messages()), 400);
        }

        $post = new Post;
        $post->post_title = Input::get('post_title');
        $post->post_content = Input::get('post_content');
        $post->post_date = Input::get('post_date');
        $post->post_author = Input::get('post_author');
        $post->post_status = 'draft';
        $saved = $post->save();

        if(!$saved) {
            abort(502, 'Please try again');
        }

        return Response::json(array(
            'msg' => 'Success'
        ), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id, array('id', 'post_title', 'post_date',
            'post_content', 'post_author', 'created_at'));
        return Response::json($post, 200);
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
        //
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
}
