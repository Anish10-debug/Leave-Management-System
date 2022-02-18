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
    
    //to fetch the previous leave id as the session for leaved was not getting created in application
    $sql_test="SELECT leave_id FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$appid')";
    $result_test= $conn->query($sql_test);
    $row_test = $result_test->fetch_assoc();
    $leaveid1=$row_test['leave_id'];

    //to find the total leaves deducted(so that we can add it back to the balance) before updation
    $sql_dates="SELECT `to_date`,`from_date` FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$appid')";
    $dates_result=$conn->query($sql_dates);
    $row_dates=$dates_result->fetch_assoc();
    $ToDate_prev=$row_dates['to_date'];
    $FromDate_prev=$row_dates['from_date'];

    $sql_days_prev="SELECT DATEDIFF('$ToDate_prev','$FromDate_prev') AS 'total_days' FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$appid')";
    $days_result_prev=$conn->query($sql_days_prev);
    $row_days_prev=$days_result_prev->fetch_assoc();
    $days_count_prev=$row_days_prev['total_days'];




    $FromDate=$_POST['FromDate'];
    $ToDate=$_POST['ToDate'];
    $leaveid2=$_POST['leave'];
    
    
    
    
    if($leaveid1 != $leaveid2)
    {
        echo '<script>alert("Leave type has been changed. Cancel this leave first!")</script>';
        echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
    }

    else
    {
        $sql1="SELECT emp_id FROM `lms_miniproject`.`employee` WHERE (username='$username')";
        $result1= $conn->query($sql1);
        $row = $result1->fetch_assoc();
        $emp_id=$row['emp_id'];

        

        $sql_days="SELECT DATEDIFF('$ToDate','$FromDate') AS 'total_days'";
        $days_result=$conn->query($sql_days);
        $row_days=$days_result->fetch_assoc();
        $count_days=$row_days['total_days'];
        
        $sql_check_balance="SELECT planned_leave,unplanned_leave,sick_leave FROM `lms_miniproject`.`total_balance` WHERE (`emp_id`='$emp_id')";
        $row_check=$conn->query($sql_check_balance);
        $row_balance=$row_check->fetch_assoc();


        if($leaveid2==100)
        {
            
            if($row_balance['planned_leave'] < $count_days)
            {
                echo '<script>alert("Insufficient PL balance")</script>';
                echo '<script>window.location.href = "http://localhost/learn/leave-application-new.php"</script>';
            }
            else
            {
                
                //first we will add back those deducted leaves in the balance
                $sql_balance_prev="UPDATE `lms_miniproject`.`total_balance` SET `planned_leave`=`planned_leave`+'$days_count_prev',`leave_balance`=`leave_balance`+'$days_count_prev' WHERE (`emp_id`='$emp_id')";
                $row_prev=$conn->query($sql_balance_prev); 
                
                
                $sql="UPDATE `lms_miniproject`.`leaveapplication` SET from_date='$FromDate',to_date='$ToDate',leave_id='$leaveid2' WHERE(application_id='$appid')";
                if($conn->query($sql) == true)
                {
                    echo '<script>alert("Leave has been editted successfully")</script>';
                } 
                
                //deduct the leaves again according to the updated date
                $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `planned_leave`=`planned_leave`-'$count_days',`leave_balance`=`leave_balance`-'$count_days' WHERE (`emp_id`='$emp_id')";
                $row=$conn->query($sql_balance); 
             
            }
            
        }


        elseif($leaveid2==200)
        {
            
            if($row_balance['unplanned_leave'] < $count_days)
            {
                echo '<script>alert("Insufficient UL balance")</script>';
                echo '<script>window.location.href = "http://localhost/learn/leave-application-new.php"</script>';
            }
            else
            {
                $sql_balance_prev="UPDATE `lms_miniproject`.`total_balance` SET `unplanned_leave`=`unplanned_leave`+'$days_count_prev',`leave_balance`=`leave_balance`+'$days_count_prev' WHERE (`emp_id`='$emp_id')";
                $row_prev=$conn->query($sql_balance_prev); 
                
                
                $sql="UPDATE `lms_miniproject`.`leaveapplication` SET from_date='$FromDate',to_date='$ToDate',leave_id='$leaveid2' WHERE(application_id='$appid')";
                if($conn->query($sql) == true)
                {
                    echo '<script>alert("Leave has been applied successfully")</script>';
                } 
                
                $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `unplanned_leave`=`unplanned_leave`-'$count_days',`leave_balance`=`leave_balance`-'$count_days' WHERE (`emp_id`='$emp_id')";
                $row=$conn->query($sql_balance); 
             
            }
            
        }

        elseif($leaveid2==300)
        {
            
            if($row_balance['sick_leave'] < $count_days)
            {
                echo '<script>alert("Insufficient SL balance")</script>';
                echo '<script>window.location.href = "http://localhost/learn/leave-application-new.php"</script>';
            }
            else
            {
                $sql_balance_prev="UPDATE `lms_miniproject`.`total_balance` SET `sick_leave`=`sick_leave`+'$days_count_prev',`leave_balance`=`leave_balance`+'$days_count_prev' WHERE (`emp_id`='$emp_id')";
                $row_prev=$conn->query($sql_balance_prev); 
                
                
                
                $sql="UPDATE `lms_miniproject`.`leaveapplication` SET from_date='$FromDate',to_date='$ToDate',leave_id='$leaveid2' WHERE(application_id='$appid')";
                if($conn->query($sql) == true)
                {
                    echo '<script>alert("Leave has been editted successfully")</script>';
                } 
                
                $sql_balance="UPDATE `lms_miniproject`.`total_balance` SET `sick_leave`=`sick_leave`-'$count_days',`leave_balance`=`leave_balance`-'$count_days' WHERE (`emp_id`='$emp_id')";
                $row=$conn->query($sql_balance); 
             
            }
            
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
            echo '<script>window.location.href = "http://localhost/learn/dashboard.php"</script>';
        }
    }
    // if($leaveid2==100)
    // {
    //     $leaveid=100;
    // }
    
    // elseif($leaveid2==200)
    // {
    //     $leaveid=200;
    // }
    // elseif($leaveid2==300)
    // {
    //     $leaveid=300;
    // }
    // elseif($leaveid2=='choice-4')
    // {
    //     $leaveid=400;
    // }
    // elseif($leaveid2=='choice-5')
    // {
    //     $leaveid=500;
    // }

    // else
    // {

    //     $sql="UPDATE `lms_miniproject`.`leaveapplication` SET from_date='$FromDate',to_date='$ToDate',leave_id='$leaveid2' WHERE(application_id='$appid')";
    //     //echo $sql;

    //     if($conn->query($sql) == true)
    //     {
    //         echo '<script>alert("Leave has been editted successfully")</script>';
    //         session_start();
            

    //         $sql_role="SELECT `role_id` FROM `lms_miniproject`.`employee` WHERE (`username`='$username')";
    //         $result_role=$conn->query($sql_role);
    //         $check=$result_role->fetch_row();
    //         if($check[0] <= 7)
    //         {
    //             echo '<script>window.location.href = "http://localhost/learn/dashboard_manager.php"</script>';
    //         }
    //         else
    //         {
    //             echo '<script>window.location.href = "http://localhost/learn/dashboard.php";</script>';
    //         }
    //     }

    //     else
    //     {
    //         echo "ERROR: $sql <br> $conn->error";
    //     }

    // }

    
    $conn->close();

?>













