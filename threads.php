<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <title>I-Discuss</title>
    <style>
         body {
        font-family: 'Helvetica Neue', sans-serif;
    }
    .img_user {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .font {
        font-size: 13px;
    }

    </style>
</head>

<body>

    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php         
    
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            $tTitle = $row['thread_title'];
            $tDesc = $row['thread_desc'];
            $threadUserId = $row['thread_user_id'];
            $sql2 = "SELECT user_name FROM `users` WHERE sno='$threadUserId'";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $threadUserName = $row2['user_name'];

        }
        ?>

    <?php
$show_alert = false; 
$method = $_SERVER['REQUEST_METHOD']; 

if($method == 'POST'){
    $content_comment = $_POST['comment'];
        $content_comment = str_replace("<", "&lt", $content_comment);
        $content_comment = str_replace(">", "&gt", $content_comment);
    $sno = $_POST['sno'];     


    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
            VALUES ('$content_comment', '$id', '$sno', current_timestamp())";
    $result = $conn->query($sql);   
    $show_alert = true; 

    if($show_alert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You have successfully added the comment to this thread.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        
        // Change the URL using JavaScript
        echo '<script>
                window.history.replaceState(null, null, window.location.href);
              </script>';
    }
}
?>


    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $tTitle;?></h1>
            <p class="lead"><?php echo $tDesc;?> </p>
            <hr class="my-4">
            <p>It a peer to peer forum where you can share the knowlege with each other. No Spam / Advertising /
                Self-promote in the forums. Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM users asking for
                help.
                Remain respectful of other members at all times.</p>

            <p>Posted by: <em><?php echo $threadUserName; ?></em></p>
        </div>
    </div>
<input type="hidden" name="sno">

<?php 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo  '<div class="container mt-3">
        <h3>Post A Comment</h3>
        <form class="col-md-6 mb-3 p-0" action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="commentForm">
            <div class="mb-3">
                <label for="comment" class="form-label">Type Your Comment below:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" oninput="checkForm()"></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-success" id="submitBtn" disabled>Submit</button>
        </form>
    </div>';

    echo '<script>
    function checkForm() {
        var comment = document.getElementById("comment").value.trim();
        var submitBtn = document.getElementById("submitBtn");

        submitBtn.disabled = comment === ""; // Enable/disable button based on input
    }

    document.getElementById("commentForm").onsubmit = function() {
        var comment = document.getElementById("comment").value.trim();

        if (comment === "") {
            alert("The comment field is required!");
            return false; // Prevent form submission if comment is empty
        }
    }
    </script>';

} else {
    echo '
    <div class="container mt-3">
    <h3>Post A Comment</h3>
    <p class="lead mt-3"><b>You are not Logged In, please Login to post a comment:</b></p>
    </div>';
}
?>

    <div class="container">
        <h3>Discussions</h3>
        <?php         
    
    
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $dt = $row['comment_time'];
            $timestamp = strtotime($dt);
            $formattedDate = date('l, F j, Y, m:i:s', $timestamp);

            $commentUser = $row['comment_by'];
            $sql2 = "SELECT user_name FROM `users` WHERE sno='$commentUser'";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $commentUserName = $row2['user_name'];

        
        echo '<div class="d-flex mt-3 mb-5">
             <div class="flex-shrink-0 img_user">
                <img src="img/user.png" width="45px;" alt="user_image">
                
            </div>
            <div class="d-block">
            <div class="ms-3"><b>Commented By: ' . $commentUserName .' </b></div>
            <div class="ms-3"> ' . $formattedDate  .' </div>
            <div class="flex-grow-1 ms-3">
                ' . $content  .'
            </div>
            </div>

        </div>';

    }
    ?>

    </div>
    <?php include 'partials/_footer.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

</body>

</html>