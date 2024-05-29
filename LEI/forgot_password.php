<?php
session_start(); // Start session at the beginning of the script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EmailOrPhone = trim($_POST["email_or_phone"]);
    $method = trim($_POST["method"]);
    $error = "";

    if (empty($EmailOrPhone)) {
        $error = "Email or Phone number is required.";
    } else {
        include 'connections.php';
        
        // Check if user exists in the database
        $sql = "SELECT Email, phone FROM login_table WHERE Email = ? OR phone = ?";
        if ($stmt = mysqli_prepare($connections, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $EmailOrPhone, $EmailOrPhone);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $db_email, $db_phone);
                    mysqli_stmt_fetch($stmt);
                    
                    // Generate reset code
                    $reset_code = rand(100000, 999999);
                    
                    // Store the reset code and method in the session
                    $_SESSION['reset_code'] = $reset_code;
                    $_SESSION['method'] = $method;
                    $_SESSION['email_or_phone'] = $EmailOrPhone;

                    // Send the reset code via the chosen method
                    if ($method == 'email' && !empty($db_email)) {
                        sendEmail($db_email, $reset_code);
                    // } elseif ($method == 'phone' && !empty($db_phone)) {
                    //     sendSMS($db_phone, $reset_code);
                    // 
                    } 
                    else {
                        $error = "The chosen method is not available for this account.";
                    }

                    if (empty($error)) {
                        header("location: reset_password");
                        exit();
                    }
                } else {
                    $error = "No account found with that email or phone number.";
                }
            } else {
                $error = "Something went wrong. Please try again.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($connections);
    }
}

function sendEmail($email, $code) {
    require '/xampp/htdocs/LEI/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP server
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'ShiftndSched@gmail.com'; // SMTP username
    $mail->Password = 'zwsl oqug asse gbxg';
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    $mail->setFrom('shiftndsched@gmail.com', 'Shift & Scheduling System');
    $mail->addAddress($email); // Add a recipient

    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Password Reset Code';
    $mail->Body = "This is the code to reset your password: $code";

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

// function sendSMS($phone, $code) {
//     // Replace these with your Twilio credentials and phone number
//     $account_sid = 'your_twilio_account_sid';
//     $auth_token = 'your_twilio_auth_token';
//     $twilio_number = 'your_twilio_phone_number';

//     // Initialize Twilio client
//     $client = new Twilio\Rest\Client($account_sid, $auth_token);

//     // Use the Twilio client to send an SMS
//     try {
//         $message = $client->messages->create(
//             $phone,
//             array(
//                 'from' => $twilio_number,
//                 'body' => "Your password reset code is: $code"
//             )
//         );
//     } catch (Exception $e) {
//         echo 'Error sending SMS: ' . $e->getMessage();
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
                            <h2>Forgot Password</h2>
                        </div>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <div class="input-group mb-3">
                            <select name="method" class="form-control">
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="email_or_phone" class="form-control" placeholder="Enter your email or phone number">
                        </div>
                        
                        <div class="input-group mb-3">
                            <button class="btn btn-primary" type="submit">Send Reset Code</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
