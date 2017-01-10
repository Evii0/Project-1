<html>
    <head>
        <title>Skills Enrolment</title>
        <!-- Bootstrap Core CSS -->
        
        
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- My CSS -->
    <link href="../application/views/Constants/CSS/navigation.css" rel="stylesheet" type="text/css">  
    <link href="../application/views/Constants/CSS/containers.css" rel="stylesheet" type="text/css">
    
    </head>
    <body onload="load()">     
        <script type="text/javascript">
        var activeSection = "";
    
        function linkClick(link){            
            console.log(activeSection);
            document.getElementById(activeSection).style.display = "none";
            document.getElementById(link).style.display = "inline";
            
            document.getElementById(activeSection + "Side").className = "";
            document.getElementById(link + "Side").className = "active";

            activeSection = link;
        }
        
        function nextSection(next){
            
            
            linkClick(next);
        }
        
    </script>