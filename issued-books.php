<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from tblbooks  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:manage-books.php');

}


    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Manage Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                            <li><a href="issued-books.php" style="font-weight: bold;" class="menu-top-active" >Issued Books</a></li>

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
    

            <div class="row ab">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default" style="box-shadow: rgb(0 0 0 / 35%) 0px 0px 20px">
                        <div class="panel-heading">
                          Issued Books 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>ISBN </th>
                                            <th>Issued Date</th>
                                            <th>Return Date</th>
                                            <th>Fine in(USD)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sid=$_SESSION['stdid'];
$sql="SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td class="center"><?php echo htmlentities($result->BookName);?></td>
                                            <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                            <td class="center"><?php echo htmlentities($result->IssuesDate);?></td>
                                            <td class="center"><?php if($result->ReturnDate=="")
                                            {?>
                                            <span style="color:red">
                                             <?php   echo htmlentities("Not Return Yet"); ?>
                                                </span>
                                            <?php } else {
                                            echo htmlentities($result->ReturnDate);
                                        }
                                            ?></td>
                                              <td class="center"><?php echo htmlentities($result->fine);?></td>
                                         
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
