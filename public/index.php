<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Phoebe</title>
</head>
<body>
<nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="index.php">
        <img src="assets/img/logo.png" width="135" height="50" alt="Phoebe">
    </a>

    <?php
    if (empty($_SESSION['email'])) {
        echo '<div class="text-right">
                <span>
                    <button type="button" class="btn btn-success nav-button" data-toggle="modal" data-target="#myModal">
                        Sign in
                    </button>
                </span>
                <span>
                    <button type="button" class="btn btn-info nav-button">
                        <a href="templates/registrationPage.php" class="text-white">Sign up</a>
                    </button>
                </span>
            </div>';
    } else {
        echo '<div class="text-right">
                <span>
                    <h4 id="greeter" class="my-2">Hello, ' . $_SESSION['firstName'] . '!</h4>
                </span>
                <span>
                    <button type="button" class="btn btn-info nav-button">
                        <a href="templates/profile.php?id=' . $_SESSION['id'] . '" class="text-white">Profile</a>
                    </button>
                </span>
                <span>
                    <button type="button" class="btn btn-danger logout-button">
                        <a href="../controllers/logoutController.php" class="text-white">Logout</a>   
                    </button>
                </span>
            </div>';
    }
    ?>
</nav>

<div class="container">

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sign in</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="../controllers/authController.php" method="post">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" name="password" required>>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <?php
        $servername = "localhost";
        $dbUser = "root";
        $dbPassword = "root";
        $database = "phoebe";

        $conn = new mysqli($servername, $dbUser, $dbPassword, $database);
        if ($conn->connect_error) {
            //this is a temporary solution, just to prevent showing details of our DB
            die('Oops, something went wrong! Try again, please.');
        }

        $sql = "SELECT id, first_name, last_name, email FROM users WHERE role_id = 2;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<div class="py-5">
                  <table class="table table-hover table-bordered">
                  <thead>
                   <tr>
                    <td>#</td>
                    <td>First name</td>
                    <td>Last name</td>
                    <td>Email</td>
                   </tr>
                   </thead>';
            while ($row = $result->fetch_assoc()) {
                echo "<tbody>
                      <tr>
                        <td><a href='templates/profile.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["email"] . "</td>
                      </tr>
                      </tbody>";
            }
            echo '</table></div>';
        } else {
            echo '<p>Nothing to show :(</p>';
        }
        ?>
    </div>
</div>
</body>
</html>
