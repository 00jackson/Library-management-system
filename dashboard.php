<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | User Dash Board</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
       <?php if($_SESSION['login'])
{
?>    

    <section class="menu-section">
        <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars threebar" aria-hidden="true"></i>
            </button>
        </div>
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" class="menu-top-active" style="font-weight: bold;">DASHBOARD</a></li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown" style="font-weight: bold;"> Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropp" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php" style="font-weight: bold;">My Profile</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="change-password.php" style="font-weight: bold;">Change Password</a></li>
                                </ul>
                            </li>
                            <li><a href="issued-books.php" style="font-weight: bold;">Issued Books</a></li>

                            <?php if($_SESSION['login'])
                            {
                            ?>

                            <li><a href="logout.php" class="log" style="font-weight: bold; background: #ff8e41; font-weight: bold; color: #02151f;"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbspLogout</a></li>

                            <?php }?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php } else { ?>
        <section class="menu-section">
        <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars threebar" aria-hidden="true"></i>
            </button>
        </div>

            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <a class="imgg"><img src="assets/img/logo.png" style="background: grey;"></a>
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
                             <li><a href="adminlogin.php">Admin Login</a></li>
                            <li><a href="signup.php">User Signup</a></li>
                             <li><a href="index.php">User Login</a></li>
                          

                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php } ?>
<?php
 // include('includes/header.php');
 ?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <div class="header-line">
                        <p style=" background-image: url('assets/img/ag.jpg');
                                    background-repeat: repeat;
                                    -webkit-background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    /*margin-top: 200px;*/
                                    font-size: 30px;
                                    text-align: center;
                                    font-weight: bold;
                                    text-transform: uppercase;
                                    font-family: 'Steelfish Rg', 'helvetica neue',
                                                helvetica, arial, sans-serif;
                                    font-weight: 800;
                                    -webkit-font-smoothing: antialiased;" >ADMIN DASHBOARD</p>
                    </div>
                </div>
            </div>
             
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="alert alert-info back-widget-set text-center innercontent">
                        <i class="fa fa-bars fa-5x"></i>
                        <?php 
                        $sid=$_SESSION['stdid'];
                        $sql1 ="SELECT id from tblissuedbookdetails where StudentID=:sid";
                        $query1 = $dbh -> prepare($sql1);
                        $query1->bindParam(':sid',$sid,PDO::PARAM_STR);
                        $query1->execute();
                        $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                        $issuedbooks=$query1->rowCount();
                        ?>

                        <h3><?php echo htmlentities($issuedbooks);?> </h3>
                        Book Issued
                    </div>
                </div>
             
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="alert alert-warning back-widget-set text-center innercontent">
                        <i class="fa fa-recycle fa-5x"></i>
                        <?php 
                        $rsts=0;
                        $sql2 ="SELECT id from tblissuedbookdetails where StudentID=:sid and RetrunStatus=:rsts";
                        $query2 = $dbh -> prepare($sql2);
                        $query2->bindParam(':sid',$sid,PDO::PARAM_STR);
                        $query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
                        $query2->execute();
                        $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                        $returnedbooks=$query2->rowCount();
                        ?>

                        <h3><?php echo htmlentities($returnedbooks);?></h3>
                        Books Not Returned Yet
                    </div>
                </div>
            </div>      
        </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
     <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>


<?php } ?>