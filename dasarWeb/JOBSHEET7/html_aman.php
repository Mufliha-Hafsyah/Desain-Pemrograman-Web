<?php
$input = ""; 
$email = "";
$emailErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST['input'] ?? ''; 
    $input = htmlspecialchars($input, ENT_QUOTES, "UTF-8");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) { 
    
    $email = $_POST['email']; 

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Email **$email** sedang divalidasi (Valid)";
    } else {
        $emailErr = "Email invalid";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Form Input PHP</title>
    </head>
    <body>
        <h2>Form Input PHP</h2>
        <form method="post">
            <label for="input">Input:</label>
            <input type="text" name="input" id="input" value="<?php echo $input; ?>"> 
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">

            <input type="submit" name="submit" value="Submit">
            
            <p><?php echo $input?></p>
            <p><?php echo $email?></p>
            <p><?php echo $emailErr?></p>
        </form>
    </body>
</html>