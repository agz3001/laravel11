@extends("layout")

@section("content")
<div class="container">
    <div style="text-align:right;">
        <a href="{{route('posts.edit', ['post'=>$post])}}" class="btn btn-info">編集</a>
        <form method="post" action="{{route('posts.destroy', ['post'=>$post])}}">
            @csrf
            @method("delete")
            <input type="submit" value="削除" class="btn btn-danger">
        </form>
    </div>
</div>
<div class="container">
    <div>
        <p><img src="" style="height:300px; width:300px;"></p>
        <h1 style="text-align:center;">{{$post->title}}</h1>
        <h3>{{$post->content}}</h3>
    </div>
    <br>
    <hr>
    <br>
    <div class="form-group">
        <form method="POST" action="{{route('comments.store')}}">
            @csrf
            @method("post")
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <label for="body">コメント欄</label>
            @error("body")
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <textarea id="body" name="body" rows="4" class="form-control">{{$post->body}}</textarea>
            <input type="submit" value="コメントする" class="btn btn-success">
        </form>
    </div>
    <br>
    <div class="container">
        <h2 style="text-align:center;">=====コメント一覧=====</h2>
    </div>
    @forelse ($post->comments as $comment)
        <section>
            <br>
            <h5 style="text-align:center;">{{$comment->body}}</h5>
            <p style="text-align:right;">{{$comment->created_at->format("Y/m/d H:i")}}</p>
    @empty
        <p style="text-align:center;">コメントはまだありません。</p>
        <hr>
        </section>
    @endforelse
</div>
@endsection
