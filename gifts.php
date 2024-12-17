<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Children and Letters</title>
</head>
<body>
    <div class="christmas-header">
        <h1>🎄 Christmas Gift List 🎁</h1>
        <p>Check out the available gifts this Christmas!</p>
    </div>
    
    <div class="cards-container">
        <?php

        session_start();

        require "functions.php";
        require "Database.php";

        $config = require("config.php"); 

        $db = new Database($config["database"]);
        $gifts = $db->query("SELECT * FROM gifts")->fetchAll();

        echo "<ol>";
        foreach ($gifts as $gift) {
            echo "<li>" . $gift['name'] . " - " . $gift['count_available'] . " left</li>";
        }
        echo "</ol>";
        ?>
    </div>

    <div class="footer">
        <p>Wishing you a Merry Christmas and a Happy New Year! 🎅</p>
    </div>
</body>
</html>
