<html>
    <head>
        <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous">
    </script>
   <script
   src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
   integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
   crossorigin="anonymous"></script>
   <link href=https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css rel="stylesheet"> 
        <title>
            Dashboard
        </title>
        <body>
        <link rel="stylesheet" type="text/css" href="dashboard_new.css">
        <link rel="stylesheet" type="text/css" href="dashboard_ite.css">
        <link rel="stylesheet" type="text/css" href="bootstrap.css">
        <style>
            body{
                margin: 0 auto;
                background: url("2_new.jpg");
                background-size: cover;
            }

            table{
            position:absolute;
            max-width:10%;
            left:50px;
            top:170px;
            
            }

            
            </style>


            <table class="table table-dark">
            <tr>
                <th>PL</th>
                <th>UL</th>
                <th>SL</th>
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
            $sql1="SELECT emp_id,emp_Name from `lms_miniproject`.`employee` WHERE (username='$username')";
            $result1=$conn->query($sql1);
            $row1=$result1->fetch_row();
            
            $emp_name=$row1[1];
            $emp_id=$row1[0];
            $_SESSION['emp_Name']=$emp_name;
            $_SESSION['emp_Id']=$emp_id;

            // $sql_hire="SELECT hire_date FROM `lms_miniproject`.`employee` WHERE (username='$username')";
            // $hire_result=$conn->query($sql_hire);
            // $hire_days=$hire_result->fetch_assoc();
            // $count_hire=$hire_days['hire_date'];
            // echo $count_hire;

            // $sql_exp="SELECT no_of_years('hire_date') FROM `lms_miniproject`.`employee` WHERE (username='$username')";
            // $exp_result=$conn->query($sql_exp);
            // $exp_years=$exp_result->fetch_row();
            // $exp_hire=$exp_years[0];
            // echo $exp_hire;

            

            $sql_dashboard_balance="SELECT planned_leave,unplanned_leave,sick_leave,leave_balance FROM `lms_miniproject`.`total_balance` WHERE(emp_id='$emp_id')";
            $result_dashboard= $conn->query($sql_dashboard_balance);

            if($result_dashboard== true)
            {
                if($result_dashboard -> num_rows>0)
                {
                    while($row_d = $result_dashboard->fetch_assoc())
                    {
                        echo "<tr><td>".$row_d["planned_leave"]."</td><td>".$row_d["unplanned_leave"]."</td><td>".$row_d["sick_leave"]."</td></tr>";
                    }
                    echo "</table>";
                }
                
            }

            $conn->close();

        ?>

            
            <div class='ball'></div>
            <p id='delloite'>Dell</p>
            <p id='delloite1'>ite</p>
            <p id="welcome">WELCOME!  <?php 
            echo $_SESSION['emp_Name'] ?></p>
            <button id="logout">Logout</button>    

            <script>
                
                $(document).ready(function(){
                    $("#logout").click(function(){
                        let isok=confirm("Are you sure?");
                        alert(isok);
                        if(isok)
                        {
                            window.location.href = "http://localhost/learn/login-page-new.php";
                        }
                    })
                });
            </script>
            <div id="user">
                <a href="leave-application-new.php"><button id="apply_leave">Apply Leave</button></a>
                <a href="edit-leave-new1.php"><button id="edit_leave">Edit leave</button></a>
                <a href="cancel-leave-show.php"><button id="Cancel_leave">Cancel Leave</button></a>
                <a href="reports.php"><button id="Reports">All applications</button></a>
                <a href="check_resource_leave.php"><button id="Reports">Check resource leaves</button></a>

        </div>
        </body>
    </head>
</html>