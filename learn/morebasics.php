<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>more basics</title>
</head>
<body>
    <?php
        // $age=34;
        // if($age>30)
        //     echo "party is allowed";
        // else if($age==34)
        //     echo "okay";
        // else
        //     echo "party not allowed";

        $languages=array('Anish','Ganesh','Asha');      //array declaration
        $i=0;
        while($i <= count($languages))
        {
            echo $languages[$i];
            echo "<br>";
            $i++;
        }
        //same syntax as C++ for other loops

        foreach($languages as $values)          //foreach loop
        {
            echo "<br>The values are: ";
            echo $values;
        }

        function print5()           //this is how you write a function in php
        {
            for($i=0;$i<5;$i++)
                echo $i;
                echo "<br";
        }
        echo"<br>";
        print5();
        
    ?>
</body>
</html>