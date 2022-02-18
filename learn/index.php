<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>learning php</title>
</head>
<body>
    <h1>Hello</h1>
    <?php
    define('pi',2.14);      //global constant
        echo "Learning php<br>";
        echo var_dump(1==4); //returns either true or false
        $var1="<br>This is a string<br>";
        echo ($var1);   
        //echo var_dump($var1);   //returns the data type
    ?>
</body>
</html>