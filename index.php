<?php include 'partials/_dbconnect.php'; ?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <title>Tech Forum</title>

    <style>
    body {
        font-family: 'Helvetica Neue', sans-serif;
    }
    .card {
        transition: transform .4s;
    }

    .card:hover {
        transform: scale(1.1);
        z-index: 1;
    }
    </style>
</head>

<body>

    <?php include 'partials/_header.php'; ?>

    <div class="container">
        <h2 class="text-center mt-3" style="font-family: fantasy;">Tech Forum Categories</h2>
        <div class="row">

            <!-- Fetch all categories -->

            <?php
        
        $sql = "SELECT * FROM `categories` ";
        $result = $conn->query($sql);

        while($row = mysqli_fetch_assoc($result)){
            $catName = $row['category_name'];
            $catId = $row['category_id'];
            $desc = $row['category_description'];
            $img = $row['category_image'];


            echo '<div class="col-lg-3 col-md-6 col-12 my-3">
            <div class="card" style="width: 18rem;">
                <img src="' . $img . '" class="card-img-top" style="height: 200px;" alt="...">
                <div class="card-body bg-success"> 
                    <h5 class="card-title"> <a class="text-decoration-none text-white" href="thread_list.php?id=' . $catId . '"> ' . $catName . '</a></h5>
                    <p class="card-text text-white"> ' . substr($desc, 0, 60) . ' ...</p>
                    <a href="thread_list.php?id=' . $catId . '" class="btn btn-primary text-white">View Threads</a>
                </div>
            </div>
        </div>';

        }
        
        
        ?>



        </div>
    </div>



    <?php include 'partials/_footer.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

</body>

</html>