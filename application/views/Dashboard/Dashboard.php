<html>
    <head>
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <link href="../application/views/Dashboard/Dashboard.css" rel="stylesheet" type="text/css">
        <script src="../application/views/Dashboard/Dashboard.js"></script>
        <script src="../application/views/Constants/Javascript/ValidateLogin.js"></script>
        <script src="../application/views/Constants/Javascript/Logout.js"></script>
        <title>Dashboard</title>
        
    </head>
    
    <body onload="load()">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="logoContainer">
                    <img src="" id="logo">
                </div>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a onclick="logout()"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <div id="name"></div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="container">
            <h1 class="page-header" >Dashboard</h1>
            <div>
                <h3>Welcome to The Skills Organisation (Skills) online enrolment.</h3>
            </div>
            <div>
                <p> At any time you can save the form you are working on and leave. When you come back you can continue where you left off. As you work through the agreement, completed sections will be marked with a tick <font color="green"><i class="fa fa-check fa-fw"></i></font></p>
                <a href="form.php?form=nextIncomplete"></a>
            </div>
            <br>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p id="title">Enrolment Forms</p>
                </div>
                <table id="formTable">
                    <tr>
                        <th class="first">Forms</th>
                        <th class="second">Completed</th>
                    </tr>
                </table>
            </div>
            
        </div>
    </body>
    <footer>
        <p>&copy;2016 Skills Ltd.</p>
        <p>Built By IWS Design Ltd.</p>
    </footer>
</html>