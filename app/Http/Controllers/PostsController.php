<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth", "verified"])->except(["index", "show"]);
        $this->page = 16;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::latest()->where("deleted", false)->paginate($this->page)->appends(request()->query());
        return view("posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = $request->validate([
            "pros_title" => "required|max:32",
            "pros_desc" => "required",
            "cons_title" => "required|max:32",
            "cons_desc" => "required",
            'pros_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'cons_image' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $pros_image = $request->file("pros_image");
        $pros_image_path = "";
        if (isset($pros_image)) {
            $pros_image_path = "images/" . Str::uuid() . "." . $pros_image->extension();
            Storage::disk("s3")->put($pros_image_path, file_get_contents($pros_image), "public");
        }

        $cons_image = $request->file("cons_image");
        $cons_image_path = "";
        if (isset($cons_image)) {
            $cons_image_path = "images/" . Str::uuid() . "." . $cons_image->extension();
            Storage::disk("s3")->put($cons_image_path, file_get_contents($cons_image), "public");
        }

        $post = new Post([
            "pros_title" => $value["pros_title"],
            "pros_desc" => $value["pros_desc"],
            "cons_title" => $value["cons_title"],
            "cons_desc" => $value["cons_desc"],
            "pros_image" => $pros_image_path,
            "cons_image" => $cons_image_path,
            "user_id" => auth()->user()->id
        ]);

        $post->save();

        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::find($id);

        if (!$post || $post->deleted) {
            return back()->withErrors(["삭제된 게시글입니다."]);
        } else {
            return view("posts.show", compact("post"));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $id)
    {
        //
        $post = Post::find($id);
        if (auth()->user()->id !== $post->user_id) {
            return back()->withErrors(["잘못된 접근입니다."]);
        } else {
            return view("posts.edit", compact("post"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::find($id);
        $value = $request->validate([
            "pros_title" => "required|max:32",
            "pros_desc" => "required",
            "cons_title" => "required|max:32",
            "cons_desc" => "required",
        ]);

        $pros_image = $request->file("pros_image");
        $pros_image_path = "";
        if (isset($pros_image)) {
            if (strlen($post->pros_image)) {
                // $post->pros_image needs to be removed
                Storage::disk("s3")->delete($post->pros_image);
            }
            $pros_image_path = "images/" . Str::uuid() . "." . $pros_image->extension();
            Storage::disk("s3")->put($pros_image_path, file_get_contents($pros_image), "public");

            $post->update([
                "pros_image" => $pros_image_path
            ]);
        }

        $cons_image = $request->file("cons_image");
        $cons_image_path = "";
        if (isset($cons_image)) {
            if (strlen($post->cons_image)) {
                // $post->cons_image needs to be removed
                Storage::disk("s3")->delete($post->cons_image);
            }
            $cons_image_path = "images/" . Str::uuid() . "." . $cons_image->extension();
            Storage::disk("s3")->put($cons_image_path, file_get_contents($cons_image), "public");

            $post->update([
                "cons_image" => $cons_image_path
            ]);
        }

        $post->update([
            "pros_title" => $value["pros_title"],
            "pros_desc" => $value["pros_desc"],
            "cons_title" => $value["cons_title"],
            "cons_desc" => $value["cons_desc"]
        ]);


        $post->save();

        return redirect()->route("posts.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        if (strlen($post->pros_image)) {
            Storage::disk("s3")->delete($post->pros_image);
        }
        if (strlen($post->cons_image)) {
            Storage::disk("s3")->delete($post->cons_image);
        }

        if ($post->user_id !== auth()->user()->id) {
            return back()->withErrors(["잘못된 접근입니다."]);
        } else {
            $post->update([
                "deleted" => true
            ]);
            $post->save();
            return redirect()->route("posts.index");
        }
    }

    public function search(Request $request)
    {
        # code...
        $keyword = $request->input("search");
        $posts = Post::query()->where("deleted", "=", false)->where(
            function ($query) use ($keyword) {
                $query->where(
                    "pros_title",
                    "LIKE",
                    "%{$keyword}%"
                )->orWhere(
                    "cons_title",
                    "LIKE",
                    "%{$keyword}%"
                );
            }
        )->latest()->paginate($this->page)->appends(request()->query());
        // dd($posts);
        return view("posts.index", compact("posts"));
    }
}
