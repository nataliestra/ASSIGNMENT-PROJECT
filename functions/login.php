<?php
require_once "../configs/connection.php";

session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];   

        $sql = "SELECT * FROM `users` WHERE `email`=:email";
        $query = $conn->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();

        if($query->rowCount() > 0){

            $row = $query->fetch(PDO::FETCH_ASSOC);

            $pass = $row['Password'];
            $type = $row['UserType'];

if(md5($password) == $pass){
        
$sql1 = "UPDATE `users` SET `AccessTime`= NOW() WHERE `email`='$email'";
$conn->exec($sql1);

                if ($type == "Super_User") {
                $_SESSION['supname'] = $row['userId'];
                header("Location: ../super_user.php");
                }else if ($type == "Administrator") {
                $_SESSION['adminame'] = $row['userId'];       
                header("Location: ../administrator.php");
                }else if ($type == "Author") {
                $_SESSION['authname'] = $row['userId'];
                $_SESSION['authname1'] = $row['email'];
                $_SESSION['authname2'] = $row['Full_Name'];                       
                header("Location: ../author.php");
                }
            }else{
                echo "Incorrect Password.";
            }
        }else{
            echo "User does not exist.";
        }
}
           
?>
