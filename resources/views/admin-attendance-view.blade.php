@extends('layouts.admin-master')

@section('title', 'EAS - Attendance')

@section('active-attendance-view')
class="active-link"
@endsection

@section('main-title')
VIEW ATTENDANCE
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button class="btn btn-large btn-primary" id="show-all">All</button>
        <button class="btn btn-large btn-success" id="show-present">PRESENT</button>
        <button class="btn btn-large btn-danger" id="show-absent">ABSENT</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Student Name</td>
                    <td>Student Email</td>
                    <td>Student Id</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
    </div>
</div>
<div class="hidden" id="hold-attendance-data"></div>
@endsection

@section('custom-page-scripts')
<script type="text/javascript">
    $(function(){
        $("button#view-attendance").click(function(e){
            e.preventDefault();
            var event_id = $("input#event-id").val();
            $.post("/attendance/view", {event_id: event_id}, function(data){
                if (data.type == "error") {
                    alert(data.content);
                } else {
                    $("#hold-attendance-data").text(JSON.stringify(data.content))
                    var attendances = data.content;
                    for( var j = 0; j < attendances.length; j++) {
                        var sn = j + 1;
                        var student = attendances[j];
                        $("#table-body").append("\
                        <tr>\
                            <td>" + sn + "</td>\
                            <td>" + student.name + "</td>\
                            <td>" + student.email + "</td>\
                            <td>" + student.identification + "</td>\
                            <td>" + student.status + "</td>\
                        </tr>\
                        ");
                    }
                }
            });
            $("#table-body").html("");
            //alert(attendanceData)
            /*var attendanceDataParsed = JSON.parse(attendanceData);

            if (attendanceDataParsed.type == "error") {
                alert(attendanceDataParsed.content);
            }
            for( var j = 0; j < attendanceDataParsed.length; j++) {
                var sn = j + 1;
                var student = attendanceDataParsed[j];
                $("#table-body").append("\
                <tr>\
                    <td>" + sn + "</td>\
                    <td>" + student.name + "</td>\
                    <td>" + student.email + "</td>\
                    <td>" + student.identification + "</td>\
                    <td>" + student.status + "</td>\
                </tr>\
                ");
            }*/
        });
    })
</script>
@endsection
