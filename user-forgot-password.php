<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
  //code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT EmailId FROM tblstudents WHERE EmailId=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
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
    <title>Online Library Management System | Password Recovery </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

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
                          
                             <li><a href="adminlogin.php">Admin Login</a></li>
                            <li><a href="signup.php">User Signup</a></li>
                             <li><a href="index.php" class="menu-top-active" >User Login</a></li>
                          

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
                    -webkit-font-smoothing: antialiased;" >Forgot Password</p>
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
<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
   <div class="form-row">
        <div class="form-group col-md-6">
            <label>Enter Reg Email id</label>
            <input class="inpt" type="email" name="email" required autocomplete="off" />
        </div>
        <div class="form-group col-md-6">
            <label>Enter Reg Mobile No</label>
            <input class="inpt" type="text" name="mobile" required autocomplete="off" />
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-6">
           <label>Password</label>
            <input class="inpt" type="password" name="newpassword" required autocomplete="off"  />
        </div>
        <div class="form-group col-md-6">
            <label>ConfirmPassword</label>
            <input class="inpt" type="password" name="confirmpassword" required autocomplete="off"  />
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
           <label>Verification code : </label>
           <input type="text" class="inpt"  name="vercode" maxlength="5" autocomplete="off" required  style="height:45px;" />&nbsp;<img src="captcha.php">
        </div>
    </div>

    <button type="submit" name="change" class="subbtn">Chnage Password</button> 
    <div class="link"><a href="index.php">- Login -</a></div>
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

</body>
</html>
