<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/UI-Controllers/utils/dbUtils.php";
include $_SERVER['DOCUMENT_ROOT'] . "/UI-Controllers/utils/validationUtils.php";

$id = $_GET['id'];
$sql = "SELECT first_name, last_name, email, password, photo FROM users WHERE id = $id;";
$result = runQuery($sql);
$show = false;
$row = null;
$linkToPhoto = null;
if ($result->num_rows > 0 && $row = $result->fetch_assoc()) {
    $show = true;
    $linkToPhoto = !empty($row['photo']) ? '/public/images/' . $row['photo'] : "/public/assets/img/defaultProfilePhoto.jpg";
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/public/assets/css/main.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="/public/assets/js/validation/loginFormValidation.js"></script>
    <script src="/public/assets/js/validation/regFormValidation.js"></script>

    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="/index.php">
            <img src="/public/assets/img/logo.png" width="135" height="50" alt="Phoebe">
        </a>
        <?php
        if (empty($_SESSION['email'])) {
            echo '<div class="text-right">
                <span>
                    <button type="button" class="btn btn-success nav-button" data-toggle="modal" data-target="#loginModal">
                        Sign in
                    </button>
                </span>
                <span>
                    <button type="button" class="btn btn-info nav-button" data-toggle="modal" data-target="#regModal">
                        Sign up
                    </button>
                </span>
            </div>';
        } else {
            echo '<div class="text-right">
        <span>
            <button type="button" class="btn btn-info nav-button">
                <a href="/index.php" class="text-white">Main page</a>
            </button>
        </span>
        <span>
            <button type="button" class="btn btn-danger logout-button">
                <a href="/UI-Controllers/logoutController.php" class="text-white">Logout</a>
            </button>
        </span>
    </div>';
        }
        ?>
    </nav>

    <!-- The Modal -->
    <!-- login -->
    <div class="modal" id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sign in</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form>
                        <div id="login-form">
                            <div class="field">
                                <label for="email">Email address:</label>
                                <input type="text" id="login" name="email">
                            </div>
                            <div id="login-hint" class="hint field"></div>
                            <div class="field">
                                <label for="pwd">Password:</label>
                                <input type="password" id="pwd" name="password">
                            </div>
                            <div id="pwd-hint" class="hint field"></div>
                            <button type="button" id="login-button" class="btn btn-success" onclick="validateAndSignIn()">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- registration -->
    <div class="modal" id="regModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Sign in</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form>
                        <div id="login-form">
                            <div class="field">
                                <label for="first_name">First name:</label>
                                <input type="text" id="first_name" name="first_name">
                            </div>
                            <div id="reg-first-name-hint" class="hint field"></div>
                            <div class="field">
                                <label for="last_name">Last name:</label>
                                <input type="text" id="last_name" name="last_name">
                            </div>
                            <div id="reg-last-name-hint" class="hint field"></div>
                            <div class="field">
                                <label for="email">Email address:</label>
                                <input type="text" id="reg-login" name="email">
                            </div>
                            <div id="reg-login-hint" class="hint field"></div>
                            <div class="field">
                                <label for="pwd">Password:</label>
                                <input type="password" id="reg-pwd" name="password">
                            </div>
                            <div id="reg-pwd-hint" class="hint field"></div>
                            <button type="button" id="reg-button" class="btn btn-info" onclick="validateAndSignUp()">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <?php
        if ($show) {
            echo '<div class="row mx-md-n5">
        <div class="col px-md-5">
            <div>
                <img src="' . $linkToPhoto . '" alt="Profile photo" id="usersImage">
            </div>
        </div>
                <div class="col px-md-5">
                <form>
                  <div class="form-group row">
                    <label for="firstName" class="col col-form-label col-form-label-lg">First name:</label>
                      <input type="text" readonly class="form-control form-control-lg" id="firstName" value="' . $row['first_name'] . '">
                  </div>
                  <div class="form-group row">
                    <label for="lastName" class="col col-form-label col-form-label-lg">Last name:</label>
                      <input type="text" readonly  class="form-control form-control-lg" id="lastName" value="' . $row['last_name'] . '">
                  </div>
                  <div class="form-group row">
                    <label for="staticEmail" class="col col-form-label col-form-label-lg">Email:</label>
                      <input type="text" readonly class="form-control form-control-lg" id="staticEmail" value="' . $row['email'] . '">
                  </div>
                </form>
                <button type="button" class="btn btn-success nav-button" data-toggle="modal" data-target="#changeInfoModal">
                    Change info
                </button>';
                
        } else {
            echo "<div><p>Oops, can't get the data:(</p><a href='/index.php'>Main page</a></div>";
        }
        echo '</div>
        </div>';
        ?>

    </div>
</body>

</html>