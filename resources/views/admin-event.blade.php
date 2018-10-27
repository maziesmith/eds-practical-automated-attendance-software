@extends('layouts.admin-master')

@section('title', 'EAS - Event')

@section('active-event')
class="active-link"
@endsection

@section('main-title')
EVENT
@endsection

@section('content')
<form action="/event/create" method="post">
    @csrf
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}"/>
        <p class="help-block error">
            @if ($errors->has('name'))
                <strong>{{ $errors->first('name') }}</strong>
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
