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


    
    
    $sql2="SELECT COUNT(*) FROM `justinclicks`.`user101` WHERE (`username`='$username' and `password`='$password' )";
    $result2= $conn->query($sql2);
    $count=$result2->fetch_row();
    if($count[0]==0)
    {
        echo '<script>alert("Invalid credentials")</script>';

        echo '<script>window.location.href = "http://localhost/learn/Internship_Login_Page.php"</script>';
    }
    else 
    {
        session_start();
        $_SESSION['username']=$username;
        echo '<script>alert("Login Successful")</script>';
        echo '<script>window.location.href = "http://localhost/learn/nextpage.php"</script>';
    }
    $conn->close();

?>


