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

<body>  
    <nav class="navbar navbar-light bg-light px-5">
        <a class="navbar-brand" href="/pay">Hourly pay tracker</a>
        <form class="form-inline">
            <a class="btn btn-outline-success my-2 my-sm-0" href="register.php">Register</a>
        </form>
    </nav>

    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'hourly_pay');

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $count = 0;
    $query = "SELECT * FROM personal_info ";
    $result = $mysqli->query($query);

    // Password validation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputPhone = $_POST['phone'];
        $inputPassword = $_POST['password'];

        while ($row = $result->fetch_assoc()) {
            $phone = $row['phone'];
            $password = $row['password'];
            if (password_verify($inputPassword, $password) && $inputPhone == $phone) {
                $count++;
                $_SESSION['id'] = $row['id'];
            }
        }

        if ($count == 0) {
            echo "<script>toastr.error('Credential does not match');</script>";
            echo "<script>setTimeout(function() {";
            echo "    window.location.href = 'login.php';";
            echo "}, 2000);</script>";
        } elseif ($count == 1) {
            echo "<script>toastr.success('Login Successful');</script>";
            echo "<script>setTimeout(function() {";
            echo "    window.location.href = 'set.php';";
            echo "}, 2000);</script>";
        }
    }
    $mysqli->close();
    ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form action="" method="POST">
                    <div class="card">
                        <div class="card-header">Login</div>
                        <div class="card-body gap-1">
                            <div class="form-group mt-2">
                                <label for="phone">Phone:</label>
                                <input type="text" placeholder="Your phone" class="form-control" id="phone" name="phone"/>
                            </div>
                            <div class="form-group mt-2">
                                <label for="address">Password:</label>
                                <input type="password" placeholder="Your secret code" class="form-control" id="password" name="password"/>     
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
