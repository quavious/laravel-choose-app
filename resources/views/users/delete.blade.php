@extends('layouts.app')

@section('content')
<div class="container">
    <h4>회원 탈퇴</h4>
    <p class="text-small text-muted">사용자 비밀번호를 다시 한번 검증합니다.</p>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <p class="text-white bg-danger px-4 py-2 rounded mt-4">{{$error}}</p>
    @endforeach
    @endif
    <form action={{route("users.delete")}} method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 d-flex flex-column">
                <div class="py-4 px-2 bg-white rounded shadow shadow-sm">
                    <div class="form-group">
                        <label for="confirm" >비밀번호 확인</label>
                        <input type="password" name="password" id="confirm" class="form-control" />
                        <small class="text-danger font-weight-bold">회원탈퇴는 되돌릴 수 없습니다.</small>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-danger mt-4 font-weight-bold px-2 py-1">❌ 회원 탈퇴</button>
    </form>
</div>
@endsection