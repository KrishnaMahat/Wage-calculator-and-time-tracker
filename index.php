<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
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
.textbox {
    width: 80%;
    position: absolute;
    color: white;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: black;
}

.textbox h1 {
    font-size: 50px;
}

.textbox p {
    font-size: 20px;
}

.register-btn {
    display: inline-block;
    text-decoration: none;
    color: black;
    border: 2px solid black;
    border-radius: 8px;
    margin-top: -10px;
    padding: 8px 24px;
    font-size: 15px;
    background: transparent;
    position: relative;
    cursor: pointer;
}

.register-btn:hover {
    border: 2px solid green;
    background: green;
    color: white;
    border-radius: 8px;
}
</style>
<body>  
    <nav class="navbar navbar-light bg-light px-5">
        <a class="navbar-brand" href="/pay">Hourly pay tracker</a>
        <form class="form-inline">
            <a class="btn btn-outline-success my-2 my-sm-0" href="login.php">Login</a>
        </form>
    </nav>
    <div class="textbox">
        <h1>Welcome to Hourly Tracker</h1>
        <p>Track your work hours and wages.</p><br>
        <a href="register.php" class="register-btn">Register Here!</a>
    </div>
</body>
</html>
