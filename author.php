<?php
require_once 'configs/connection.php';
session_start();

if (!isset($_SESSION['authname']) && !isset($_SESSION['authname1']) && !isset($_SESSION['authname2'])) {
    header("Location: index.html");
}else{
  $filter = $_SESSION['authname'];
$sql = "SELECT * FROM `users` WHERE `userId` = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$filter]);
$row1 = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" >
    <meta name="author" content="Devcrud">
    <title>My Assignment</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/meyawo.css">
</head>

            <script type="text/javascript">
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

       <style type="text/css">
        
          table{
    align-items: center;
    color: black;
  }

   th, tr, td{
    padding: 10px 10px;
  }

  label{
    color: white;
  }
    </style>

<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page Navbar -->
    <nav class="custom-navbar" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="logo" href="#">My Assignment</a>         
        </div>          
    </nav><!-- End of Page Navbar -->

    <!-- page header -->
    <header id="home" class="header">
        <div class="overlay"></div>
        <div class="header-content container">
            <h1 class="header-title">
                <span class="up">Welcome <?php echo $row1['UserType']; ?>, </span>
                <span class="down"><?php echo $row1['Full_Name']; ?>!</span>
            </h1>
            <p class="header-subtitle"></p>            

            <button class="btn btn-primary" ><a href="functions/logout.php" style="color: white;">Logout</a></button>
        </div>              
    </header><!-- end of page header -->

    <!-- contact section -->
    <section class="section" id="contact">
        <div class="container text-center">
            <p class="section-subtitle">Database</p>
            <h6 class="section-title mb-5">My Profile</h6>
            <!-- contact form -->
 <table>
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">#</th>
<th style="text-align: left;
  padding: 8px;">Fullname</th>
<th style="text-align: left;
  padding: 8px;">Username</th>  
  <th style="text-align: left;
  padding: 8px;">Email Address</th>
 <th style="text-align: left;
  padding: 8px;">Phone Number</th>
 <th style="text-align: left;
  padding: 8px;">Gender</th> 
 <th style="text-align: left;
  padding: 8px;">Address</th> 
 <th style="text-align: left;
  padding: 8px;">Access Time</th> 
 <th style="text-align: left;
  padding: 8px;">Image</th>      
  <th style="text-align: left;
  padding: 8px;">User Type</th>
   <th style="text-align: left; padding: 8px;"></th>
</tr>

<?php
$sql = "SELECT `userId`, `Full_Name`, `User_Name`, `phone_Number`, `email`, `Gender`, `AccessTime`, `UserType`, `Address`, `profile_Image` FROM `users` WHERE `userId` =:filter";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':filter', $filter, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
<td><?php echo($row["userId"]); ?></td>
<td><?php echo($row["Full_Name"]); ?></td>
<td><?php echo($row["User_Name"]); ?></td>
<td><?php echo($row["email"]); ?></td>
<td><?php echo($row["phone_Number"]); ?></td>
<td><?php echo($row["Gender"]); ?></td>
<td><?php echo($row["Address"]); ?></td>
<td><?php echo($row["AccessTime"]); ?></td>
<td><img style="width: 50px;" src="assets/imgs/<?php echo($row["profile_Image"]); ?>" title="<?php echo($row["Full_Name"]); ?>"></td>
<td><?php echo($row["UserType"]); ?></td>
</tr>
<?php
}
} else { echo "No results"; }

?>

</table>
<br>
<br>
        </div><!-- end of container -->
                        <div class="container text-center">
            <h6 class="section-title mb-5">Articles</h6>
            <!-- contact form -->
                         <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">#</th>
<th style="text-align: left;
  padding: 8px;">Author ID</th>
  <th style="text-align: left;
  padding: 8px;">Title</th>
  <th style="text-align: left;
  padding: 8px;">Display</th> 
  <th style="text-align: left;
  padding: 8px;">Created At</th>
    <th style="text-align: left;
  padding: 8px;">Last Updated At</th>
   <th style="text-align: left; padding: 8px;"></th>
<th style="text-align: left; padding: 8px;"></th>
</tr>

<?php
$sql = "SELECT `article_id`, `authorId`, `article_title`, `article_full_text`, `article_display`, `article_order`, `article_created_date`, `article_last_update` FROM `articles` WHERE `authorId` =:filter";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':filter', $filter, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>
<tr>
<td><?php echo($row["article_id"]); ?></td>
<td><?php echo($row["authorId"]); ?></td>
<td><?php echo($row["article_title"]); ?></td>
<td><?php echo($row["article_display"]); ?></td>
<td><?php echo($row["article_created_date"]); ?></td>
<td><?php echo($row["article_last_update"]); ?></td>
<td><button class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to delete this article?')?window.location.href='functions/main.php?action=deleteA&id=<?php echo($row["article_id"]); ?>':true;" title='Delete Article'>Delete</button></td>
<td><button class="btn btn-primary py-3 px-5" onclick="printData();" title='Print Article'>Print</button></td>
<br>
<br>
</tr>
<?php
}
} else { echo "No results"; }
?>

</table>  
<br>
<br> 
        </div><!-- end of container -->
    </section><!-- end of contact section -->

        <section class="section" id="contact">
        <div class="container text-center">
            <p class="section-subtitle">My Module</p>
            <h6 class="section-title mb-5">Update My Details</h6>
            <!-- contact form -->
                            <form action="functions/main.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input name="fname" type="text" class="form-control" placeholder="Fullname" value="<?php echo $row1['Full_Name']; ?>" required>
                                        <input type="hidden" value="<?php echo $filter; ?>" name="uid" required>
                                        <input type="hidden" value="3" name="mod" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="uname" type="text" class="form-control" placeholder="Username" value="<?php echo $row1['User_Name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="phone" type="text" class="form-control" value="<?php echo $row1['phone_Number']; ?>" placeholder="Phone Number" required>
                                    </div>

                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" value="<?php echo $row1['email']; ?>" placeholder="Email Address" required>
                                    </div>                      
                                     <div class="form-group">
                                        <input name="address" type="text" value="<?php echo $row1['Address']; ?>" class="form-control" placeholder="Address" required>
                                    </div>
                                    <div class="form-group">
                            <select class="form-control" name="gender" required>
                              <option disabled value="" selected>Select A Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>  
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Picture:</label>
                                        <br>
                                     <input name="image" type="file" accept=".jpg, .png, .jpeg" class="form-control" required>   
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" minlength="8" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <input name="cpassword" type="password" minlength="8" class="form-control" placeholder="Confirm Password" required>
                                    </div>                                                          
                                    <div class="form-group text-right">
                                        <input type="submit" name="upu" style="width: 100%;" class="btn btn-primary" value="Update">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </form>
        </div><!-- end of container -->
                <div class="container text-center">
            <h6 class="section-title mb-5">Add An Article</h6>
            <!-- contact form -->
                                <form action="functions/main.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input name="atitle" type="text" class="form-control" placeholder="Article Title" required>
                                    </div>
                                    <div class="form-group">
                                <input name="aorder" type="text" class="form-control" placeholder="Article Order" required>
                                    </div> 
                                          <div class="form-group">
                            <select class="form-control" name="adisplay" required>
                              <option disabled value="" selected>Select A Display</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>  
                                    </div>                      
                                    <div class="form-group">
                                        <textarea name="aftext" class="textarea form-control" placeholder="Article Full Text..." required></textarea>
                                    </div>                       
                                    <div class="form-group text-right">
                                        <input type="submit" name="addarticle" class="btn btn-primary" value="Add Article">
                                    </div>
                                </form>
        </div><!-- end of container -->
                        <div class="container text-center">
            <h6 class="section-title mb-5">Update An Article</h6>
            <!-- contact form -->
                                <form action="functions/main.php" method="POST" enctype="multipart/form-data">
                            <div>
                            <select class="form-control" name="gender" required>
                              <option disabled value="" selected>Select An Article</option>
                                     <?php
$sql = "SELECT * FROM `articles` WHERE `authorId` = :filter";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':filter', $filter, PDO::PARAM_INT);
$stmt->execute();

while ($category = $stmt->fetch(PDO::FETCH_ASSOC)):
?>
                                  <option value="<?php echo $category["article_id"];?>"><?php echo $category["article_title"];?></option>
                                  <?php
                                      endwhile;
                                  ?>
                           </select>  
                                    </div>
                                    <div class="form-group">
                                        <input name="atitle" type="text" class="form-control" placeholder="Article Title" required>
                                    </div>
                                    <div class="form-group">
                                <input name="aorder" type="text" class="form-control" placeholder="Article Order" required>
                                    </div> 
<!--                                  <div class="form-group">
                                        <label>Article Display:</label>
                                        <br>
                                     <input name="image" type="file" accept=".jpg, .png, .jpeg" class="form-control" required>   
                                    </div>  -->                        <div class="form-group">
                            <select class="form-control" name="adisplay" required>
                              <option disabled value="" selected>Select A Display</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                           </select>  
                                    </div>                    
                                    <div class="form-group">
                                        <textarea name="aftext" class="textarea form-control" placeholder="Article Full Text..." required></textarea>
                                    </div>                         
                                    <div class="form-group text-right">
                                        <input type="submit" name="updatearticle" class="btn btn-primary" value="Update Article">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                </form>
        </div><!-- end of container -->
    </section><!-- end of contact section -->

    <!-- footer -->
    <div class="container">
        <footer class="footer">       
            <p class="mb-0">Copyright <script>document.write(new Date().getFullYear())</script> &copy;</p>
        </footer>
    </div> <!-- end of page footer -->
    
    <!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- bootstrap 3 affix -->
    <script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- js -->
    <script src="assets/js/meyawo.js"></script>

</body>
</html>