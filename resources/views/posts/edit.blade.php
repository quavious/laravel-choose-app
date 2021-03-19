@extends('layouts.app')

@section('content')
<div class="container">
    <h4>글을 수정해요</h4>
    <p class="text-small text-muted">게시물을 수정할 수 있어요</p>
    <form action={{route("posts.update", $post->id)}} method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6 d-flex flex-column">
                <div class="border border-danger py-4 px-2 bg-white rounded">
                    <div class="form-group">
                        <label for="pros_title">대상 이름</label>
                        <input type="text" name="pros_title" id="pros_title" value="{{$post->pros_title}}" required class="form-control" maxlength="32"/>
                    </div>
                    <div class="form-group">
                        <label for="pros_desc">대상에 대한 내용 작성</label>
                        <textarea name="pros_desc" id="pros_desc" class="form-control" rows="10" placeholder="상세한 내용 작성 부탁드립니다.">{{$post->pros_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="pros_image">대상 이미지</label>
                        <input type="file" id="pros_image" class="form-control-file" name="pros_image" accept="image/*">
                        <span class="text-danger font-weight-bold">이미지를 새로 첨부하면 기존 이미지는 삭제됩니다.</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex flex-column">
                <div class="border border-primary py-4 px-2 bg-white rounded">
                    <div class="form-group">
                        <label for="cons_title">대상 이름</label>
                        <input type="text" name="cons_title" class="form-control" id="cons_title"  value="{{$post->cons_title}}" required maxlength="32"/>
                    </div>
                    <div class="form-group">
                        <label for="cons_desc">대상에 대한 내용 작성</label>
                        <textarea name="cons_desc" class="form-control" id="cons_desc" rows="10" placeholder="상세한 내용 작성 부탁드립니다.">{{$post->cons_desc}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="cons_image">대상 이미지</label>
                        <input type="file" class="form-control-file" id="cons_image" name="cons_image" accept="image/*">
                        <span class="text-danger font-weight-bold">이미지를 새로 첨부하면 기존 이미지는 삭제됩니다.</span>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <script>
            new PartnersCoupang.G({"id":455604,"template":"carousel","trackingCode":"AF3750105","width":"100%","height":"115"});
        </script>
        <button type="submit" class="btn btn-outline-primary mt-4 font-weight-bold px-3 py-1">글 작성</button>
    </form>
</div>
@endsection