<!DOCTYPE html>
<html>
    <head>
        <title>Your applications</title>
        <link rel="stylesheet" href="reports.css">
        <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
    <style>
        #your_apps
        {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        color:white;
        font-size:50px;
        position:absolute;
        top:100px;
        left:500px;
        }
    </style>
    <p id="your_apps">My Applications</p>
    <table class="table table-success table-striped">
        <tr>
            <th>Application_id</th>
            <th>Application_Date</th>
            <th>From_Date</th>
            <th>To_date</th>
            <th>Status</th>
            <th>Modified_date</th>
            <th>Emp_id</th>
            <th>Leave_id</th>
</tr>

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
    $sql1="SELECT emp_id from `lms_miniproject`.`employee` WHERE (username='$username')";
    $result1=$conn->query($sql1);
    $row1=$result1->fetch_assoc();
    $emp_id=$row1['emp_id'];
    $sql="SELECT * FROM `lms_miniproject`.`leaveapplication` WHERE(emp_id='$emp_id')";
    //echo $sql;
    $result= $conn->query($sql);

    if($result== true)
    {
        if($result -> num_rows>0)
        {
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>".$row["application_id"]."</td><td>".$row["application_date"]."</td><td>".$row["from_date"].
                "</td><td>".$row["to_date"]."</td><td>".$row["status"]."</td><td>".$row["modified_date"]."</td><td>".$row["emp_id"].
                "</td><td>".$row["leave_id"]."</td></tr>";
            }
            echo "</table>";
        }

        else
        {
            echo '<script>alert("No leave has been applied")</script>';
            session_start();
            $_SESSION['username']=$username;

            $sql_role="SELECT `role_id` FROM `lms_miniproject`.`employee` WHERE (`username`='$username')";
            $result_role=$conn->query($sql_role);
            $check=$result_role->fetch_row();
            if($check[0] <= 7)
            {
                echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
            }
            else
            {
                echo '<script>window.location.href = "http://localhost/learn/dashboard.php";</script>';
            } 
        }
        
    }

    else
    {
        echo "ERROR: $sql <br> $conn->error";
    }

    $conn->close();

?>

</body>
</html>  
    