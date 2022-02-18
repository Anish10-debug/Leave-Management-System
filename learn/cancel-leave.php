<!DOCTYPE html>
<html>
    <head>
        <title>Cancel leave</title>
        <link rel="stylesheet" href="check-status.css">
        <link rel="stylesheet" href="bootstrap.css">
</head>
<body>
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
    session_start();
    $conn=mysqli_connect($server,$username,$password);

    if(!$conn)
    {
        die("connection to this database failed" . 
        mysqli_connect_error());
    }
    //echo "Succesfully connected";

    //$emp_id1=$_SESSION['emp_id'];    SESSION failed
    
    //to get an additional username for dashboard so that 
    // $sql_test="SELECT username FROM `lms_miniproject`.`employee` WHERE (emp_id='$emp_id1')";
    // $result_test=$conn->query($sql_test);
    // $username_test=$result_test->fetch_assoc();
    // $_SESSION['username_test']=$username_test['username'];
    $username=$_SESSION['username'];
    
    $application_id=$_POST['app_id'];
    $sql1="SELECT COUNT(*) FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
    $result1= $conn->query($sql1);
    $count=$result1->fetch_row();

    $sql2="DELETE FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
    
    $sql_empid="SELECT `emp_id` FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
    $result_empid= $conn->query($sql_empid);
    $empid_check=$result_empid->fetch_assoc();
    $emp_id1=$empid_check['emp_id'];


    $sql_leaveid="SELECT `leave_id` FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
    $result_leaveid= $conn->query($sql_leaveid);
    $leaveid_check=$result_leaveid->fetch_assoc();
    $leaveid_check1=$leaveid_check['leave_id'];

    $sql_dates="SELECT `to_date`,`from_date` FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
    $dates_result=$conn->query($sql_dates);
    $row_dates=$dates_result->fetch_assoc();
    $ToDate=$row_dates['to_date'];
    $FromDate=$row_dates['from_date'];

    $sql_days="SELECT DATEDIFF('$ToDate','$FromDate') AS 'total_days' FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
    $days_result=$conn->query($sql_days);
    $row_days=$days_result->fetch_assoc();
    $days_count=$row_days['total_days'];
    //echo $days_count;
    
    if($count[0]==0)
    {
        echo '<script>alert("Invalid application id")</script>';
        echo '<script>window.location.href = "http://localhost/learn/cancel-leave-show.php"</script>';
    }
    else 
    {
        echo '<script>alert("Leave has been cancelled")</script>';
        //$_SESSION['username']=$username;
        $result2= $conn->query($sql2);
       
      


        if($leaveid_check1==100)
        {
            $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `planned_leave`=`planned_leave`+'$days_count',`leave_balance`=`leave_balance`+'$days_count' WHERE (`emp_id`='$emp_id1')";
            $row=$conn->query($sql_balance); 
        }

        elseif($leaveid_check1==200)
        {
            $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `unplanned_leave`=`unplanned_leave`+'$days_count',`leave_balance`=`leave_balance`+'$days_count' WHERE (`emp_id`='$emp_id1')";
            $row=$conn->query($sql_balance); 
        }

        elseif($leaveid_check1==300)
        {
            $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `sick_leave`=`sick_leave`+'$days_count',`leave_balance`=`leave_balance`+'$days_count' WHERE (`emp_id`='$emp_id1')";
            $row=$conn->query($sql_balance); 
        }
        
        $sql_role="SELECT `role_id` FROM `lms_miniproject`.`employee` WHERE (`username`='$username')";
        $result_role=$conn->query($sql_role);
        $check=$result_role->fetch_row();
        echo $check[0];
        if($check[0] <= 7)
        {
            echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php";</script>';
        }
        else
        {
            echo '<script>window.location.href = "http://localhost/learn/dashboard.php";</script>';
        }
    }


    $conn->close();

?>

</body>
</html>  
    