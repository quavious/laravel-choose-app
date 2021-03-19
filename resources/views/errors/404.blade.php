@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-danger rounded p-3">
        <h3 class="text-white ">404 페이지 오류</h3>
        <hr class="bg-white font-weight-bold" />
        <p class="text-white font-weight-light">지금 접속하신 주소는 존재하지 않습니다.</p>
        <a href="{{route("index")}}" class="btn btn-light">메인 화면</a>
        <div class="w-100 my-3">
            <script>
                new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"145"});
            </script>
        </div>
    </div>
</div>
@endsection
