@extends('layouts.admin-master')

@section('title', 'EAS - Exeat')

@section('active-exeat')
class="active-link"
@endsection

@section('main-title')
EXEAT
@endsection

@section('content')
<form action="/exeat/create" method="post">
    @csrf
    <div class="form-group">
        <label>Student ID</label>
        <input class="form-control" name="student_id" value="{{ old('student_id') }}"/>
        <p class="help-block error">
            @if ($errors->has('student_id'))
                <strong>{{ $errors->first('student_id') }}</strong>
            @endif
        </p>
    </div>

    <div class="form-group">
        <label>Start Date</label>
        <input name="start" type="date" class="form-control" value="{{ old('start') }}"/>
        <p class="help-block error">
            @if ($errors->has('start'))
                <strong>{{ $errors->first('start') }}</strong>
            @endif
        </p>
    </div>

    <div class="form-group">
        <label>End Date</label>
        <input type="date" name="end" class="form-control" value="{{ old('end') }}"/>
        <p class="help-block error">
            @if ($errors->has('end'))
                <strong>{{ $errors->first('end') }}</strong>
            @endif
        </p>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
