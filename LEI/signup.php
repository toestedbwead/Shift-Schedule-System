<?php
// Include your connections.php file
include 'connections.php';

// Define variables to store user input and error messages
$email = $password = $confirm_password = $phone = "";
$email_err = $password_err = $confirm_password_err = $phone_err = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["user"]))) {
        $email_err = "Please enter an email.";
    } else {
        // Prepare a select statement to check if email already exists
        $sql = "SELECT login_id FROM login_table WHERE Email = ?";
        if ($stmt = mysqli_prepare($connections, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            // Set parameters
            $param_email = trim($_POST["user"]);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["user"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a phone number.";
    } else {
        // Prepare a select statement to check if phone already exists
        $sql = "SELECT login_id FROM login_table WHERE phone = ?";
        if ($stmt = mysqli_prepare($connections, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phone);
            // Set parameters
            $param_phone = trim($_POST["phone"]);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $phone_err = "This phone number is already taken.";
                } else {
                    $phone = trim($_POST["phone"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";     
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["cpass"]))) {
        $confirm_password_err = "Please confirm password.";     
    } else {
        $confirm_password = trim($_POST["cpass"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into database
    if (empty($email_err) && empty($phone_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO login_table (Email, phone, password) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($connections, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_phone, $param_password);
            // Set parameters
            $param_email = $email;
            $param_phone = $phone;
            $param_password = $password; // No hashing for now
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login");
            } else {
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($connections);
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
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- Main Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100"> 
        <!-- Sign Up Container -->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background-color: #3B4198;">
                <div class="featured-image mb-3">
                    <img src="full-logo.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="text-white fs-3" style="font-family:'Courier New', Courier, monospace; font-weight: 600;">
                    Hospital Management
                </p>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Shift & Scheduling</h2>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form__input-error-message form_message--error"><?php echo $email_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="user" placeholder="Email" class="form-control form-control-lg bg-light border-secondary fs-6">
                        </div>

                        <div class="form__input-error-message form_message--error"><?php echo $phone_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="text" id="phone" name="phone" placeholder="Phone" class="form-control form-control-lg bg-light border-secondary fs-6">
                        </div>

                        <div class="form__input-error-message form_message--error"><?php echo $password_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="password" id="pass" class="form-control form-control-lg bg-light border-secondary fs-6" placeholder="Password" name="password">
                        </div>

                        <div class="form__input-error-message form_message--error"><?php echo $confirm_password_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="password" id="cpass" class="form-control form-control-lg bg-light border-secondary fs-6" placeholder="Confirm Password" name="cpass">
                        </div>

                        <div class="input-group mb-3">
                            <button type="submit" id="btn" value="SignUp" name="submit" class="btn btn-lg w-100 fs-6 text-white" style="background-color: #213188;">Create Account</button>
                        </div>

                        <div class="row">
                            <small>Already have an account? <a href="login">Sign In</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
