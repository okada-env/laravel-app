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
                        <select name="contact_project" class="form-control" id="contact_project" required>
                            <option value="">選択してください</option>
                            @foreach(App\Models\Project::$projectTypes as $key => $value)
                                <option value="{{ $key }}" {{ old('contact_project', $project->contact_project) == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_id">進捗状況</label>
                        <select name="status_id" class="form-control" id="status" required>
                            <option value="">選択してください</option>
                            @php
                                $person = $project->persons->first();
                                $currentStatusId = $person ? $person->pivot->status_id : null;
                            @endphp
                            @foreach($statuses as $key => $value)
                                <option value="{{ $key }}" {{ $currentStatusId == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="person_id">担当者</label>
                        <select name="person_id" class="form-control" id="person_id" required>
                            <option value="">選択してください</option>
                            @php
                                $person = $project->persons->first();
                                $currentPersonId = $person ? $person->id : null;
                            @endphp
                            @foreach($persons as $person)
                                <option value="{{ $person->id }}" {{ $currentPersonId == $person->id ? 'selected' : '' }}>
                                    {{ $person->contact_person }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">更新する</button>
                </form>
            </div>
        </div>
    </div>
@endsection 