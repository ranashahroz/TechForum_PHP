<?php

$showError = "false";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include '_dbconnect.php';
    $email = $_POST['email'];
    $uName = $_POST['userName'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    $existsql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = $conn->query($existsql);

    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        $showError = "Email already in use";
    }else{
        if($pass == $cpass){

        $hash = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users` (`user_email`, `user_name`, `user_pass`, `timestamp`)
         VALUES ('$email', '$uName', '$hash', current_timestamp())";
        $result = $conn->query($sql);
        if($result){
            $showAlert = true;
            header("Location: /forum/index.php?signupsuccess=true");    
            exit();  
        }

    }
       header("Location: /forum/index.php?signupsuccess=false&error=$showError");
       exit();
  }

}
?>