<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>EAS by Vilgax</title>
    	<!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
         <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
            <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
         <!-- GOOGLE FONTS-->
       <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <div id="wrapper">
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="adjust-nav">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">
                            EAS<!--img src="assets/img/logo.png" /-->
                        </a>

                    </div>

                    <span class="logout-spn" >
                        <a href="#" style="color:#fff;">LOGOUT</a>

                    </span>
                </div>
            </div>
            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">



                        <li class="active-link">
                            <a href="index.html" ><i class="fa fa-desktop "></i>Dashboard</a>
                        </li>


                        <li>
                            <a href="ui.html"><i class="fa fa-table "></i>Attendance</a>
                        </li>

                        <li>
                            <a href="ui.html"><i class="fa fa-table "></i>Event</a>
                        </li>

                        <li>
                            <a href="ui.html"><i class="fa fa-table "></i>Exeat</a>
                        </li>

                    </ul>
                </div>

            </nav>
            <!-- /. NAV SIDE  -->
        </div>
       @yield('content')
    </body>
</html>
