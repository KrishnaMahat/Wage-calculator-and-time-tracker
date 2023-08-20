<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'hourly_pay');
$uid = $_SESSION['id'];

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$usernameQuery = "SELECT name FROM personal_info WHERE id = $uid";
$usernameResult = $mysqli->query($usernameQuery);
$row = $usernameResult->fetch_assoc();
$username = $row['name'];
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
    /* Custom styles for the Datepicker */
    .datepicker-input {
      background-color: #fff;
      color: #333;
      border-radius: 4px;
      box-shadow: none;
      border: 1px solid #ccc;
      padding: 0.375rem 0.75rem;
    }

    .datepicker-dropdown {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
    }

    .datepicker-dropdown td,
    .datepicker-dropdown th {
      padding: 0.5rem;
    }

    .datepicker-dropdown td span,
    .datepicker-dropdown th span {
      display: block;
      width: 100%;
      text-align: center;
    }

    .datepicker-dropdown table tr td.day:hover,
    .datepicker-dropdown table tr td.day.focused {
      background-color: #f0f0f0;
      cursor: pointer;
    }

    .datepicker-dropdown table tr td.old,
    .datepicker-dropdown table tr td.new {
      color: #aaa;
    }
</style>
<body>  
<nav class="navbar navbar-light bg-light px-5">
    <a class="navbar-brand">Hourly pay tracker</a>
    <form class="form-inline">
        <a class="btn btn-outline-success my-2 my-sm-0" href="calculate.php">Calculate</a>
        <a class="btn btn-outline-success my-2 my-sm-0" href="edit.php">Edit Info</a>
        <a class="btn btn-outline-success my-2 my-sm-0" onclick="logout()">Logout</a>
    </form>
</nav>

<div class="mt-5 text-center">Hi, <b><?php echo $username; ?></b> Set your Working Date and Time.</div>

<div class="container">
    <form method="/" id="registerSubmit">
        <table class="table table-striped table-bordered mt-3">
            <thead class="text-center">
              <th>Work Date</th>
              <th>Starting Time</th>
              <th>Ending Time</th>
              <th>Action</th>
            </thead>
            <tr class="align-middle">
                <td>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="work_date" required>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="start_time" required>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="time" class="form-control" name="end_time" required>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <input type="submit" id="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["id"])) {
        $id = $_POST["id"]; 
        $query = "DELETE FROM hourly_tracker WHERE id = $id";
        $result = $mysqli->query($query);
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsPerPage = 5;
$startIndex = ($page - 1) * $recordsPerPage;
$query = "SELECT * FROM hourly_tracker WHERE user_id = " . $uid  . " ORDER BY id DESC LIMIT $startIndex, $recordsPerPage";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    echo '<div class="mt-5 text-center"><b>Your work log.</b></div>';
    echo '<div class="table-responsive mt-2 align-items-center">';
    echo '<table class="table table-striped table-bordered mx-auto" style="max-width: 1000px;">';
    echo '<thead><tr><th>Work Date</th><th>Start Time</th><th>End Time</th><th>Hour Worked</th><th>Action</th></tr></thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $work_date = $row['work_date'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $hour_worked = $row['hour_worked'];

        echo '<tr>';
        echo '<td>' . $work_date . '</td>';
        echo '<td>' . $start_time . '</td>';
        echo '<td>' . $end_time . '</td>';
        echo '<td>' . round($hour_worked, 1) . '</td>';
        echo '<td><button class="btn btn-danger btn-sm" onclick="erase(' . $row['id'] . ')">Delete</button></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    
    $countQuery = "SELECT COUNT(*) AS total FROM hourly_tracker WHERE user_id = $uid";
    $countResult = $mysqli->query($countQuery);
    $totalCount = $countResult->fetch_assoc()['total'];

    $totalPages = ceil($totalCount / $recordsPerPage);

    echo '<div class="d-flex justify-content-center mt-3"><div class="pagination">';
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = $i == $page ? 'active' : '';
        echo '<a class="page-link ' . $activeClass . '" href="?page=' . $i . '">' . $i . '</a>';
    }
    echo '</div></div>';
    echo '</div>';
} else {
    // No rows found
    echo '<div class="text-center mt-5"><h6>No record Found</h6></div>';
    echo '</div>';
}

$result->free();
$mysqli->close();
?>

<script>
$(document).ready(function() {
    $('#submit').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'insert.php',
            method: 'POST',
            data: $("#registerSubmit").serialize(),
            success: function(response) {
                $('#submit').removeClass('btn-primary').addClass('btn-success');
                toastr.success('Hour registered Successfully');
                setTimeout(function() {
                    $('#submit').prop('disabled', false).removeClass('btn-success').addClass('btn-primary');
                    location.reload();
                }, 1000);
            }
        });
    });
});


function erase(id) {
    $.ajax({
        url: '',
        method: 'POST',
        data: { id: id },
        success: function(response) {
            toastr.error('Record deleted successfully');
            setTimeout(function() {
                location.reload();
            }, 1000);
        }
    });
}

function logout() {
    toastr.success('Logged out');
    setTimeout(function() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'set.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                window.location.href = 'index.php';
            }
        };
        xhr.send();
    }, 1000);
}
</script>
</body>
</html>
