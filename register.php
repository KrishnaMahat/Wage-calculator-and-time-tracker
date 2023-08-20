<?php
session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <title>Wage Calculator</title>
</head>
<style>
 

</style>
<body>  
    <nav class="navbar navbar-light bg-light px-5">
        <a class="navbar-brand" href="/pay">Hourly pay tracker</a>
        <form class="form-inline">
            <a class="btn btn-outline-success my-2 my-sm-0" href="login.php">Login</a>
        </form>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="" method="POST">
                    <div class="card">
                        <div class="card-header">Registration</div>
                        <div class="card-body gap-1">
                            <div class="form-group mt-2">
                                <label for="title">Name:</label>
                                <input type="text" placeholder="Your name" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="phone">Phone:</label>
                                <input type="text" placeholder="Your phone" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="address">Password:</label>
                                <input type="password" placeholder="Your secret code" class="form-control" id="password" name="password" required>     
                            </div>
                            <div class="form-group mt-2">
                                <label for="prefered_role">Organization</label>
                                <input type="text" placeholder="Your working Organization" class="form-control" id="organization" name="organization" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="prefered_role">Hour Rate</label>
                                <input type="text" placeholder="Your hourly rate" class="form-control" id="rate" name="rate" required>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $organization = $_POST['organization'];
    $rate = $_POST['rate'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Perform database insertion
    $mysqli = new mysqli('localhost', 'root', '', 'hourly_pay');

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $insertQuery = "INSERT INTO personal_info (name, phone, password, organization, rate) 
                    VALUES ('$name', '$phone', '$password', '$organization', '$rate')";

    if ($mysqli->query($insertQuery) === TRUE) {
        $insertedId = $mysqli->insert_id;
        $_SESSION['id'] = $insertedId;
        echo "<script>toastr.success('Information registered');";
        echo "setTimeout(function() {";
        echo "    window.location.href = 'set.php';";
        echo "}, 2000);";
        echo "</script>";
    } else {
        echo "Error inserting data: " . $mysqli->error;
    }

    $mysqli->close();
}
?>
