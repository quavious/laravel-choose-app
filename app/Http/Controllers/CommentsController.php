<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $value = $request->validate([
            "content" => "required"
        ]);
        $comment = new Comment([
            "post_id" => $id,
            "user_id" => auth()->user()->id,
            "content" => $value["content"]
        ]);
        try {
            $comment->save();
            return redirect()->route("posts.show", $id);
        } catch (\Throwable $th) {
            dd($th);
            $error_message = "작성 중 오류가 발생했습니다.";
            return back()->withErrors([$error_message]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, $id)
    {
        //
        $comment = Comment::find($id);
        $flag = $comment->user_id === auth()->user()->id;

        if ($flag) {
            $comment->update([
                "deleted" => true
            ]);
            $comment->save();
        }
        return redirect()->route("posts.show", $comment->post_id);
    }
}
