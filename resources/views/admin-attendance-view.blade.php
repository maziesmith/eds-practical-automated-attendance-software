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
<div class="row" style="padding-top:10px;padding-bottom:10px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <button class="btn btn-large btn-primary" id="show-all">ALL</button>
        <button class="btn btn-large btn-success" id="show-present">PRESENT</button>
        <button class="btn btn-large btn-danger" id="show-absent">ABSENT</button>
        <button class="btn btn-large btn-warning" id="show-on-exeat">ON EXEAT</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td><b>S/N</b></td>
                    <td><b>Student Name</b></td>
                    <td><b>Student Email</b></td>
                    <td><b>Student Id</b></td>
                    <td><b>Status</b></td>
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
        $("button#show-present").click(function(){
            $("#table-body").html("");
            var attendanceData = $("#hold-attendance-data").text();
            var attendanceDataParsed = JSON.parse(attendanceData);
            var sn = 0
            for( var j = 0; j < attendanceDataParsed.length; j++) {
                var student = attendanceDataParsed[j];
                if (student.status != "PRESENT") {
                    continue;
                }
                var sn = sn + 1;

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
        })

        $("button#show-absent").click(function(){
            $("#table-body").html("");
            var attendanceData = $("#hold-attendance-data").text();
            var attendanceDataParsed = JSON.parse(attendanceData);
            var sn = 0
            for( var j = 0; j < attendanceDataParsed.length; j++) {
                var student = attendanceDataParsed[j];
                if (student.status != "ABSENT") {
                    continue;
                }
                var sn = sn + 1;

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
        })

        $("button#show-on-exeat").click(function(){
            $("#table-body").html("");
            var attendanceData = $("#hold-attendance-data").text();
            var attendanceDataParsed = JSON.parse(attendanceData);
            var sn = 0
            for( var j = 0; j < attendanceDataParsed.length; j++) {
                var student = attendanceDataParsed[j];
                if (student.status != "ON EXEAT") {
                    continue;
                }
                var sn = sn + 1;

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
        })

        $("button#show-all").click(function(){
            $("#table-body").html("");
            var attendanceData = $("#hold-attendance-data").text();
            var attendanceDataParsed = JSON.parse(attendanceData);
            var sn = 0
            for( var j = 0; j < attendanceDataParsed.length; j++) {
                var student = attendanceDataParsed[j];
                var sn = sn + 1;

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
        })
    })
</script>
@endsection
