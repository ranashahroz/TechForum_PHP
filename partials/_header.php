<?php 

session_start();
include 'partials/_dbconnect.php';

$sql = "SELECT * FROM `categories`";
$result = $conn->query($sql);

echo '
<nav class="navbar navbar-expand-lg bg-dark navbar-dark bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" style="font-family: fantasy;" href="#">TECH FORUM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">';

while ($row = mysqli_fetch_assoc($result)) {
    $catName = htmlspecialchars($row['category_name']);
    $catId = (int) $row['category_id'];
    echo '<li><a class="dropdown-item" href="thread_list.php?id=' . $catId . '">' . $catName . '</a></li>';
}

echo '
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/forum/contact.php">Contact</a>
        </li>
      </ul>';
      ?>




<?php

    $sql = "SELECT * FROM `users` ";
          $result = $conn->query($sql);
          while($row = mysqli_fetch_assoc($result)){
            $userName = htmlspecialchars($row['user_name']);

        }
        
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo'
        <form class="d-flex align-items-center mx-md-2" action="search.php" mthod="get">
          <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success me-2" type="submit">Search</button>
          <p class="m-0" style="width: 100%; color: #fff15b; font-weight: bold;"> Welcome: '. $userName .'</p>
          <a href="partials/_logout.php" id="logoutBtn" type="button" class="btn btn-outline-danger mx-2">Logout</a>
        </form>';

    // JavaScript to handle the logout confirmation
    echo '
    <script>
        document.getElementById("logoutBtn").addEventListener("click", function(event) {
            event.preventDefault(); // Prevents the default link behavior

            var confirmation = confirm("Are you sure you want to log out?");

            if (confirmation) {
                window.location.href = this.href; // Redirects to the logout URL if confirmed
            }
        });
    </script>';
} else {
    echo'
    <form class="d-flex align-items-center mx-md-2"  action="search.php" mthod="get">
      <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success me-2" type="submit">Search</button>
    </form>
    <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
}

echo '
    </div>
  </div>
</nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> You can now Login.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

?>