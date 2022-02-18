<?php

    $server="localhost";
    $username="root";
    $password="";

    $conn=mysqli_connect($server,$username,$password);

    if(!$conn)
    {
        die("connection to this database failed" . 
        mysqli_connect_error());
    }
    //echo "Succesfully connected";

    session_start();
    $username=$_SESSION['username'];
    $appid=$_SESSION['app_id'];    

    $sql="UPDATE `lms_miniproject`.`leaveapplication` SET `status`='Approved' WHERE(application_id='$appid')";
    //echo $sql;

    if($conn->query($sql) == true)
    {
        echo '<script>alert("Leave has been approved successfully")</script>';
        //echo "Leave has been applied successfully";
        //echo $leaveid;
        echo '<script>window.location.href = "http://localhost/learn/check_resource_leave.php";</script>';
    }

    else
    {
        echo "ERROR: $sql <br> $conn->error";
    }

    $conn->close();

?>













