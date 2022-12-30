<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{    
$sid=$_SESSION['stdid'];  
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];

$sql="update tblstudents set FullName=:fname,MobileNumber=:mobileno where StudentId=:sid";
$query = $dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your profile has been updated")</script>';
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
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="my-profile.php" style="font-weight: bold;" class="menu-top-active" >My Profile</a></li>
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
                    -webkit-font-smoothing: antialiased;" >My Profile</p>
                </div>
            </div>

        </div>
             <div class="row ab">
           
<div class="col-md-12">
               <div class="panell">
                        <div class="panel-body">
                            <form name="signup" method="post">
<?php 
$sid=$_SESSION['stdid'];
$sql="SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where StudentId=:sid ";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  

<div class="form-group">
<label>Student ID : </label>
<?php echo htmlentities($result->StudentId);?>
</div>

<div class="form-group">
<label>Reg Date : </label>
<?php echo htmlentities($result->RegDate);?>
</div>
<?php if($result->UpdationDate!=""){?>
<div class="form-group">
<label>Last Updation Date : </label>
<?php echo htmlentities($result->UpdationDate);?>
</div>
<?php } ?>


<div class="form-group">
<label>Profile Status : </label>
<?php if($result->Status==1){?>
<span style="color: green">Active</span>
<?php } else { ?>
<span style="color: red">Blocked</span>
<?php }?>
</div>


<div class="form-group">
<input class="inpt" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName);?>" autocomplete="off" required />
</div>


<div class="form-group">
<input class="inpt" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<input class="inpt" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>"  autocomplete="off" required readonly />
</div>
<?php }} ?>
                              
<button type="submit" name="update" class="subbtn" id="submit">Update Now </button>

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
<?php } ?>
