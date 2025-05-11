@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 mt-6">
            <div class="card-body">
                <h1 class="mt4">担当者編集</h1>
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
                <form method="post" action="{{route('person.update', $person)}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="contact_person">担当者名</label>
                        <input type="text" name="contact_person" class="form-control" id="contact_person" 
                        value="{{old('contact_person', $person->contact_person)}}" required>
                    </div>
                    <button type="submit" class="btn btn-success">更新する</button>
                </form>
            </div>
        </div>
    </div>
@endsection 