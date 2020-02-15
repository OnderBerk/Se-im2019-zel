<!DOCTYPE html>

<?php
session_start();

if ($_SESSION["type"] == 1) {
    echo "<p>Hosgeldiniz <i>{$_SESSION["user_fullname"]}</i></p>";
} else {
    $error = 1;
    header("Location: index.php?error=$error");
}

include 'db.php';

$sql = "select * from oylar";
$rs = $db->query($sql);

foreach ($rs as $row) {
    $Xid = $row['vid'];
}
$Xid++;
extract($_POST);

if (isset($btnAdd)) {
    $Fid = $Xid;
    $pop = $millet + $cumhur;
    $sql = "INSERT INTO `cities` values(?,?,?,?)";
    $stmt = $db->prepare($sql);
    $res = $stmt->execute([NULL, $Fid, $ilceadi, $pop]);

    if ($millet > $cumhur) {
        $ittifak = "millet";
        $oy = $millet;
    } else {
        $ittifak = "cumhur";
        $oy = $cumhur;
    }

    $sql2 = "INSERT INTO `oylar` values(?,?,?,?)";
    $stmt2 = $db->prepare($sql2);
    $res3 = $stmt2->execute([NULL, $Fid, "millet", $millet]);
    $res2 = $stmt2->execute([NULL, $Fid, "cumhur", $cumhur]);

    header("Location: admin.php");
    exit;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title>YENİ İLÇE EKLE</title>
    <link href="app.css" rel="stylesheet" type="text/css"/>
    <style>
        body{
            background-image: url('image/ysk.jpg');
        }
        table{
            background-color: red;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            -webkit-transition-duration: 0.4s; /* Safari */
            transition-duration: 0.4s;
        }
        .button2:hover {
            box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
        .sonbutton{
            width: 100px;
            height: 30px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }
        
    </style>
</head>
<body>
    <form method="POST">
        <table>
            <?php
            echo "<tr><td>İlçe Adı:</td><td><input type='text' name='ilceadi'></td></tr>";
            echo "<tr><td>Millet İttifakı:</td><td><input type='text' name='millet'></td></tr>";
            echo "<tr><td>Cumhur İttifakı:</td><td><input type='text' name='cumhur'></td></tr>";
            echo "<tr><td colspan=4><button type='submit' class='sonbutton' name='btnAdd'>EKLE</button></td></tr>"
            ?>
        </table>
    </form>
    <?php
    ?>
    <p><a href="admin.php"><input type="button" class="button button2" value="ÇIKIŞ YAP"></a></p>
</body>
</html>
