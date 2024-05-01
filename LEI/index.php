<?php

    $Email = $password = "";
    $EmailErr = $passwordErr = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty($_POST["Email"])){
                $EmailErr = "Email is Required";
            } else {
                $Email = $_POST["Email"];
            }

            if(empty($_POST["password"])){
                $passwordErr ="password is Required";
            } else {
                $password = $_POST["password"];
            }

            if($Email && $password){
                include("connections.php");

                $check_email = mysqli_query($connections, "SELECT Email, password, Account_type FROM (shiftndsched) WHERE email = '$Email'");    
                $check_email_row = mysqli_num_rows($check_email);

                if ($check_email_row > 0) {
                    while ($row = mysqli_fetch_assoc($check_email)) {
                        $db_password = $row["password"];
                        $db_Account_type = $row["Account_type"];
                
                        if ($db_password == $password) {
                            if ($db_Account_type == "1") {
                                echo "<script>window.location.href = 'admin.php';</script>"; /*gawa kayo file name na admin.php ganon din sa user*/
                            } else {
                                echo "<script>window.location.href = 'user.php';</script>";
                            }
                        } else {
                            $passwordErr = "Password is incorrect!";
                        }
                    }
                } else {
                    $EmailErr = "Email is not registered!";
                }
                }

            }
?>