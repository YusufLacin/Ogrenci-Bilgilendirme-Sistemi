<?php
    include "databaseconnect.php";
    session_start();
    $lesson_name = array("MBPR 247-Veri Tabanı Yönetimi", "MBPR 249-Nesne Tabanlı Programlama", "MBPR 251-Web Uygulama ve Geliştirme", "MBPR 253-Görsel Programlama I", "MBPR 262-İngilizce", "MBPR 265-Türk Dili", "MBPR 268-İnkılap Tarihi", "MBPR 261-Seçmeli Ders");
    if (isset($_SESSION['nick'])) {
        $number = $_SESSION['nick'];
        $sql_user_info = "SELECT * FROM user_data WHERE user_id='$number'";
        $result = $conn->query($sql_user_info);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()){ 
                $isim = $row["user_name"] . " " . $row["user_surname"];
                $fakulte = $row["user_college"];
            }
        }
    }
    function exit_function() {
        session_destroy();
        header("Location:index.php");
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['exit'])) {
        exit_function();
    }
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <title>Öğrenci Sayfası</title>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11"><h3 class="mb-3 text-danger">Öğrenci Bilgilendirme Sayfası</h3></div>
            <div class="col-md-1"><form method="post"><input type="submit" class="btn btn-secondary" name="exit" value="Çıkış" /></form></div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active text-dark" data-bs-toggle="tab" href="#info">Öğrenci Bilgileri</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="tab" href="#list">Ders Listesi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="tab" href="#lesson-table">Haftalık Ders Çizelgesi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="tab" href="#notes">Ders Notları</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="info" class="container tab-pane active">
                <table class="table table-dark">
                    <tr>
                        <td><label for="name">Adı Soyadı:</label></td>
                        <td style="background-color: #2c3034;"><?php if(isset($_SESSION['nick'])): echo $isim; else: echo ""; endif;?></td>
                        <td><label for="number">Numarası:</label></td>
                        <td style="background-color: #2c3034;"><?php if(isset($_SESSION['nick'])): echo $number; else: echo ""; endif;?></td>
                        <td><label for="faculty">Fakülte:</label></td>
                        <td style="background-color: #2c3034;"><?php if(isset($_SESSION['nick'])): echo $fakulte; else: echo ""; endif;?></td>
                    </tr>
                </table>
            </div>
            <div id="list" class="container tab-pane fade">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ders Adı</th>
                            <th scope="col">Kredi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($_SESSION['nick'])){?>
                        <tr>
                            <th scope="row">1</th>
                            <td>MBPR 247-Veri Tabanı Yönetimi</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>MBPR 249-Nesne Tabanlı Programlama</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>MBPR 251-Web Uygulama ve Geliştirme</td>
                            <td>3</td>
                        </tr>
                            <th scope="row">4</th>
                            <td>MBPR 253-Görsel Programlama I</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>MBPR 262-İngilizce</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>MBPR 265-Türk Dili</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>MBPR 268-İnkılap Tarihi</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>MBPR 261-Seçmeli Ders</td>
                            <td>2</td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div id="lesson-table" class="container tab-pane fade">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                          <th scope="col">Ders/Gün</th>
                          <th scope="col">Pazartesi</th>
                          <th scope="col">Salı</th>
                          <th scope="col">Çarşamba</th>
                          <th scope="col">Perşembe</th>
                          <th scope="col">Cuma</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($_SESSION['nick'])){?>
                        <tr>
                            <th scope="cow">1.Ders<br>08.30-09.10</th>
                            <td>Veri Tabanı Yönetimi</td>
                            <td>Türk Dili</td>
                            <td>Web Uygulama ve Geliştirme</td>
                            <td>Web Uygulama ve Geliştirme</td>
                            <td>İnkılap Tarihi</td>
                        </tr>
                        <tr>
                            <th scope="cow">2.Ders<br>09.20-10.00</th>
                            <td>Veri Tabanı Yönetimi</td>
                            <td>Türk Dili</td>
                            <td>Web Uygulama ve Geliştirme</td>
                            <td>Web Uygulama ve Geliştirme</td>
                            <td>İnkılap Tarihi</td>
                        </tr>
                        <tr>
                            <th scope="cow">3.Ders<br>10.10-10.50</th>
                            <td>Görsel Programlama I</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="cow">4.Ders<br>11.00-11.40</th>
                            <td>Görsel Programlama I</td>
                            <td>İngilizce</td>
                            <td>Veri Tabanı Yönetimi</td>
                            <td></td>
                            <td>Seçmeli Ders</td>
                        </tr>
                        <tr>
                            <th scope="cow">5.Ders<br>11.50-12.30</th>
                            <td></td>
                            <td>İngilizce</td>
                            <td>Veri Tabanı Yönetimi</td>
                            <td></td>
                            <td>Seçmeli Ders</td>
                        </tr>
                        <tr>
                            <th scope="cow">Öğle Arası<br>12.30-13.30</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="cow">6.Ders<br>13.30-14.10</th>
                            <td>Nesne Tabanlı Programlama</td>
                            <td></td>
                            <td>Görsel Programlama I</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="cow">7.Ders<br>14.20-15.00</th>
                            <td>Nesne Tabanlı Programlama</td>
                            <td>Nesne Tabanlı Programlama</td>
                            <td>Görsel Programlama I</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="cow">8.Ders<br>15.10-15.50</th>
                            <td></td>
                            <td>Nesne Tabanlı Programlama</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div id="notes" class="container tab-pane fade">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <th scope="cow">Ders Adı</th>
                        <th scope="cow">Vize</th>
                        <th scope="cow">Final</th>
                        <th scope="cow">Ortalama</th>
                    </thead>
                    <tbody>
                        <?php for($sayac = 0; $sayac < count($lesson_name); $sayac++){ if (isset($_SESSION['nick'])){?>
                        <tr>
                            <th><?php echo $lesson_name[$sayac];?></th>
                            <?php $number = $_SESSION['nick']; $sql_select = "SELECT * FROM lesson_data WHERE user_id='$number' and user_lesson='$lesson_name[$sayac]'"; $result_select = $conn->query($sql_select); if($result_select->num_rows > 0){ if($row = $result_select->fetch_assoc()){?>
                            <td><?php echo $row['exam_1'];?></td>
                            <td><?php echo $row['exam_2'];?></td>
                            <td><?php echo ($row['exam_1'] + $row['exam_2'])/2;?></td>
                            <?php }}else{?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <?php }}?>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>