@extends("layout")

@section("content")
<div class="container">
    <div class="col-sm-4" style="padding: 20px 0; padding-left: 0px;">
        <form method="get" action="{{url('/search')}}" class="form-inline">
            <div class="form-group">
                <input type="text" name="searchWord" value="" class="form-control">
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
    </div>
    <div class="d-flex justify-content-center flex-wrap">
        @foreach ($data as $p)
        <div class="card mt-2 mr-2 ml-2" style="width: 300px;">
            <img class="card-img-top" src="https://dash-bootstrap-components.opensource.faculty.ai/static/images/placeholder286x180.png">
            <div class="card-body">
                <h6 class="card-subtitle text-muted">{{ $p->title }}</h6>
                <p class="card-text">{{ $p->content }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
