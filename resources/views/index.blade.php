@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-4 px-4 mx-auto jumbotron">
        <h3>Yes or No</h3>
        <hr class="w-100 px-2"/>
        <p>인생은 삶과 죽음 사이 선택이라고 합니다. 여기서 여러가지 선택을 해보세요.</p>
        <div class="d-flex align-items-center">
            <a class="btn btn-primary mr-2 font-weight-bold" href="{{route("posts.index")}}">글 목록</a>
            <a class="btn btn-success font-weight-bold" href="{{route("posts.create")}}">글 쓰기</a>
        </div>
    </div>
    @auth
    @if(!auth()->user()->email_verified_at)
    <p class="bg-danger p-3 text-white">이메일이 확인되면 글을 작성할 수 있습니다.</p>
    @endif
    @endauth
    <div>
        @foreach ($posts as $post)
        @if ($loop->index === 3)
        <script>
            new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"115"});
        </script>
        @endif
        <div class="bg-white px-4 py-2 my-2">
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
</div>
@endsection