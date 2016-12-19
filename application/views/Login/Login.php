<html>
    <head>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="vendor/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
        <link href="application/views/Login/Login.css" rel="stylesheet" type="text/css">
        <script src="application/views/Login/Login.js"></script>
        <title>Login</title>
        
    </head>
    
    <body>
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
        </nav>
        
        <div id="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if(!isset($_SESSION['code'])) { ?>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    Wanting to start an application?
                    </div>
                    <div class="panel-body">
                    <p>You need to contact your employer for access to this site</p>
                    </div>
                    </div>

                    <?php } else { ?>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Would you like to start a new application?
                        </div>
                        <div id="loginContainer">
                            <div class="panel-body">
                                <form action="" method="POST">
                                    <div class="form-group input-group<?php if(isset($emailError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" name="email2" placeholder="Email Address" class="form-control" value="<?php if(isset($_POST['email2'])) {print $_POST['email2'];} ?>" />
                                    </div>
                                    <?php if(isset($emailError)) {print '<div class="alert alert-danger">'.$emailError.'</div>'; } ?>
                                    <div class="form-group input-group<?php if(isset($passwordError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="pass1" placeholder="Create Password" class="form-control">
                                    </div>
                                    <div class="form-group input-group<?php if(isset($passwordError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="pass2" placeholder="Confirm Password" class="form-control">
                                    </div>
                                    <?php if(isset($passwordError)) {print '<div class="alert alert-danger">'.$passwordError.'</div>'; } ?>
                                    <input type="hidden" name="formControl" value="signup" />
                                    <button class="btn btn-default" type="submit">Create Account</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    
                    <div id="createContainer">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <p id="title">Create Account</p>
                            </div>

                            <div class="panel-body">
                                <form action="" method="POST">
                                    <div class="form-group input-group<?php if(isset($emailError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" name="email2" placeholder="Email Address" class="form-control" value="<?php if(isset($_POST['email2'])) {print $_POST['email2'];} ?>" />
                                    </div>
                                    <?php if(isset($emailError)) {print '<div class="alert alert-danger">'.$emailError.'</div>'; } ?>
                                    <div class="form-group input-group<?php if(isset($passwordError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="pass1" placeholder="Create Password" class="form-control">
                                    </div>
                                    <div class="form-group input-group<?php if(isset($passwordError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="pass2" placeholder="Confirm Password" class="form-control">
                                    </div>
                                    <?php if(isset($passwordError)) {print '<div class="alert alert-danger">'.$passwordError.'</div>'; } ?>
                                    <input type="hidden" name="formControl" value="signup" />
                                    <button class="btn btn-default" type="submit">Create Account</button>
                                </form>
                            </div>
                        </div>  
                    </div>

                    <div id="loginContainer">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <p id="title">Skills Login</p>
                            </div>

                            <div class="panel-body">
                                <form action="" method="POST">
                                    <div class="form-group input-group<?php if(isset($loginError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input type="text" name="email" placeholder="Email Address" class="form-control" value="<?php if(isset($_POST['email'])) {print $_POST['email'];} ?>" />
                                    </div>
                                    <div class="form-group input-group<?php if(isset($loginError)) {print " has-error";} ?>">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="pass" placeholder="Password" class="form-control">
                                    </div>

                                    <?php if(isset($loginError)) {print '<div class="alert alert-danger">Invalid Login</div>'; } ?>

                                    <input type="hidden" name="formControl" value="login" />
                                    <div id="linksContainer">
                                        <a href="" onclick="showCreate()" class="link" id="create">Create Account</a>
                                        <a href="passwordReset.php" class="link" id="forgot">Forgot Password</a>
                                    </div>
                                    <button class="btn btn-default" type="submit" id="loginButton">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </body>
    
</html>