@extends('layouts.admin-master')

@section('title', 'EAS - Attendance')

@section('active-attendance')
class="active-link"
@endsection

@section('main-title')
COMPUTE ATTENDANCE
@endsection

@section('content')
<form action="/attendance/compute" method="post">
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
    <button type="submit" class="btn btn-primary">Show</button>
</form>
@endsection
