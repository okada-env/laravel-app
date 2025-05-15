@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 mt-6">
            <div class="card-body">
                <h1 class="mt4">企業登録</h1>
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
                <form method="post" action="{{route('companies.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">企業名</label>
                        <input type="title" name="title" class="form-control" id="title" value="{{old('title')}}" placeholder="Enter Title">
                    </div>

                    <button type="submit" class="btn btn-success">送信する </button>
                </form>
            </div>
        </div>
    </div>
@endsection