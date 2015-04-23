<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>I-TEACH</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/gallery.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->    
    <script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- jQuery -->    
    <script src="js/jquery.min.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">I-TEACH | <small>ICS TEaching and Course scHeme</small></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        @if(count($Nrequests))
                            @foreach($Nrequests as $r)
                            <li class="message-preview">
                                <a href= {{ $r['request']->link }}>
                                    <div class="media">
                                        <span class="pull-left">
                                            @if($r['request']->response == 'yes')
                                                <i class="fa fa-check-circle"></i>
                                            @elseif($r['request']->response == 'no')
                                                <i class="fa fa-times-circle"></i>
                                            @elseif($r['request']->response == 'none')
                                                <i class="fa fa-exclamation-circle"></i>
                                            @elseif($r['request']->response == 'happy')
                                                <i class="fa fa-smile-o"></i>
                                            @elseif($r['request']->response == 'sad')
                                                <i class="fa fa-frown-o"></i>
                                            @elseif($r['request']->response == 'ban')
                                                <i class="fa fa-ban"></i>
                                            @endif
                                        </span>
                                        <div class="media-body">
                                        
                                            <h5 class="media-heading"><strong>{{ $r['heading'] }}</strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i>{{date(" F d, Y h:i a", strtotime($r['request']->created_at))}}</p>
                                            <p> <?php echo $r['request']->message ?> </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @else
                            <li class="message-preview">
                                <a href= "#">
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="media-heading"> <strong>No Requests At The Moment</strong> </h5>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                        <li class="message-footer">
                            <a href="#">Read Old Messages</a>
                        </li>
                    </ul>
                </li>
                
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-user"></i> {{ Session::get('userInst')['fname'] }} {{ Session::get('userInst')['lname'] }} <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li> <a href="adminHome"><i class="fa fa-fw fa-home"></i> Home </a> </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#operations"><i class="fa fa-fw fa-list"></i>  Operations  <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul class="collapse" id="operations">
                            <li> <a href="addCourse"><i class="fa fa-fw"></i> Add Course </a> </li>
                            <li> <a href="addSection"><i class="fa fa-fw"></i> Add Section </a> </li>
                            <li> <a href="swapSection"><i class="fa fa-fw"></i> Swap Section </a> </li>
                            <li> <a href="dissolveSection"><i class="fa fa-fw"></i> Dissolve Section </a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#view"><i class="fa fa-fw fa-list"></i>  View  <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="view" class="collapse">
                            <li> <a href="viewAll"><i class="fa fa-fw"></i> All </a> </li>
                            <li> <a href="viewCourse"><i class="fa fa-fw"></i> Course </a> </li>
                            <li> <a href="viewRoom"><i class="fa fa-fw"></i> Room </a> </li>
                            <li> <a href="viewInstructor"><i class="fa fa-fw"></i> Instructor </a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#pendingRequests" ><i class="fa fa-fw fa-list"></i> View Pending Requests <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="pendingRequests" class="collapse">
                            <li> <a href="#"><i class="fa fa-fw"></i> All </a></li>
                            <li> <a href="#"><i class="fa fa-fw"></i> Account Request </a></li>
                            <li> <a href="viewSwapRequests"><i class="fa fa-fw"></i> Swap Requests </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#editMinorDetails" ><i class="fa fa-fw fa-cog"></i> Edit Minor Details <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="editMinorDetails" class="collapse">
                            <li> <a href="editMinorDetailsFaculty"><i class="fa fa-fw"></i> Faculty </a></li>
                            <li> <a href="editMinorDetailsRoom"><i class="fa fa-fw"></i> Room </a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="viewSystemLog"><i class="fa fa-fw fa-table"></i> View System Log</a>
                    </li>

                    <li>
                        <a href="uploadCSVFile"><i class="fa fa-fw fa-file-text"></i> Upload CSV File </a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>

</html>
