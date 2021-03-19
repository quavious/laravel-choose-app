<?php

namespace App\Http\Controllers;

use App\Models\Inquire;
use Illuminate\Http\Request;

class InquiresController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->page = 20;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $inquires = Inquire::latest()->paginate($this->page)->appends(request()->query());
        if (!auth()->user()) {
            return redirect()->route("posts.index");
        }

        $flag = auth()->user()->id === 1;
        if ($flag) {
            $inquires = Inquire::latest()->paginate($this->page)->appends(request()->query());
            return view("inquires.index", compact("inquires"));
        } else {
            $inquires = Inquire::latest()->where("user_id", "=", auth()->user()->id)->paginate($this->page)->appends(request()->query());
            return view("inquires.index", compact("inquires"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("inquires.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $value = $request->validate([
            "title" => "required|max:32",
            "desc" => "required",
        ]);

        $inquire = new Inquire([
            "title" => $value["title"],
            "desc" => $value["desc"],
            "ref_link" => !$request->ref_link ? "" : $request->ref_link,
            "user_id" => auth()->user()->id,
        ]);
        $inquire->save();
        return redirect()->route("inquires.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquire  $inquire
     * @return \Illuminate\Http\Response
     */
    public function show(Inquire $inquire, $id)
    {
        $inquire = Inquire::find($id);
        if (auth()->user()->id !== 1 && $inquire->user_id !== auth()->user()->id) {
            return back()->withErrors(["잘못된 접근입니다."]);
        }
        return view("inquires.show", compact("inquire"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquire  $inquire
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquire $inquire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquire  $inquire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquire $inquire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquire  $inquire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquire $inquire)
    {
        //
    }

    public function check($id)
    {
        if (auth()->user()->id !== 1) {
            return redirect()->route("inquires.index");
        }
        $inquire = Inquire::find($id);
        $inquire->update([
            "checked" => true,
        ]);
        $inquire->save();
        return redirect()->route("inquires.index");
    }

    public function search(Request $request)
    {
        $keyword = $request->input("search");
        $inquires = Inquire::query()->where("user_id", "=", auth()->user()->id)->latest()->paginate($this->page)->appends(request()->query());
        // dd($posts);
        return view("posts.index", compact("inquires"));
    }
}
