
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

$application_id=$_POST['app_id'];
$sql1="SELECT COUNT(*) FROM `lms_miniproject`.`leaveapplication` WHERE (application_id='$application_id')";
$result1= $conn->query($sql1);
$count=$result1->fetch_row();
//echo $count[0];
if($count[0]==0)
{
    echo '<script>alert("Invalid application id")</script>';
    echo '<script>window.location.href = "http://localhost/learn/check_resource_leave.php"</script>';
}
else 
{
    session_start();
    $_SESSION['app_id']=$application_id;
    echo '<script>window.location.href = "http://localhost/learn/check_resource_leave_update.php"</script>';
}


$conn->close();

?>

</body>
</html>  
