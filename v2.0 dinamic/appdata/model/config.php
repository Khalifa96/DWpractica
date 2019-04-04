<?php
function db()
{
    try{
        $conn = new PDO('mysql:host=localhost;port=3306;dbname=BD_Tienda;charset=utf8', 'nAdmin', '111');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
    catch(PDOException $pe) {
        echo "Este error es de config.php 8^)";
        
        echo $pe->getMessage();
    }    
    return null;
}