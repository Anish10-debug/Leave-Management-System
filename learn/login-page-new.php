<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous">
    </script>
    <script
			  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous">
    </script>
     
    <title>
        LMS
    </title>
        
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="login-page.css">
        
    </head>

    <style>
            #delloite1
            {
                text-align: center;
                position:absolute;
                top:10px;
                left:650px;
                font-size: 50px;  
                font-weight: bold;  
                color:white;
                font-family: 'Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif';
                animation-name: animeB;
                animation-duration: 1s;
                animation-delay: 1s;
                animation-iteration-count: infinite;

            }
        @keyframes animeB{
            0% {color:white}
            25% {color:turquoise}
            50% {color:greenyellow}
            75% {color:red}
        }
    </style>
    <body>
        <div class='ball'></div>
        <p id='delloite'>Dell</p>
        <p id='delloite1'>ite</p>
        <div class="inputbox"></div>
        <div id='form'>
        <form action="login-page.php" method="GET" id="form1">   
            <p id='login'>LOGIN</p>

                <input type="text" id="username" name="username" placeholder="username" >
                <input type="password" id="password" name="password" placeholder="Password" >
                    <button class="btn">LOGIN</button>
        </form>
    </body>
    
</html>