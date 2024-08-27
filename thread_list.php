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
    .border-custom {
        border: 2px solid black;
        width: 400px;
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
    
    $catid = $_GET['id'];
    $sql = "SELECT * FROM `categories` WHERE category_id = $catid";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            $catName = $row['category_name'];
            $catDesc = $row['category_description'];

        }
        ?>

    <?php
     $show_alert = false; 
     $method = $_SERVER['REQUEST_METHOD']; 
        if($method == 'POST'){

            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];  

            $th_title = str_replace("<", "&lt", $th_title);
            $th_title = str_replace(">", "&gt", $th_title);

            $th_desc = str_replace("<", "&lt", $th_desc);
            $th_desc = str_replace(">", "&gt", $th_desc); 

            $sno = $_POST['sno'];        

            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`)
             VALUES ('$th_title', '$th_desc', '$catid', '$sno', current_timestamp())";
            $result = $conn->query($sql);   
            $show_alert = true; 
           
            if($show_alert){

                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Question has successfully added, wait for the response.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        
            }

    }
    ?>

    <div class="container mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catName;?> forums</h1>
            <p class="lead"><?php echo $catDesc;?> </p>
            <hr class="my-4">
            <p>It a peer to peer forum where you can share the knowlege with each other. No Spam / Advertising /
                Self-promote in the forums. Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images. Do not cross post questions. Do not PM users asking for
                help.
                Remain respectful of other members at all times.</p>
            <p class="lead">
                <a class="btn btn-outline-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <div class="container mt-3">

    <?php  
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<h2>Start A Discussion</h2>

        <form class="col-6 mb-3 p-0" action="' . $_SERVER['REQUEST_URI'] . '" method="post" id="discussionForm">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" oninput="checkForm()">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Elaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3" oninput="checkForm()"></textarea>
                <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
            </div>
            <button type="submit" class="btn btn-success" id="submitBtn" disabled>Submit</button>
        </form>

        <div class="border-custom m-auto"></div>';

    echo '<script>
        function checkForm() {
            var title = document.getElementById("title").value.trim();
            var desc = document.getElementById("desc").value.trim();
            var submitBtn = document.getElementById("submitBtn");

            if (title !== "" && desc !== "") {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }

    </script>';

}else{
    echo '
    <h2>Start A Discussion</h2>
    <p class="lead mt-3"><b>You are not Logged In, please Login to start discussion:</b></p>';
}
?>



        <h2 class="mt-3">Browse Questions</h2>

        <?php         
                
    $catid = $_GET['id'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $catid";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['thread_id'];
            $tTitle = $row['thread_title'];
            $tDesc = $row['thread_desc'];
            $dt = $row['timestamp'];
            $timestamp = strtotime($dt);
            $formattedDate = date('l, F j, Y, m:i:s', $timestamp);

            $threadUserId = $row['thread_user_id'];
            $sql2 = "SELECT user_name FROM `users` WHERE sno='$threadUserId'";
            $result2 = $conn->query($sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $threadUserName = $row2['user_name'];
        
        echo '<div class="d-flex mt-3 mb-5">
            <div class="flex-shrink-0 img_user">
            <img src="img/user.png" width="45px;" alt="user_image">
            </div>
            <div class="d-block">
               <div class="ms-3"><b>Asked By: ' . $threadUserName.' </b></div>
               <div class="ms-3 font"> ' . $formattedDate  .' </div>
               <div class="flex-grow-1 ms-3">
                <h5 class="mt-0"> <a href="threads.php?threadid=' . $id . '"> ' . $tTitle  .'</a></h5>
                ' . $tDesc  .'
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