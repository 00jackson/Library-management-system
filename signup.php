<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
//code for captach verification
if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
        echo "<script>alert('Incorrect verification code');</script>" ;
    } 
        else {    
//Code for student ID
$count_my_page = ("studentid.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp); 
$StudentId= $hits[0];   
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;
$sql="INSERT INTO  tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your Registration successfull and your student id is  "+"'.$StudentId.'")</script>';
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
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
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
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
                            <li><a href="dashboard.php"  style="font-weight: bold;">DASHBOARD</a></li>
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
                            <li><a href="signup.php" class="menu-top-active" >User Signup</a></li>
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
                    -webkit-font-smoothing: antialiased;" >User Signup Page</p>
                </div>
                
            </div>

        </div>

<div class="row ab">
    <div class="col-md-12">
        <div class="panell">
            <div class="panel-body">
                <form name="signup" method="post" onSubmit="return valid();">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Enter Full Name :</label>
                      <input class="inpt" type="text" name="fullanme" autocomplete="off" required />
                    </div>
                    <div class="form-group col-md-6">
                      <label>Mobile Number :</label>
                      <input class="inpt" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-12">
                      <label>Enter Email :</label>
                      <input class="inpt" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
                      <span id="user-availability-status" style="font-size:12px;"></span>
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-6">
                      <label>Enter Password :</label>
                      <input class="inpt" type="password" name="password" autocomplete="off" required  />
                    </div>
                    <div class="form-group col-md-6">
                      <label>Confirm Password :</label>
                      <input class="inpt"  type="password" name="confirmpassword" autocomplete="off" required  />
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-12">
                      <label>Verification code :</label>
                      <input type="text"  name="vercode" class="inpt" maxlength="5" autocomplete="off" required style="width: 100%; height: 45px;" />&nbsp;<img src="captcha.php">
                    </div>
                    </div>

                    <button type="submit" name="signup" class="subbtn" id="submit">Register Now </button>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
