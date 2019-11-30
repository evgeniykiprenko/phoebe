<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Phoebe</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="index.php">
            <img src="/phoebe/public/assets/img/logo.png" width="135" height="50" alt="Phoebe">
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
                        <a href="/phoebe/public/templates/registrationPage.php" class="text-white">Sign up</a>
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
                        <a href="/phoebe/public/templates/profile.php?id=' . $_SESSION['id'] . '" class="text-white">Profile</a>
                    </button>
                </span>
                <span>
                    <button type="button" class="btn btn-danger logout-button">
                        <a href="/phoebe/controllers/logoutController.php" class="text-white">Logout</a>   
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
                        <form action="/phoebe/controllers/authController.php" method="post">
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password:</label>
                                <input type="password" class="form-control" id="pwd" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- temporary part (file.txt also) -->
    <div class="container">
        <h3>External API: Load GitHub users</h3>
        <button id="button">Load user</button>
        <br><br>
        <h4>Gitub users</h4>
        <div id="users"></div>
    </div>

    <script>
        document.getElementById('button').addEventListener('click', loadUsers);
        
        //Load GitHub Users

        function loadUsers() {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://api.github.com/users', true);
            
            xhr.onload = function() {
                if (this.status == 200) {
                    let users = JSON.parse(this.responseText);
                    
                    let output = '';

                    for (const i in users) {
                        output +=
                            '<div class="user">' +
                            '<img src="' + users[i].avatar_url + '"width="70"' +
                            'height="70">' + 
                            '<ul>' +
                            '<li>ID: ' + users[i].id + '</li>' +
                            '<li>Login: ' + users[i].login + '</li>' +
                            '</ul>' +
                            '</div>';
                    }

                    document.getElementById('users').innerHTML = output;
                }
            }

            xhr.send();
        }

        
    </script>
</body>

</html>