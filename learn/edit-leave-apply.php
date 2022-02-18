<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>
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
   <link rel="stylesheet" href="leave_application.css">
</head>
<body>
    <script>
        $(document).ready(function()
        {
            $("#FromDate").datepicker({ dateFormat: 'yy-mm-dd',minDate:0 });
            $("#ToDate").datepicker({ dateFormat: 'yy-mm-dd',minDate:0 });
        });

        $(document).ready(function()
        {
            $("#apply_now").click(function(){
                //alert("Leave has been applied successfully");
            });
        });
    </script>
    <form action="edit-leave-update.php" id="leaveApply" method="POST">
    <div id="Details">

        <label>From Date</label>
        <input type="text" name="FromDate" id="FromDate">

        <label>To Date</label>
        <input type="text" name="ToDate" id="ToDate">
    </div>

    <div id="type">
        <label>Planned Leave</label>
        <input type="radio" name="leave" value="100" id="radio1">

        <label>UnPlanned Leave</label>
        <input type="radio" name="leave" value="200" id="radio1">
        
        <label>Sick Leave</label>
        <input type="radio" name="leave" value="300" id="radio1">
        
        <label>Maternity Leave</label>
        <input type="radio" name="leave" value="400" id="radio1">

        <button id="apply_now" class="btn">APPLY</button>

    </div>
    
</form>


</body>
</html>


