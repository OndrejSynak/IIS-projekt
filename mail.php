<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Distributor caju</title>
<link rel="stylesheet" href="style.css" type="text/css" >
</head>

<body onload="onLoad()">
    <?php
        require_once 'mainInit.php';
    ?>
    
    <script>
    function emailVisibility()
    {
        var selectElem = document.getElementById("selectField");
        var emailElem = document.getElementById("emailField");
        var selectedIdx = selectElem.selectedIndex;
        if (selectedIdx === 0)
        {
            emailElem.style.display = "none";
        }
        else
        {
            emailElem.style.display = "";
            emailValidity();
        }
    }
    
    function emailValidity()
    {
        var selectElem = document.getElementById("selectField");
        var emailElem = document.getElementById("emailField");
        var submitElem = document.getElementById("submitField");
        
        var selectedIdx = selectElem.selectedIndex;
        if (selectedIdx === 1)
        {
            if (/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(emailElem.value))
            {
                submitElem.disabled = false;
            }
            else
            {
                submitElem.disabled = true;
            }
        }
    }
    
    function onLoad()
    {
        emailVisibility();
    }
    </script>
    
    <div id="main">
        <?php require_once 'header.php' ?>
        <?php require_once 'menu.php' ?>
        
        <div id="content">
            <?php
            $postEmail = "";
            if (array_key_exists('email', $_POST))
                $postEmail = $_POST['email'];
            ?>
            
            <form action="mail-send.php" method="POST">
            Adresát
            <select id="selectField" name="select" onchange="emailVisibility()">
                <option value="0" <?php if ($postEmail === "") echo 'selected="selected"'; ?>>Odběratelé novinek</option>
                <option value="1" <?php if ($postEmail !== "") echo 'selected="selected"'; ?>>Konkrétni odběratel</option>
            </select>
            <?php //Check mail format ?>
            <input id="emailField" type="text" name="email" value="<?php echo $postEmail?>" oninput="emailValidity()"/><br/>
            <input type="text" name="content" value=""/><br/>
            <input id="submitField" type="submit" value="Odeslat">
            </form>
            <br/>
                        
        </div>
        <div id="footer">
        </div>
    </div>
</body>
</html>