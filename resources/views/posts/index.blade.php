@extends('layouts.app')

@section('content')
<div class="container">
    @if(!auth()->user()) 
    <div class="d-flex bg-dark mb-4">
        <p class="px-4 py-2 text-white m-0 font-weight-bold">글을 작성하고 싶으면 로그인하세요.</p>
    </div>
    @endif

    <div>
        @foreach ($posts as $post)
        <div class="bg-white px-4 py-2 my-2 border-bottom border-right">
            <a href="{{route("posts.show", $post->id)}}"><strong>{{$post->id}}. {{$post->pros_title . " VS " . $post->cons_title}}</strong></a>
            <p class="pros-color my-1">{{\Illuminate\Support\Str::limit($post->pros_desc, $limit = 80, $end = "...")}}</p>
            <p class="cons-color my-1">{{\Illuminate\Support\Str::limit($post->cons_desc, $limit = 80, $end = "...")}}</p>
            <div class="d-flex">
                <span class="badge badge-danger">{{$post->likes->where("choose", true)->count()}}</span>
                <span class="badge badge-primary mx-2">{{$post->likes->where("choose", false)->count()}}</span>
            </div>
        </div>
        @endforeach
    </div>
    <script>
        new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"115"});
    </script>
    <div class="d-flex align-items-center mt-2">
        @if (auth()->user())
        <a class="btn btn-outline-danger font-weight-bold text-nowrap mr-2" href="{{route("posts.create")}}">📝 글 작성</a>
        @endif
        <form action="{{route("posts.search")}}" method="GET" enctype="multipart/form-data" class="my-0 d-flex align-items-center">
            <div class="form-group d-flex align-items-center m-0">
                <input type="text" class="form-control" name="search" id="search" placeholder="검색어를 입력하세요.">
            </div>
            <div class="form-group m-0">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </form>
    </div>
    <div class="mt-4">{{ $posts->appends(request()->query())->links() }}</div>
</div>
@endsection
