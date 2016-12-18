<script>
    activeSection = "generalDetails";
</script>
<script src="application/views/Forms/Training Agreement/Javascript/Validation Functions.js"></script>

<link href="application/views/Forms/Training Agreement/CSS/content.css" rel="stylesheet" type="text/css">

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
            <img src="application/views/Forms/Training Agreement/assets/logos/skillsLogo.png" id="logo">
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
                <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <div id="progressBar">
                    <p>
                        <strong>Progress</strong>
                        <span class="pull-right text-muted" id="progressBarText">80% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                            <span class="sr-only">80% Complete (danger)</span>
                        </div>
                    </div>
                </div>

                <li>
                    <a><i class="fa fa-pencil fa-fw"></i> Trainee Information<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li onclick="linkClick('generalDetails')">
                            <a class="active" id="generalDetailsSide"><i class="fa fa-pencil fa-fw"></i> General Details</a>
                        </li>
                        <li onclick="linkClick('contactDetails')">
                            <a id="contactDetailsSide"><i class="fa fa-pencil fa-fw"></i> Contact Details</a>
                        </li>
                         <li onclick="linkClick('ethnicity')">
                            <a id="ethnicitySide"><i class="fa fa-pencil fa-fw"></i> Ethnicity</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-pencil fa-fw"></i> Education<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li onclick="linkClick('education')">
                            <a id="educationSide"><i class="fa fa-pencil fa-fw"></i> Education</a>
                        </li>
                        <li onclick="linkClick('learningSkills')">
                            <a id="learningSkillsSide"><i class="fa fa-pencil fa-fw"></i> Employment and Skills</a>
                        </li>
                    </ul>
                </li>
                <li onclick="linkClick('employerInfo')">
                    <a id="employerInfoSide"><i class="fa fa-pencil fa-fw"></i> Employer Information</a>
                </li>  
                <li onclick="linkClick('identity')">
                    <a id="identitySide"><i class="fa fa-pencil fa-fw"></i> Identity</a>
                </li>
                <li onclick="linkClick('terms')">
                    <a id="termsSide"><i class="fa fa-pencil fa-fw"></i> Terms</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>