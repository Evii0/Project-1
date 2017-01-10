<script>
    activeSection = "qualificationSelection";
</script>        

<link href="../application/views/Forms/Real Estate/css/main.css" rel="stylesheet" type="text/css">
<script src="../application/views/Forms/Real Estate/Javascript/Validation%20Functions.js"></script>
<script src="../application/views/Forms/Real Estate/Javascript/Load.js"></script>

<!-- Navigation -->
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
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
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
            <!-- /.navbar-top-links -->
            <div id="name"></div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <!--<div id="progressBar">
                            <p>
                                <strong>Progress</strong>
                                <span class="pull-right text-muted">80% Complete</span>
                            </p>
                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                </div>
                            </div>
                        </div>-->


                        <li onclick="linkClick('qualificationSelection')">
                          <a class="active" id="qualificationSelectionSide">Qualification Selection</a>
                        </li>
                        <li onclick="linkClick('qualificationRecognition')">
                          <a id="qualificationRecognitionSide">Qualification Recognition</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
