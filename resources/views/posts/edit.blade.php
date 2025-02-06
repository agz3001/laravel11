@extends("layout")

@section("content")
    <div class="container">
        <form method="post" action="{{route('posts.update', ['post'=>$post])}}">
            @csrf
            @method("put")
            <label for="title">タイトル</label>
            @error("title")
                <div class="aler alert-danger">{{$message}}</div>
            @enderror
            <input id="title" type="text" name="title" value="{{$post->title}}" class="form-control">
            <label for="body">投稿内容</label>
            @error("body")
                <div class="aler alert-danger">{{$message}}</div>
            @enderror
            <textarea id="body" name="content" value="" rows="4" class="form-control">{{$post->content}}</textarea>
            <input type="submit" value="更新する" class="btn btn-success">
            <a href="{{route('posts.show', ['post'=>$post])}}" class="btn btn-white">キャンセル</a>
        </form>
</div>

@endsection
