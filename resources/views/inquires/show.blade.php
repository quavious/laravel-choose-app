@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <p class="text-white bg-danger px-4 py-2 rounded mt-4">{{$error}}</p>
    @endforeach
    @endif
    <h4 class="font-weight-bold">{{
        $inquire->title
    }}</h4>
    <h5><span class="badge badge-warning">✍ {{$inquire->user->name}}</span></h5>
    <div class="d-flex flex-column my-2">
        <span>{{$inquire->created_at}}에 작성되었습니다.</span>
    </div>
    <div class="row">
        <div class="col-lg-8 my-2">
            <div class="py-2 px-3 bg-white">
                <p class="py-2">{{$inquire->desc}}</p>
                <hr />
                <div class="d-flex">
                    @if ($inquire->ref_link)
                    <a href="{{$inquire->ref_link}}" class="mr-2 btn btn-primary text-white">{{$inquire->ref_link}}</a>
                    @endif
                    @if (auth()->user()->id === 1)
                    <form action="{{route("inquires.check", $inquire->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">👌 완료</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 my-2">
            <script>
                new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"145"});
            </script>
        </div>
    </div>
</div>
@endsection