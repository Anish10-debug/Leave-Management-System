<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check resource leave</title>
  
   <!--<link rel="stylesheet" href="check_resource_leave.css">-->
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
            position: absolute;
            left:500px;
            bottom:300px;
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
            width:100%;     
            margin: 0 0 15px;   
            padding:15px;
            box-sizing: border-box;
        }
        table{
            position:absolute;
            left:-250px;
            top:200px;
        } 
        #your_apps
        {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            color:white;
            font-size:50px;
            position:absolute;
            top:5px;
            left:450px;
        }

    </style>
    <p id="your_apps">Resource Leaves</p>
    <form action="check_resource_leave_appid_validation.php" id="enter_app_id" method="POST">
    <div id="enterappid">
        <label>Enter application ID for approving</label>
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
    $sql1="SELECT role_id from `lms_miniproject`.`employee` WHERE (username='$username')";
    $result1=$conn->query($sql1);
    $role_id=$result1->fetch_assoc();
    if($role_id['role_id']==1)
    {
        $sql2="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>1))";
        $result2=$conn->query($sql2);
        if($result2 -> num_rows>0)
        {
            while($row2=$result2->fetch_assoc())
            {
                echo "<tr><td>".$row2["application_id"]."</td><td>".$row2["application_date"]."</td><td>".$row2["from_date"].
                "</td><td>".$row2["to_date"]."</td><td>".$row2["status"]."</td><td>".$row2["modified_date"]."</td><td>".$row2["emp_id"].
                "</td><td>".$row2["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
        
    }

    else if($role_id['role_id']==2)
    {
        $sql3="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>2))";
        $result3=$conn->query($sql3);
        if($result3 -> num_rows>0)
        {
            while($row3=$result3->fetch_assoc())
            {
                echo "<tr><td>".$row3["application_id"]."</td><td>".$row3["application_date"]."</td><td>".$row3["from_date"].
                "</td><td>".$row3["to_date"]."</td><td>".$row3["status"]."</td><td>".$row3["modified_date"]."</td><td>".$row3["emp_id"].
                "</td><td>".$row3["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
        
    }

    else if($role_id['role_id']==3)
    {
        $sql4="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>3))";
        $result4=$conn->query($sql4);
        if($result4 -> num_rows>0)
        {
            while($row4=$result4->fetch_assoc())
            {
                echo "<tr><td>".$row4["application_id"]."</td><td>".$row4["application_date"]."</td><td>".$row4["from_date"].
                "</td><td>".$row4["to_date"]."</td><td>".$row4["status"]."</td><td>".$row4["modified_date"]."</td><td>".$row4["emp_id"].
                "</td><td>".$row4["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
        
    }

    else if($role_id['role_id']==4)
    {
        $sql5="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>4))";
        $result5=$conn->query($sql5);
        if($result5 -> num_rows>0)
        {
            while($row5=$result5->fetch_assoc())
            {
                echo "<tr><td>".$row5["application_id"]."</td><td>".$row5["application_date"]."</td><td>".$row5["from_date"].
                "</td><td>".$row5["to_date"]."</td><td>".$row5["status"]."</td><td>".$row5["modified_date"]."</td><td>".$row5["emp_id"].
                "</td><td>".$row5["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
       
    }

    else if($role_id['role_id']==5)
    {
        $sql6="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>5))";
        $result6=$conn->query($sql6);
        if($result6 -> num_rows>0)
        {
            while($row6=$result6->fetch_assoc())
            {
                echo "<tr><td>".$row6["application_id"]."</td><td>".$row6["application_date"]."</td><td>".$row6["from_date"].
                "</td><td>".$row6["to_date"]."</td><td>".$row6["status"]."</td><td>".$row6["modified_date"]."</td><td>".$row6["emp_id"].
                "</td><td>".$row6["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
        
    }


    else if($role_id['role_id']==6)
    {
        $sql7="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>6))";
        $result7=$conn->query($sql7);
        if($result7 -> num_rows>0)
        {
            while($row7=$result7->fetch_assoc())
            {
                echo "<tr><td>".$row7["application_id"]."</td><td>".$row7["application_date"]."</td><td>".$row7["from_date"].
                "</td><td>".$row7["to_date"]."</td><td>".$row7["status"]."</td><td>".$row7["modified_date"]."</td><td>".$row7["emp_id"].
                "</td><td>".$row7["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
        }
        
    }


    else if($role_id['role_id']==7)
    {
        $sql8="SELECT * from `lms_miniproject`.`leaveapplication` WHERE emp_id IN(SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (role_id>7))";
        $result8=$conn->query($sql8);
        if($result8 -> num_rows>0)
        {
            while($row8=$result8->fetch_assoc())
            {
                echo "<tr><td>".$row8["application_id"]."</td><td>".$row8["application_date"]."</td><td>".$row8["from_date"].
                "</td><td>".$row8["to_date"]."</td><td>".$row8["status"]."</td><td>".$row8["modified_date"]."</td><td>".$row8["emp_id"].
                "</td><td>".$row8["leave_id"]."</td></tr>";
            
            }
            echo "</table>";
        }
        else
        {
            echo '<script>alert("No leave has been applied by your resources")</script>';
            echo '<script>window.location.href = "http://localhost/dashboard_manager.php"</script>';
        }
        
    }
    
        

    $conn->close();

?>

</body>
</html>