<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <title>Tech-Forum</title>
    <style>
     body {
        font-family: 'Helvetica Neue', sans-serif;
    }
    h1 {
        margin-bottom: 40px;
    }

    label {
        color: #333;
    }

    .btn-send {
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        width: 80%;
        margin-left: 3px;
    }

    .help-block.with-errors {
        color: #ff5050;
        margin-top: 5px;

    }

    .card {
        margin-left: 10px;
        margin-right: 10px;
    }
    </style>
</head>

<body>

    <?php include 'partials/_header.php'; ?>
    <?php include 'partials/_dbconnect.php'; ?>

    <?php
     $show_alert = false; 
     $method = $_SERVER['REQUEST_METHOD']; 
        if($method == 'POST'){

            $name = $_POST['name'];
            $email = $_POST['email']; 
            $message = $_POST['message'];        

            $sql = "INSERT INTO `contact` (`user_name`, `user_email`, `message`, `timestamp`) VALUES ('$name', '$email', '$message', current_timestamp())";
            $result = $conn->query($sql);   
            $show_alert = true; 
           
            if($show_alert){

                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your message has been sent.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        
            }

    }

    ?>

    <div class="container">
        <div class=" text-center mt-5 ">
            <h1>Contact Us</h1>
        </div>

        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <form id="contact-form" role="form" action="<?php $_SERVER['REQUEST_URI']; ?>" method="post">
                                <div class="controls">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_name">Name *</label>
                                                <input id="form_name" type="text" name="name" class="form-control"
                                                    placeholder="Please enter your firstname *" required="required"
                                                    data-error="Firstname is required.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_email">Email *</label>
                                                <input id="form_email" type="email" name="email" class="form-control"
                                                    placeholder="Please enter your email *" required="required"
                                                    data-error="Valid email is required.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_message">Message *</label>
                                                <textarea id="form_message" name="message" class="form-control"
                                                    placeholder="Write your message here." rows="4" required="required"
                                                    data-error="Please, leave us a message."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <input type="submit" class="btn btn-success btn-send  pt-2 btn-block
                            " value="Send Message">

                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>

    <?php include 'partials/_footer.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

</body>

</html>