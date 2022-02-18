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

    $FromDate=$_POST['FromDate'];
    $ToDate=$_POST['ToDate'];
    //$appid=$_POST['appid'];
    $leaveid=$_POST['leave'];
    session_start();
    $username=$_SESSION['username'];
   
    $sql1="SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (username='$username')";
    $result1= $conn->query($sql1);
    $row = $result1->fetch_assoc();
    $emp_id=$row['emp_id'];
    
    $_SESSION['emp_id1']=$emp_id;
    //$_SESSION['leave_id_old']=$leaveid;     //this will be used while editting to check if the leave type has been changed or not

    $sql_days="SELECT DATEDIFF('$ToDate','$FromDate') AS 'total_days'";
    $days_result=$conn->query($sql_days);
    $row_days=$days_result->fetch_assoc();
    $_SESSION['days_count']=$row_days['total_days'];
    $count_days=$_SESSION['days_count'];
    //echo $count_days;

    $sql_check_balance="SELECT planned_leave,unplanned_leave,sick_leave FROM `lms_miniproject`.`total_balance` WHERE (`emp_id`='$emp_id')";
    $row_check=$conn->query($sql_check_balance);
    $row_balance=$row_check->fetch_assoc();

    if($leaveid==100)
    {
        
        if($row_balance['planned_leave'] < $count_days)
        {
            echo '<script>alert("Insufficient PL balance")</script>';
            echo '<script>window.location.href = "http://localhost/learn/leave-application-new.php"</script>';
        }
        else
        {
            $sql="INSERT INTO `lms_miniproject`.`leaveapplication`(`application_date`,`from_date`,`to_date`,`status`,`modified_date`,`emp_id`,`leave_id`) 
            values (curdate(),'$FromDate','$ToDate','Pending',curdate(),'$emp_id','$leaveid')";
            if($conn->query($sql) == true)
            {
                echo '<script>alert("Leave has been applied successfully")</script>';
            } 
            
            $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `planned_leave`=`planned_leave`-'$count_days',`leave_balance`=`leave_balance`-'$count_days' WHERE (`emp_id`='$emp_id')";
            $row=$conn->query($sql_balance); 
         
        }
        
    }
    
    elseif($leaveid==200)
    {
        if($row_balance['unplanned_leave'] < $count_days)
        {
            echo '<script>alert("Insufficient UL balance")</script>';
            echo '<script>window.location.href = "http://localhost/learn/leave-application-new.php"</script>';
        }
        
        else
        {
            $sql="INSERT INTO `lms_miniproject`.`leaveapplication`(`application_date`,`from_date`,`to_date`,`status`,`modified_date`,`emp_id`,`leave_id`) 
            values (curdate(),'$FromDate','$ToDate','Pending',curdate(),'$emp_id','$leaveid')";
            if($conn->query($sql) == true)
            {
                echo '<script>alert("Leave has been applied successfully")</script>';
            } 
            
            
            $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `unplanned_leave`=`unplanned_leave`-'$count_days',`leave_balance`=`leave_balance`-'$count_days' WHERE (`emp_id`='$emp_id')";
            $row=$conn->query($sql_balance);
            
        }
        
    }
    elseif($leaveid==300)
    {
        if($row_balance['sick_leave'] < $count_days)
        {
            echo '<script>alert("Insufficient Sick Leave balance")</script>';
            echo '<script>window.location.href = "http://localhost/learn/leave-application-new.php"</script>';
        }
        
       else
       {
            $sql="INSERT INTO `lms_miniproject`.`leaveapplication`(`application_date`,`from_date`,`to_date`,`status`,`modified_date`,`emp_id`,`leave_id`) 
            values (curdate(),'$FromDate','$ToDate','Pending',curdate(),'$emp_id','$leaveid')";
            if($conn->query($sql) == true)
            {
                echo '<script>alert("Leave has been applied successfully")</script>';
            } 
        
            $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `sick_leave`=`sick_leave`-'$count_days',`leave_balance`=`leave_balance`-'$count_days' WHERE (`emp_id`='$emp_id')";
            $row=$conn->query($sql_balance);
           
       } 
        
    }
    elseif($leaveid==400)
    {
        $sql="INSERT INTO `lms_miniproject`.`leaveapplication`(`application_date`,`from_date`,`to_date`,`status`,`modified_date`,`emp_id`,`leave_id`) 
        values (curdate(),'$FromDate','$ToDate','Pending',curdate(),'$emp_id','$leaveid')";
        if($conn->query($sql) == true)
        {
            echo '<script>alert("Leave has been applied successfully")</script>';
        } 
        
        $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `maternity_leave`=`maternity_leave`-'$count_days',`leave_balance`='leave_balance'-'$count_days' WHERE (`emp_id`='$emp_id')";
        $row=$conn->query($sql_balance);
       
    }
    

        
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
        
    

    

    $conn->close();

?>













