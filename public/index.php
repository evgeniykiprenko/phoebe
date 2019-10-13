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

    <link rel="stylesheet" href="css/index.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <title>Main page</title>
</head>
<body>
<div class="container">
    <h1>Phoebe</h1><br>
    <a href="templates/registrationPage.php">Registration!</a>
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
            echo '<table class="table table-hover table-bordered">
                   <tr>
                    <td>#</td>
                    <td>First name</td>
                    <td>Last name</td>
                    <td>Email</td>
                   </tr>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["first_name"] . "</td>
                        <td>" . $row["last_name"] . "</td>
                        <td>" . $row["email"] . "</td>
                      </tr>";
            }
            echo '</table>';
        } else {
            echo '<p>Nothing to show :(</p>';
        }
        ?>
    </div>
</div>
</body>
</html>
