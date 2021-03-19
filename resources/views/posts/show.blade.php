@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="font-weight-bold">{{
        $post->pros_title . " VS " . $post->cons_title
    }}</h4>
    <h5><span class="badge badge-warning">✍ {{$post->user->name}}</span></h5>
    <div class="d-flex flex-column my-2">
        <span>{{$post->created_at}}에 작성되었습니다.</span>
        @if ($post->created_at !== $post->updated_at)
        <span class="mx-2">👉 {{$post->created_at}}에 업데이트되었습니다.</span>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-6 my-2">
            <div class="py-2 px-3 border border-danger">
                <h3 class="text-center font-weight-bold">{{$post->pros_title}}</h3>
                @if(strlen($post->pros_image))<img src="{{"https://laravel-choose-app-images.s3.ap-northeast-2.amazonaws.com/".$post->pros_image}}" alt={{"pros_image".$post->id}} class="w-100">@endif
                <p>{{$post->pros_desc}}</p>
                <form action="{{route("posts.like", $post->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="choose" value=true />
                    <button type="submit" class="btn btn-danger">🤚 {{$post->likes->where("choose", true)->count()}}</button>
                </form>
            </div>
        </div>
        <div class="col-lg-6 my-2">
            <div class="py-2 px-3 border border-primary">
                <h3 class="text-center font-weight-bold">{{$post->cons_title}}</h3>
                @if (strlen($post->cons_image)) <img src="{{"https://laravel-choose-app-images.s3.ap-northeast-2.amazonaws.com/".$post->cons_image}}" alt="{{"pros_image".$post->id}}" class="w-100" /> @endif
                <p>{{$post->cons_desc}}</p>
                <form action="{{route("posts.like", $post->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="choose" value=false />
                    <button type="submit" class="btn btn-primary">✋ {{$post->likes->where("choose", false)->count()}}</button>
                </form>
            </div>
        </div>
    </div>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <p class="text-white bg-danger px-4 py-2 rounded mt-4">{{$error}}</p>
    @endforeach
    @endif
    @if (auth()->user() && auth()->user()->email_verified_at)
    <div class="my-4 d-flex">
        <a href="{{route("posts.edit", $post->id)}}" class="btn btn-dark">글 수정</a>
        <form action="{{route("posts.delete", $post->id)}}" method="post">
            @csrf
            <button class="btn btn-dark mx-2">글 삭제</button>
        </form>
    </div>
    <form action="{{route("comments.store", $post->id)}}" method="post">
        @csrf
        <label for="content"><strong>댓글</strong></label>
        <textarea name="content" id="content" cols="30" rows="3" class="form-control my-2"></textarea>
        <button type="submit" class="btn btn-outline-primary">작성하기</button> 
    </form>
    @endif
    <br />
    <script>
        new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"115"});
    </script>
    @foreach ($post->comments->sortBy("id") as $comment)
    <div class="mt-2 px-4 py-2 border-bottom bg-white rounded shadow shadow-md">
        <strong>{{$comment->user->name}}</strong>
        @if ($comment->deleted)
        <p>삭제된 댓글입니다.</p>
        @else
        <p>{{$comment->content}}</p>
        @endif
        <span class="text-muted">{{$comment->created_at}}에 작성됨</span>
        @auth
        @if ($comment->user_id === auth()->user()->id && !$comment->deleted)
        <form action="{{route("comments.delete", $comment->id)}}" method="post">
            @csrf
            <button type="submit" class="badge badge-danger">삭제</button>
        </form>
        @endif
        @endauth
    </div>
    @endforeach
</div>
@endsection