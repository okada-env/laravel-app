@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 mt-6">
            <div class="card-body">
                <h1 class="mt4">案件編集</h1>
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
                <form method="post" action="{{route('companies.projects.update', [$company, $project])}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="contact_project">案件名</label>
                        <input type="text" name="contact_project" class="form-control" id="contact_project" 
                        value="{{old('contact_project', $project->contact_project)}}" required>
                    </div>
                    <button type="submit" class="btn btn-success">更新する</button>
                </form>
            </div>
        </div>
    </div>
@endsection 