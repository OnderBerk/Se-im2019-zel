<?php
session_start();
if (isset($_GET['error'])) {
    echo "<center><b>You dont have permission to visit that website. Please login as an admin.</center></b> ";
}
require_once './db.php';
if (isset($_POST["btnLogin"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $stmt = $db->prepare("SELECT * FROM login WHERE user_email = ?");
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if ($pass == $row["user_pass"]) {
            if ($row["type"] == 1) {
                $_SESSION["type"] = $row["type"];
                $_SESSION["user_fullname"] = $row["user_fullname"];
                header("Location: admin.php");
                exit;
            } else if ($row["type"] == 2) {
                $_SESSION["type"] = $row["type"];
                $_SESSION["user_fullname"] = $row["user_fullname"];
                header("Location: user.php");
                exit;
            }
        }
    }
    $log_err = true;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Ankara Yerel Seçimleri 2019</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
                <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
                    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
                        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
                            <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
                                <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
                                    <link rel="stylesheet" type="text/css" href="css/util.css">
                                        <link rel="stylesheet" type="text/css" href="css/main.css">
                                            </head>
                                            <body>

                                            <div class="limiter">
                                                <div class="container-login100" style="background-image: url('image/1.jpg');">
                                                    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                                                        <form class="login100-form validate-form" method="post" action="">
                                                            <span class="login100-form-title p-b-49">
                                                                2019 Ankara Yerel Seçimleri 
                                                            </span>

                                                            <div class="wrap-input100 validate-input m-b-23" data-validate = "Email is required">
                                                                <span class="label-input100">Email</span>
                                                                <input class="input100" type="email" name="email" placeholder="Type your email">
                                                                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                                                            </div>

                                                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                                                <span class="label-input100">Password</span>
                                                                <input class="input100" type="password" name="pass" placeholder="Type your password">
                                                                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                                                            </div>

                                                            <div class="text-right p-t-8 p-b-31">
                                                                <?php
                                                                if (isset($log_err)) {
                                                                    echo '<p>Login Error</p>';
                                                                } else
                                                                if (isset($_GET['authError'])) {
                                                                    echo '<p>Authentication Required</p>';
                                                                }
                                                                ?>
                                                            </div>

                                                            <div class="container-login100-form-btn">
                                                                <div class="wrap-login100-form-btn">
                                                                    <div class="login100-form-bgbtn"></div>
                                                                    <button class="login100-form-btn" type="submit" name="btnLogin">
                                                                        GİRİŞ
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
                                            <script src="vendor/animsition/js/animsition.min.js"></script>
                                            <script src="vendor/bootstrap/js/popper.js"></script>
                                            <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                                            <script src="vendor/select2/select2.min.js"></script>
                                            <script src="vendor/daterangepicker/moment.min.js"></script>
                                            <script src="vendor/daterangepicker/daterangepicker.js"></script>
                                            <script src="vendor/countdowntime/countdowntime.js"></script>
                                            <script src="js/main.js"></script>
                                            </body>
                                            </html>