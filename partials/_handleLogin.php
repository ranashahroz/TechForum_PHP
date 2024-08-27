<?php

$showError = "false";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = $conn->query($sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_pass'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;

            
    }           echo '<script>
                window.location.href = "/forum/index.php";
            </script>';
        exit(); 
    }
                echo '<script>
                window.location.href = "/forum/index.php";
            </script>';
            exit(); 
    }

?>
