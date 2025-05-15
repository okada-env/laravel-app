@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 mt-6">
            <div class="card-body">
                <h1 class="mt4">登録編集</h1>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif
                <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="title">企業名</label>
                        <input type="text" name="title" class="form-control" 
                        value="{{old('title', $post->title)}}" id="title" placeholder="Enter Title">
                    </div>

                    <button type="submit" class="btn btn-success">送信する </button>
                </form>
            </div>
        </div>
    </div>
@endsection