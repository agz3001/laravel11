@extends("layout")

@section("content")
<div class="container">
    <a href="{{route('posts.create')}}" class="btn btn-success">新規作成</a>
    <a href="{{ url('/search') }}" class="btn btn-info">検索</a>
</div>
<div class="container">
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <a href="{{route('posts.show', ['post'=>$post])}}"><img src="" style="height:300px; width:300px;"></a>
            <br>
            <span>{{$post->title}}<span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-success">コメント {{(count($post->comments))}}件</span>
            <p>{{$post->created_at->format("Y-m-d H:i")}}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection
