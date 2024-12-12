
<?php

require 'dbConf.php';

$sqlVerMember = 'SELECT email FROM Member'; 
$sqlVerAdmin = 'SELECT email FROM Admin';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
    <form action='index.php' method='POST'>

        <lable for='email'>Email </lable>
        <input type='email' name='email'>
        <lable for='password'>Password </lable>
        <input type='password' name='password'>
        <input type='checkbox' name='save'>
        <label for="save">Save Login Info</label>

        <button type='submit' name='log-in'>SUBMIT</button>

    </form>

</body>
</html>