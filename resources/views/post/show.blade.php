@extends('layouts.app')
@section('content')

<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3"> 
            {{$post->user->name}}
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">企業名【{{$post->title}}】</h4>
            <span>
                <a href="{{route('post.edit', $post)}}" class="btn btn-primary btn-sm mr-1">編集</a>
                <form method="post" action="{{route('post.destroy', $post)}}" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('本当に削除しますか？');">削除</button>
                </form>
            </span>
        </div>
    </div>
    <div class="card-body">
        <h5>担当者一覧</h5>
        <form method="GET" action="{{ route('post.show', $post) }}" class="mb-3">
            <input type="text" name="person_keyword" value="{{ request('person_keyword') }}" placeholder="担当者名で検索">
            <button type="submit" class="btn btn-secondary btn-sm">検索</button>
        </form>
        @if($people && $people->count() > 0)
            <ul class="list-group mb-4">
                @foreach($people as $person)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $person->contact_person }}
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
                <a href="{{ url('person/create?company_id=' . $post->id) }}"><button class="btn btn-primary">担当者を登録</button></a>
            </span>
        </div>
        @if($post->company)
            <form method="post" action="{{ route('companies.people.store', $post->company) }}" class="mb-4">
                @csrf
                <input type="hidden" name="company_id" value="{{ $post->company->id }}">
                <div class="form-group">
                    <label for="contact_person">担当者名</label>
                    <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ old('contact_person') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        @endif
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            登録日時 {{$post->created_at->diffForHumans()}}
        </span>
    </div>
</div>

@endsection