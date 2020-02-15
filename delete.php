<?php
include 'db.php';
extract($_GET); //stuid
$sql = "delete from cities where cid = ?";
$stmt = $db->prepare($sql);
$res = $stmt->execute([$id]);
header("Location:admin.php");
exit;
?>