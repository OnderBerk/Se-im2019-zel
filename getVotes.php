<?php
header('Content-Type: application/json');
//extract($_REQUEST); // $key varaiable is created
extract($_GET);
include "db.php";
$stmt = $db->prepare("SELECT * FROM oylar where vid = ?");
$stmt->execute([$id]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
echo $json;
?>