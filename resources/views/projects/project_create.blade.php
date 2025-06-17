@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">案件登録</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ route('companies.projects.store', $company) }}">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $company->id }}">
                        <div class="form-group">
                            <label for="contact_project">案件名</label>
                            <select name="contact_project" class="form-control" id="contact_project" required>
                                <option value="">選択してください</option>
                                @foreach(\App\Models\Project::$projectTypes as $key => $value)
                                    <option value="{{ $key }}" {{ old('contact_project') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="person_id">担当者</label>
                            <select name="person_id" class="form-control" id="person_id" required>
                                <option value="">選択してください</option>
                                @foreach($people as $person)
                                    <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                                        {{ $person->contact_person }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_id">進捗状況</label>
                            <select name="status_id" class="form-control" id="status_id" required>
                                <option value="">選択してください</option>
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" {{ old('status_id') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection