<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['alogin']!=''){
$_SESSION['alogin']='';
}
if(isset($_POST['login']))
{
 //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {

$username=$_POST['username'];
$password=$_POST['password'];
$sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System</title>
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
                            <li><a href="dashboard.php" style="font-weight: bold;">DASHBOARD</a></li>
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
                        <!-- <a class="imgg"><img src="assets/img/logo.png" style="background: grey;"></a> -->
                        <ul id="menu-top" class="nav navbar-nav navbar-right">                        
                          
                             <li><a href="adminlogin.php" class="menu-top-active" >Admin Login</a></li>
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
                    -webkit-font-smoothing: antialiased;" >Admin Login Page</p>
                </div>
</div>
</div>
             
<!--LOGIN PANEL START-->           
<div class="row ab">
<div class="col-md-12" >
<div class="panell">
<!-- <div class="panel-heading">
 LOGIN FORM
</div> -->
<div class="panel-body">
<form role="form" method="post">

<div class="form-group">
<label>Enter Username</label>
<input class="inpt" type="text" name="username" autocomplete="off" required />
</div>
<div class="form-group">
<label>Password</label>
<input class="inpt" type="password" name="password" autocomplete="off" required />
</div>
 <div class="form-group">
<label>Verification code : </label>
<input type="text"  name="vercode" maxlength="5" class="inpt" autocomplete="off" required style="width: 100%; height: 45px;" />&nbsp;<img src="captcha.php">
</div>  

 <button type="submit" name="login" class="subbtn">LOGIN </button>
</form>
 </div>
</div>
</div>
</div>  
<!---LOGIN PABNEL END-->            
             
 
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
 <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</script>
</body>
</html>
