<?php
session_start();

include 'connections.php';

$reset_code_err = $new_password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reset_code = trim($_POST["reset_code"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    
    // Validate reset code
    if (empty($reset_code)) {
        $reset_code_err = "Reset code is required.";
    } elseif ($reset_code != $_SESSION['reset_code']) {
        $reset_code_err = "Invalid reset code.";
    }
    
    // Validate new password
    if (empty($new_password)) {
        $new_password_err = "New password is required.";
    } elseif (strlen($new_password) < 8) { // Example: Minimum password length check
        $new_password_err = "Password must be at least 8 characters.";
    }
    
    // Validate confirm password
    if (empty($confirm_password)) {
        $confirm_password_err = "Please confirm your new password.";
    } elseif ($new_password != $confirm_password) {
        $confirm_password_err = "Passwords do not match.";
    }
    
    // If no errors, proceed to update password
    if (empty($reset_code_err) && empty($new_password_err) && empty($confirm_password_err)) {
        // Retrieve email or phone from session
        $email_or_phone = $_SESSION['email_or_phone'];
        
        // Update password in the database without hashing
        $sql = "UPDATE login_table SET password = ? WHERE Email = ? OR phone = ?";
        if ($stmt = mysqli_prepare($connections, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $new_password, $email_or_phone, $email_or_phone);
            if (mysqli_stmt_execute($stmt)) {
                session_destroy(); // Destroy session after successful password reset
                header("location: login"); // Redirect to login page
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Database connection error: " . mysqli_error($connections);
        }
        
        mysqli_close($connections);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 right-box">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="row align-items-center">
                        <div class="header-text mb-4">
                            <h2>Reset Password</h2>
                        </div>
                        <div class="form__input-error-message form_message--error"><?php echo $reset_code_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="text" name="reset_code" class="form-control" placeholder="Enter reset code">
                        </div>
                        <div class="form__input-error-message form_message--error"><?php echo $new_password_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="password" name="new_password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form__input-error-message form_message--error"><?php echo $confirm_password_err; ?></div>
                        <div class="input-group mb-3">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-primary" type="submit">Reset Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
