<?php

$connections = mysqli_connect ("localhost","root", "", "shiftndsched",3307);
if(mysqli_connect_errno()){

    echo "Failed to Connect to mysqli:". mysqli_connect_error();
    
}else{

    echo "";
}



