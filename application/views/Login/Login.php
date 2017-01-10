<?php
echo base_url();
if(isset($_GET["company"])){
    $param = $_GET["company"];
    $logo = "";
    if($param == "skills") $logo = "skillsLogo.png";
    if($param == "skillsInt") $logo = "skillsIntLogo.png";
    if($param == "harcourts") $logo = "hc123456.png";
    if($param == "mp") $logo = "mp12345.png";
}
else{
    $logo = "skillsLogo.png";
}
?>
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
    
    <script type="text/javascript">
        var logo = "<?php echo $logo; ?>";
        var baseUrl = "<?php echo base_url(); ?>";
    </script>
    
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
                    <img src="application/views/Login/logos/<?php echo $logo; ?>" id="logo">
                </div>
            </div>
        </nav>
        
        <div id="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="output"></div>
                     <div id="outer">
                        <div id="createContainer">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <p id="title">Create Account</p>
                                </div>

                                <div class="panel-body">
                                    <form action="" method="POST">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" name="email2" placeholder="Email Address" class="form-control" id="newEmail" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                            <input type="text" name="email2" placeholder="First Name" class="form-control" id="firstName" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                                            <input type="text" name="email2" placeholder="Last Name" class="form-control" id="lastName" />
                                        </div>
                                        <br>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="password" name="pass1" placeholder="Create Password" class="form-control" id="pass1">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="password" name="pass2" placeholder="Confirm Password" class="form-control" id="pass2">
                                        </div>
                                        <input type="hidden" name="formControl" value="signup" />
                                        <button class="btn btn-default" type="button" onclick="back()" id="backButton">Back</button>
                                        <button class="btn btn-default" type="button" onclick="createAccount()" id="createButton">Create Account</button>
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
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="text" id="email" placeholder="Email Address" class="form-control" />
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            <input type="password" id="pass" placeholder="Password" class="form-control">
                                        </div>

                                        <input type="hidden" name="formControl" value="login" />
                                        <div id="linksContainer">
                                            <a onclick="showCreate()" class="link" id="create">Create Account</a>
                                            <a href="" onclick="forgotEmail()" class="link" id="forgot">Forgot Password</a>
                                        </div>
                                        <button class="btn btn-default" type="button" onclick="login()" id="loginButton">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </body>
    
</html>