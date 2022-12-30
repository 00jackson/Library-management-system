<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:../adminlogin.php');

}
else{ 

if(isset($_POST['add']))
{
$bookname=$_POST['bookname'];
$category=$_POST['category'];
$author=$_POST['author'];
$isbn=$_POST['isbn'];
$price=$_POST['price'];
$sql="INSERT INTO  tblbooks(BookName,CatId,AuthorId,ISBNNumber,BookPrice) VALUES(:bookname,:category,:author,:isbn,:price)";
$query = $dbh->prepare($sql);
$query->bindParam(':bookname',$bookname,PDO::PARAM_STR);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':author',$author,PDO::PARAM_STR);
$query->bindParam(':isbn',$isbn,PDO::PARAM_STR);
$query->bindParam(':price',$price,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Book Listed successfully";
header('location:manage-books.php');
}
else 
{
$_SESSION['error']="Something went wrong. Please try again";
header('location:manage-books.php');
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
    <title>Online Library Management System | Add Book</title>
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

    <!-- LOGO HEADER END-->
    <section class="menu-section">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle " data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars threebar" aria-hidden="true"></i>
                </button>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    <div class="navbar-collapse collapse ">
                        <ul id="menu-top" class="nav navbar-nav navbar-right">
                            <li><a href="dashboard.php" >DASHBOARD</a></li>
                           
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Categories <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropp" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-category.php">Add Category</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-categories.php">Manage Categories</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Authors <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropp" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-author.php">Add Author</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-authors.php">Manage Authors</a></li>
                                </ul>
                            </li>
 <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropp" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="add-book.php" class="menu-top-active">Add Book</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-books.php">Manage Books</a></li>
                                </ul>
                            </li>

                           <li>
                                <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Issue Books <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu dropp" role="menu" aria-labelledby="ddlmenuItem">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="issue-book.php">Issue New Book</a></li>
                                     <li role="presentation"><a role="menuitem" tabindex="-1" href="manage-issued-books.php">Manage Issued Books</a></li>
                                </ul>
                            </li>
                             <li><a href="reg-students.php">Reg Students</a></li>
                    
                         <li><a href="change-password.php">Change Password</a></li>
                         <li><a href="logout.php" class="log" style="font-weight: bold; background: #ff8e41; font-weight: bold; color: #02151f;"><i class="glyphicon glyphicon-log-out" aria-hidden="true"></i>&nbsp;Logout</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
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
                                    -webkit-font-smoothing: antialiased;" >ADD BOOKS</p>
                    </div>
                
                            </div>

</div>
<div class="row ab">
<div class="col-md-12">
<div class="panell mpanel" style="width:70%;">
<div class="panel-body">
<form role="form" method="post">
    <div class="row">
        <div class="form-group col-md-12">
          <label>Book Name :</label>
          <input class="inpt" type="text" name="bookname" autocomplete="off"  required />
        </div>
    </div>
   <div class="row">
        <div class="form-group col-md-6">
          <label>Category :</label>
          
          <select class="inpt" name="category" required="required">
            <option hidden> Select Category</option>
            <?php 
            $status=1;
            $sql = "SELECT * from  tblcategory where Status=:status";
            $query = $dbh -> prepare($sql);
            $query -> bindParam(':status',$status, PDO::PARAM_STR);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            {               ?>  
            <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->CategoryName);?></option>
             <?php }} ?> 
           </select>

        </div>
        <div class="form-group col-md-6">
          <label>Author :</label>
          
          <select class="inpt" name="author" required="required">
            <option hidden> Select Author</option>
            <?php 

            $sql = "SELECT * from  tblauthors ";
            $query = $dbh -> prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            {               ?>  
            <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->AuthorName);?></option>
             <?php }} ?> 
           </select>
        </div>
    </div>

<div class="form-group">
<label>ISBN Number</label>
<input class="inpt" type="text" name="isbn"  required="required" autocomplete="off"  />
<p class="help-block">An ISBN is an International Standard Book Number.ISBN Must be unique</p>
</div>

 <div class="form-group">
 <label>Price</label>
 <input class="inpt" type="text" name="price" autocomplete="off"   required="required" />
 </div>
<button type="submit" name="add" class="subbtn">Add </button>

                                    </form>
                            </div>
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
