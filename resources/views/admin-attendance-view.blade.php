@extends('layouts.admin-master')

@section('title', 'EAS - Attendance')

@section('active-attendance-view')
class="active-link"
@endsection

@section('main-title')
VIEW ATTENDANCE
@endsection

@section('content')
<form action="/attendance/view" method="post">
    @csrf
    <div class="form-group">
        <label>Event ID</label>
        <input class="form-control" name="event_id" value="{{ old('event_id') }}" id="event-id"/>
        <p class="help-block error">
            @if ($errors->has('event_id'))
                <strong>{{ $errors->first('event_id') }}</strong>
            @endif
        </p>
    </div>
    <button type="submit" class="btn btn-primary" id="view-attendance">Show</button>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <td>S/N</td>
            <td>Student Name</td>
            <td>Student Id</td>
            <td>Status</td>
        </tr>
    </thead>
    <tbody id="table-body">
    </tbody>
</table>
@endsection

@section('custom-page-scripts')
<script type="text/javascript">
    $(function(){
        $("button#view-attendance").click(function(e){
            e.preventDefault();
            var event_id = $("input#event-id").val();
            $.post("/attendance/view", {event_id: event_id}, function(data){
                $("#table-body").text(data)
            })
        });
    })
</script>
@endsection
