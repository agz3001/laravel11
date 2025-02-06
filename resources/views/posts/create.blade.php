@extends("layout")

@section("content")
<div class="container">
  <div class="form-group">
    <form method="post" action="{{route('posts.store')}}">
      @isset ($filename)
      <div>
          <img src="{{ asset('storage/'.$filename) }}">
      </div>
      @endisset
      @csrf
      <label for="photo">画像ファイル</label>
      <br>
      <input id="photo" type="file" name="file">
      <br>
      <label for="title">タイトル</label>
      @error("title")
        <div class="aler alert-danger">{{$message}}</div>
      @enderror
      <input id="title" type="text" name="title" value="" class="form-control">
      <label for="content">投稿内容</label>
      @error("content")
        <div class="aler alert-danger">{{$message}}</div>
      @enderror
      <textarea id="content" name="content" value="" rows="4" class="form-control"></textarea>
      <input type="submit" value="作成" class="btn btn-primary">
      <a href="{{route('top')}}" class="btn btn-default">キャンセル</a>
    </form>
  </div>
</div>


@endsection
