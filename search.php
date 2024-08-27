<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <title>Tech Forum</title>

    <style>
    body {

        font-family: 'Helvetica Neue', sans-serif;
    }

    .container {
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_header.php'; ?>


    <div class="container mt-3">
        <div class="searchResults">
            <h1>Search Result For "<?php echo $_GET['search']?>"</h1>
            <?php 
            $noResult = true;
            $query = $_GET["search"];
            $sql = "SELECT * FROM threads WHERE match (thread_title, thread_desc) against ('$query')";
            $result = $conn->query($sql);

            
                while($row = mysqli_fetch_assoc($result)){
                    $tTitle = $row['thread_title'];
                    $tDesc = $row['thread_desc'];
                    $id = $row['thread_id'];
                    $url = "threads.php?threadid=". $id;
                    $noResult = false;
            
                    echo '<div class="jumbotron">
                           <div class="results">
                                <h3><a href="' . $url . '" class="text-dark">' . $tTitle . '</a></h3>
                               <p>' . $tDesc . '</p>
                            </div>
                          </div>';
                }
                
                if($noResult){
                   echo ' <div class="jumbotron">
                    <h3>Not found any result for " ' . $query . '". </h3>
                   <h5>Suggestions:</h5> 
                   <ul>
                   <li>Make sure that all words are spelled correctly.</li>
                   <li>Try different keywords.</li>
                   <li>Try more general keywords.</li>
                   <li>Try fewer keywords.</li>

                   </ul>
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