@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-secondary px-3 py-2">
        <h3 class="font-weight-bold text-dark">건의/요청사항</h3>
        <p class="text-secondary">웹 사이트에 건의하고 싶은게 있거나, 문제되는 것이 있다면 알려주세요.</p>
    </div>
    <div>
        @foreach ($inquires as $inquire)
        <div class="bg-white px-4 py-2 my-2 d-flex align-items-center">
            <h6 class="my-0 mx-2">{{$inquire->id}}</h6>
            <a class="mx-2" href="{{route("inquires.show", $inquire->id)}}"><strong>{{$inquire->title}}</strong></a>
            <h6 class="my-0 mr-2 badge badge-primary">{{$inquire->user->name}}</h6>
            @if ($inquire->checked)
            <span class="rounded bg-primary p-1">✅</span>    
            @else
            <span class="rounded bg-danger p-1">🚫</span>    
            @endif
        </div>
        @endforeach
    </div>
    <script>
        new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"115"});
    </script>
    <div class="d-flex align-items-center mt-2">
        <a class="btn btn-outline-danger font-weight-bold text-nowrap" href="{{route("inquires.create")}}">📝 글 작성</a>
        <form action="{{route("inquires.search")}}" method="GET" enctype="multipart/form-data" class="mx-2 my-0 d-flex align-items-center">
            <div class="form-group d-flex align-items-center m-0">
                <input type="text" class="form-control" name="search" id="search" placeholder="검색어를 입력하세요.">
            </div>
            <div class="form-group m-0">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </form>
    </div>
    <div class="mt-4">{{ $inquires->appends(request()->query())->links() }}</div>
</div>
@endsection
