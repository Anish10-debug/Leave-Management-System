<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit leave</title>
   <link rel="stylesheet" href="check-status.css">
   <link rel="stylesheet" href="edit_leave_table.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
    <style>
        body{
            background: url("2_new.jpg");
            background-size: cover;
        }
        #enter_app_id{
            font-family: 'Gill Sans', 'Gill Sans MT';
            position: relative;
            bottom:100px;
            /*background-image: linear-gradient(to right,#0056d6,#0091e3,#00bac8,#9dd9be,#f1f6e5);*/
            background-image: linear-gradient(to bottom,black,grey);
            max-width: 260px;
            border-radius: 15px;
            margin:200px auto 100px;
            padding:10px 45px 30px;
            text-align:center;
        }

        label{
            color:white;
        }

        #app_id{
            border-radius: 10px;
            background:cornsilk;
            width:100%;     /*for adjusting length of username and password*/
            margin: 0 0 15px;   /*for creating space between username and password*/
            padding:15px;
            box-sizing: border-box;
        }
        #your_apps
        {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            color:white;
            font-size:50px;
            position:absolute;
            top:20px;
            left:520px;
        }
    </style>
    <p id="your_apps">Edit Leave</p>
    <form action="edit-leave.php" id="enter_app_id" method="POST">
    <div id="enterappid">
        <label>Enter application ID</label>
        <input type="text" id="app_id" name="app_id">
    </div>

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
                echo'<script>alert("No leave has been applied")</script>';
                session_start();
               

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