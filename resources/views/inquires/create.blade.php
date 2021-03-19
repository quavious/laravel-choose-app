@extends('layouts.app')

@section('content')
<div class="container">
    <h4>건의 • 요청사항 작성</h4>
    <p class="text-small text-muted">요청할 것을 작성해보세요.</p>
    <form action={{route("inquires.store")}} method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 d-flex flex-column">
                <div class="border border-danger pt-4 pb-2 px-2 bg-white rounded">
                    <div class="form-group">
                        <label for="title">대상 이름</label>
                        <input type="text" name="title" id="title" required class="form-control" maxlength="32"/>
                    </div>
                    <div class="form-group">
                        <label for="desc">대상에 대한 내용 작성</label>
                        <textarea name="desc" id="desc" class="form-control" rows="10" placeholder="상세한 내용 작성 부탁드립니다."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ref_link">참조 링크</label>
                        <input type="url" id="ref_link" class="form-control" name="ref_link" />
                        <small class="text-muted">참조할 수 있는 페이지 주소를 알려주시면 더 빠른 확인이 가능해요.</small>
                        <small class="text-danger font-weight-bold">주소는 관리자가 직접 볼 수 있습니다. 잘못된 주소를 올리지 말아주세요.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-3 pl-0 pr-3">
        <script>
            new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"115"});
        </script>
        </div>
        <button type="submit" class="btn btn-outline-primary mt-4 font-weight-bold px-3 py-1">글 작성</button>
    </form>
</div>
@endsection