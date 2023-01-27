<?php
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $output = shell_exec("ruby script/get_logtime.rb $username");
    }
?>

<html>
    <head>
        <title>Calculate Hours</title>
    </head>
    <body>
        <form action="calculate.php" method="post">
            <input type="text" name="username" placeholder="Enter username">
            <input type="submit" value="Calculate">
        </form>
        <?php
            if(isset($output)) {
                echo "<pre>$output</pre>";
            }
        ?>
    </body>
</html>

