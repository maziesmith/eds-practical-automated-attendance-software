@extends('layouts.admin-master')

@section('title', 'EAS - Attendance')

@section('active-attendance-upload')
class="active-link"
@endsection

@section('main-title')
UPLOAD ATTENDANCE
@endsection

@section('content')
<form action="/attendance/upload" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Event ID</label>
        <input class="form-control" name="event_id" value="{{ old('event_id') }}"/>
        <p class="help-block error">
            @if ($errors->has('event_id'))
                <strong>{{ $errors->first('event_id') }}</strong>
            @endif
        </p>
    </div>

    <div class="form-group">
        <label>Attendance File (.csv format)</label>
        <input class="form-control" name="attendance" type="file"/>
        <p class="help-block error">
            @if ($errors->has('attendance'))
                <strong>{{ $errors->first('attendance') }}</strong>
            @endif
        </p>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
@endsection
