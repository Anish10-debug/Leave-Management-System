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

    $username=$_GET['username'];
    $password=$_GET['password'];
    //echo $_GET['username'];


    
    
    $sql2="SELECT COUNT(*) FROM `lms_miniproject`.`user101` WHERE (`username`='$username' and `password`='$password' )";
    $result2= $conn->query($sql2);
    $count=$result2->fetch_row();
    if($count[0]==0)
    {
        echo '<script>alert("Invalid credentials")</script>';

        echo '<script>window.location.href = "http://localhost/learn/login-page-new.php"</script>';
    }
    else 
    {
        session_start();
        $_SESSION['username']=$username;



        $sql1="SELECT `role_id` FROM `lms_miniproject`.`employee` WHERE (`username`='$username')";
        $result1=$conn->query($sql1);
        $check=$result1->fetch_row();
        if($check[0] <= 7)
        {
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
        else
        {
            echo '<script>window.location.href = "http://localhost/learn/dashboard.php"</script>';
        }
        
    }


    $conn->close();

?>


