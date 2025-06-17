@extends('layouts.app')
@section('content')

@if(session('message'))
<div class="alert alert-success">{{session('message')}}</div>
@endif

<div>
  <form action="{{ route('home') }}" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <input type="submit" value="検索">
  </form>
</div>

@foreach ($companies as $company)
<div class="container-fluid mt-20" style="margin-left:-10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap w-100 align-items-center">
                        <div class="media-body ml-3">
                            企業名:{{ $company->title }}<a href="{{route('companies.show', $company)}}">詳細</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

