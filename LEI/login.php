<?php
$Email = $password = "";
$EmailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Email"])) {
        $EmailErr = "Email is Required";
    } else {
        $Email = $_POST["Email"];
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is Required";
    } else {
        $password = $_POST["password"];
    }
    if ($Email && $password) {
        include("connections.php");
        $check_email = mysqli_query($connections, "SELECT Email, password, Account_type FROM login_table WHERE Email = '$Email'");
        
        $check_email_row = mysqli_num_rows($check_email);
        if ($check_email_row > 0) {
            while ($row = mysqli_fetch_assoc($check_email)) {
                $db_password = $row["password"];
                $db_account_type = $row["Account_type"];
                if ($db_password == $password) {
                    if ($db_account_type == "1") {
                        header("Location: admin/dashboard"); 
                        exit();
                    } else {
                        header("Location: user/dashboard"); 
                        exit();
                    }
                } else {
                    $passwordErr = "Incorrect password";
                }
            }
        } else {
            $EmailErr = "Email is not registered";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shift & Scheduling</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <!-- Main Container -->
    
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        

    <!-- Login Container -->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!-- Left Box -->

        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background-color: #3B4198;">
            <div class="featured-image mb-3">
                <img src="full-logo.png" class="img-fluid" style="width: 250px;">
            </div>

            <p class="text-white fs-3" style="font-family:'Courier New', Courier, monospace; font-weight: 600;">
                Hospital Management
            </p>
            <!-- <small class="text-white text-wrap text-center" style="width: 17rem; font-family:'Courier New', Courier, monospace">Empowering Healthcare Through Technological Innovation</small> -->
        </div>

    <!-- Right Box -->

        <div class="col-md-6 right-box">
            <form class="form" id="login" method="POST" action="<?php echo htmlspecialchars($_SERVER ["PHP_SELF"]); ?>">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Shift & Scheduling</h2>
                    </div>

                   
                    <div class="form__input-error-message form_message--error"><?php echo $EmailErr; ?> 
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" id="Email" name="Email" value="<?php echo $Email;?>" class="form-input form-control form-control-lg bg-light border-secondary fs-6" autofocus placeholder="Email address">                       
                    </div>
                    
                    <div class="form__input-error-message form_message--error"><?php echo $passwordErr; ?> 
                    </div>

                    <div class="input-group mb-1">
                        <input type="password" id="password" name="password" value="<?php echo $password; ?>" class="form-control form-control-lg bg-light border-secondary fs-6" autofocus placeholder="Password">
                    </div>

                    <div class="input-group mb-5 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input border-secondary" id="formCheck">
                            <label for="formCheck" class="form-check-label text-secondary">
                                <small>Remember Me</small>
                            </label>
                        </div>

                        <div class="forgot">
                            <small><a href="#">Forgot Password?</a></small>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <button class="btn btn-lg w-100 fs-6 text-white" type="submit" value="login" style="background-color: #213188;">
                        Login
                        </button>
                    </div>

                    <div class="row">
                        <small>Don't have an account? <a href="signup">Sign Up</a></small>
                    </div>
                
                </div>
        </div>

        </div>
    </div>

</body>
</html>