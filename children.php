<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Children and Letters</title>
</head>
<body>
    <div class="cards-container">
        <?php
        session_start();

        require "functions.php";
        require "Database.php";
        

        $config = require("config.php"); 
        $db = new Database($config["database"]);

        $children = $db->query("SELECT * FROM children")->fetchAll();
        $letters = $db->query("SELECT * FROM letters")->fetchAll();
        $gifts = $db->query("SELECT * FROM gifts")->fetchAll();

      

        foreach ($children as $child) {
            echo "<div class='card'>";
            echo "<div class='card-header'>";
            echo "<h2>" . htmlspecialchars($child['firstname']) . " " . htmlspecialchars($child['surname']) . "</h2>";
            echo "</div>";
            echo "<div class='card-body'>";
            

            
            
            foreach ($letters as $letter) {
                if ($child['id'] == $letter['sender_id']) {

                    
                    foreach($gifts as $gift){
                        $giftName = $gift['name'];
                        
                        $letter['letter_text'] = str_ireplace($gift, "<strong>" . $giftName . "</strong>", $letter['letter_text']);
                        
                        if (str_contains(strtolower($letter['letter_text']), strtolower($giftName))) {
                            echo " <strong>" . htmlspecialchars($giftName) . "</strong><br>";
                        }
                        
                        
                    }
                    
                    echo "<p>" . nl2br($letter['letter_text']) . "</p>";
                    
                }
                
        }
        
            echo "</div>";
            echo "</div>";
    }
        ?>
    </div>
</body>
</html>
