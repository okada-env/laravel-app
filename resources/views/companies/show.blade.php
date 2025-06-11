@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3"> 
            {{$company->user->name}}
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">企業名【{{$company->title}}】</h4>
            <span>
                <a href="{{route('companies.edit', $company)}}" class="btn btn-primary btn-sm mr-1">編集</a>
                <form method="post" action="{{route('companies.destroy', $company)}}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                </form>
            </span>
        </div>
    </div>
    <div class="card-body">
        <h5>担当者一覧</h5>
        <form method="GET" action="{{ route('companies.show', $company) }}" class="mb-3">
            <input type="text" name="person_keyword" value="{{ request('person_keyword') }}" placeholder="担当者名で検索">
            <button type="submit" class="btn btn-secondary btn-sm">検索</button>
        </form>
        @if($people && $people->count() > 0)
            <ul class="list-group mb-4">
                @foreach($people as $person)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="media-body ml-3">担当者:<a href="{{route('person.show', $person)}}">{{ $person->contact_person }}</div>
                        <div>
                            <a href="{{ route('person.edit', $person) }}" class="btn btn-primary btn-sm">編集</a>
                            <form method="post" action="{{ route('person.destroy', $person) }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>担当者が登録されていません。</p>
        @endif

        <div class="card-footer">
            <span class="ml-auto">
                <a href="{{ url('person/create?company_id=' . $company->id) }}"><button class="btn btn-primary">担当者を登録</button></a>
            </span>
        </div>
        @if($company->company)
            <form method="post" action="{{ route('companies.people.store', $company->company) }}" class="mb-4">
                @csrf
                <input type="hidden" name="company_id" value="{{ $company->company->id }}">
                <div class="form-group">
                    <label for="contact_person">担当者名</label>
                    <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ old('contact_person') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        @endif
        <div class="card-footer">
            <span class="ml-auto">
                <a href="{{ route('companies.projects.create', $company) }}"><button class="btn btn-primary">案件を登録</button></a>
            </span>
        </div>

        <h5 class="mt-4">案件一覧</h5>
        @if($projects && $projects->count() > 0)
            <ul class="list-group mb-4">
                @foreach($projects as $project)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            案件名：{{ $project->contact_project }}
                            <div class="media-body ml-3">
                                進捗:
                                @php
                                    $statusMap = [
                                        1 => '進行中',
                                        2 => '受注',
                                        3 => '失注'
                                    ];
                                    $currentStatusId = $project->companies->first()?->pivot?->status_id;
                                @endphp
                                {{ isset($currentStatusId) ? $statusMap[$currentStatusId] : '未設定' }}
                            </div>
                            @if($project->persons->count() > 0)
                                <div class="media-body ml-3">担当者: {{ $project->persons->pluck('contact_person')->join(', ') }}</div>
                            @endif
                            {{-- {{ $project->status ? $project->status->pluck('status')->join(', ')  }} --}}
                        </div>
                        <div>
                            <a href="{{ route('companies.projects.edit', [$company, $project]) }}" class="btn btn-primary btn-sm">編集</a>
                            <form method="post" action="{{ route('companies.projects.destroy', [$company, $project]) }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>案件が登録されていません。</p>
        @endif
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            登録日時 {{$company->created_at->diffForHumans()}}
        </span>
    </div>
</div>

@endsection