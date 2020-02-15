<!DOCTYPE html>
<?php
session_start();

if ($_SESSION["type"] == 1) {
    echo "<p>Hosgeldiniz <i>{$_SESSION["user_fullname"]}</i></p>";
} else {
    $error = 1;
    header("Location: index.php?error=$error");
}

include "db.php";
$sql = "select * from oylar";
$rs = $db->query($sql);
$sql2 = "select * from cities";
$rs2 = $db->query($sql2);
$total = $rs->rowCount();
?>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
    <link href="app.css" rel="stylesheet" type="text/css"/>
    <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
    <style>
        .btn-1 {
            padding: 14px 24px;
            text-align: center;
            cursor: pointer;
            text-decoration: bold;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px #bbb;
            width: 200px;
            height: 60px;
        }

        .btn-1:hover {
            background-color: #4CAF50;
        }

        .btn-1:active {
            background-color: #4CAF50;
            box-shadow: 0 3px #444;
            transform: translateY(3px);
        }

    </style>
    <style>
        #container{
            display: flex;
        }
        #büyük{
            margin-left: 100px;
            margin-right: 100px;
            width: 300px;
            height: 300px;
        }
        #sonuc{
            margin-right: 200px;
            width: 300px;
            height: 300px;
            margin-top: 100px;
        }
        #kazan{
            margin-right: 100px;
            width: 300px;
            height: 300px;
        }
        h1{
            margin-right: 80px;
        }
        body{
            background-color: #fff5e4;
        }

    </style>
    <script>


        $(function () {
            $("#sonuc").hide();
            $("#kazan").hide();
            $("#but").hide();
            $("#res").hide();
            $(".btn-1").hide();
            $.get("getCity.php", function (result) {
                data = $.parseJSON(result);

                for (i in data) {
                    var eachrow = "<tr>"
                            + "<td>" + data[i].cname + "</td>"
                            + "<td>" + data[i].cpop + "</td>"
                            + "<td onmouseover=\"displayInfo(" + data[i].cid + ", " + data[i].cpop + ")\"><img src='image/report.png' width='25px' height='25px'></td>"
                            + "<td><a href='delete.php?id=" + data[i].cid + "'><img src='image/del.jpg' width='20px' height='20px'></td>"

                            + "</tr>";
                    $('#tbody').append(eachrow);
                }
            });
        });

        function displayInfo(cid, cpop) {
            var vid = cid;
            var vpop = cpop;
            $.getJSON("getVotes.php", {id: vid}, function (result) {
                if (result.length > 0) {
                    $("#sonuc").show();
                    $("#kazan").show();
                    $("#res").show();

                    $("#but").show();
                    $(".btn-1").show();

                    if (result[0].vittifak === "millet") {
                        $("#div1").html(result[0].vittifak);
                        $("#div2").html(result[0].voy);

                        $("#div3").html(result[1].vittifak);
                        $("#div4").html(result[1].voy);

                        var mansuroy = parseInt(result[0].voy);
                        var mehmetoy = parseInt(result[1].voy);
                    } else {
                        $("#div1").html(result[1].vittifak);
                        $("#div2").html(result[1].voy);

                        $("#div3").html(result[0].vittifak);
                        $("#div4").html(result[0].voy);

                        var mansuroy = parseInt(result[1].voy);
                        var mehmetoy = parseInt(result[0].voy);
                    }

                    if (mehmetoy > mansuroy) {
                        var kazanan = "Mehmet Özhaseki";
                        var oyorani = mehmetoy / (vpop / 100);
                        $("#k1").html(kazanan);
                        $("#k2").html("%" + Math.round(oyorani));
                        $("#c1").html("<img src='image/haseki.jpg' width='250px'>");
                        $("#res").html("<img src='image/akp.png' width='25px'></img>" + "CUMHUR İTTİFAKI" + "<img src='image/mhp.png' width='25px'></img>");

                    } else {
                        var kazanan = "Mansur Yavaş";
                        var oyorani = mansuroy / (vpop / 100);
                        $("#k1").html(kazanan);
                        $("#k2").html("%" + Math.round(oyorani));
                        $("#c1").html("<img src='image/mansur.jpg' width='250px'>");
                        $("#res").html("<img src='image/chp.png' width='25px'></img>" + "MİLLET İTTİFAKI" + "<img src='image/iyi.png' width='25px'></img>");
                    }


                }
            });
        }
    </script>
</head>
<body>
<div id="container">
    <table id="büyük">
        <tbody id="tbody">
        <th>İLÇE</th>
        <th>SAYI</th>
        <th>SONUÇ</th>
        <th>SİL</th>
        </tbody>
    </table>
    <div>
        <table id="sonuc">
            <th>İttifak Adı</th> 
            <th>Aldığı Oy</th>
            <tr><td id="div1"></td><td id="div2"></td></tr>
            <tr><td id="div3"></td><td id="div4"></td></tr>
        </table>
    </div>
    <div>
        <h1 id="res"></h1>
        <table id="kazan">
            <tr>
                <th>KAZANAN</th>
                <th>OY ORANI</th>
            </tr>
            <tr>
                <td id="k1"></td>
                <td id="k2"></td>
            </tr>
            <tr>
                <td id="c1" colspan="2"></td>
            </tr>
        </table>
        <div class="but">
            <a href="insert.php"><input type="button" class="btn-1" value="YENİ İLÇE EKLE"></a>
        </div>
    </div>
</div>
<div id="sonbut">
    <a href="logout.php"><input type="button" class="btn-1" value="ÇIKIŞ YAP"></a>
</div>
<div id="başkan">
    <?php
    $pop = 0;
    foreach ($rs2 as $newarr) {
        $pop += $newarr["cpop"];
    }
    $toplamcumhur = 0;
    $toplammillet = 0;
    $mansur = 0;
    $haseki = 0;
    foreach ($rs as $arr) {
        if ($arr["vittifak"] == "cumhur") {
            $toplamcumhur += $arr["voy"];
        } else if ($arr["vittifak"] == "millet") {
            $toplammillet += $arr["voy"];
        }
    }
    $mansur = $toplammillet / ($pop / 100);
    $haseki = $toplamcumhur / ($pop / 100);
    echo "<table border=2px>";
    echo "<tr><td colspan='2'>ANKARA GENEL</td></tr>";
    echo "<tr>";
    echo "<td>MANSUR YAVAŞ</td>";
    echo "<td>MEHMET ÖZHASEKİ</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>%" . round($mansur, 2) . "</td>";
    echo "<td>%" . round($haseki, 2) . "</td>";
    echo "</tr>";
    if ($mansur > $haseki) {
        echo "<tr>";
        echo "<td colspan='2'><img src='image/mansur.jpg' width='250px'></td>";
        echo "</tr>";
    } else {
        echo "<tr>";
        echo "<td colspan='2'><img src='image/haseki.jpg' width='250px'></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</div>

</body>
</html>
