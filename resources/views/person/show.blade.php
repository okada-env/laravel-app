@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3"> 
            {{$person->user->name}}
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">担当者名【{{$person->contact_person}}】</h4>
            <span>
                <a href="{{route('person.edit', $person)}}" class="btn btn-primary btn-sm mr-1">編集</a>
                <form method="post" action="{{route('person.destroy', $person)}}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                </form>
            </span>
        </div>
    </div>
        </div>
        <h5 class="mt-4">所持案件一覧</h5>
        @if($projects && $projects->count() > 0)
            <ul class="list-group mb-4">
                @foreach($projects as $project)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mt-4">案件：【{{ $project->contact_project }}】</h6>
                            <div>
                                <a href="{{ route('companies.projects.edit', [$company, $project]) }}" class="btn btn-primary btn-sm">編集</a>
                                <form method="post" action="{{ route('companies.projects.destroy', [$company, $project]) }}" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                                </form>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>案件が登録されていません。</p>
        @endif
    </div>
</div>

@endsection