<?php
$db = new PDO('mysql:host=localhost;dbname=products_crud', 'root' , '');
$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
$id = $_POST['id'] ?? null;
if(!$id){
    header('location:create.php');
    exit;
}
$statements = $db->prepare('DELETE FROM products WHERE id = :id');
$statements->bindvalue(':id' , $id);
$statements->execute();
header('location:create.php');
?>