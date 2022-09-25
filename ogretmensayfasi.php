<?php
    include "databaseconnect.php";
    session_start();
    $control = true;
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
        $postDatas = $_POST;
        if($postDatas['ogrenci'] == "Kayıt Seçiniz") {
            $control = false;
            echo "<script>alert('İşlem Yapmak İstediğiniz Öğrenciyi Seçiniz.')</script>";
        }
        if($postDatas['ders'] == "Kayıt Seçiniz") {
            $control = false;
            echo "<script>alert('İşlem Yapmak İstediğiniz Dersi Seçiniz.')</script>";
        }
        if(($postDatas['exam_1'] < 0 || $postDatas['exam_1'] > 100) || ($postDatas['exam_2'] < 0 || $postDatas['exam_2'] > 100)) {
            $control = false;
            echo "<script>alert('Notlar 1 ile 100 Arasında Sayı Olmalıdır.')</script>";
        }
        if($control) {
            $user_id =  $postDatas['ogrenci'];
            $lesson =  $postDatas['ders'];
            $exam_1 =  $postDatas['exam_1'];
            $exam_2 = $postDatas['exam_2'];
            $sql_select = "SELECT * FROM lesson_data WHERE user_id='$user_id' and user_lesson='$lesson'";
            $result_select = $conn->query($sql_select);
            if($result_select->num_rows > 0) {
                echo "<script>alert('Kayıt Zaten Var!')</script>"; 
            } else {
                try {
                    $sql_insert = "INSERT INTO lesson_data (user_id, user_lesson, exam_1, exam_2) VALUES ('$user_id', '$lesson', '$exam_1', '$exam_2')";
                    $result_insert = $conn->query($sql_insert);
                    echo "<script>alert('Kayıt Başarılı')</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Kayıt Başarısız')</script>";
                }
            }
        }
    }
    function exit_function()
    {
        session_destroy();
        header("Location:index.php");
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['exit']))
    {
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
    <title>Öğretmen Paneli</title>
</head>
<body class="body_ogretmen">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11"><h3 class="mb-3 text-danger">Öğretmen Paneli</h3></div>
            <div class="col-md-1"><form method="post"><input type="submit" class="btn btn-secondary" name="exit" value="Çıkış" /></form></div>
        </div>
        <div class="row">
            <table class="table table-dark table-bordered table-striped" style="text-align: center;">
                <thead>
                    <th scope="cow">Öğrenci Numarası</th>
                    <th scope="cow">Not Girilecek Ders</th>
                    <th scope="cow">Vize</th>
                    <th scope="cow">Final</th>
                    <th scope="cow"></th>
                </thead>
                <tbody>
                <?php if(isset($_SESSION['nick'])){?>
                    <form method="post">
                        <tr>
                            <td>
                                <select name="ogrenci" class="form-select form-select-sm table_item" aria-label=".form-select-sm example">
                                    <option selected>Kayıt Seçiniz</option>
                                    <?php
                                        $sql = "SELECT * FROM user_data WHERE user_role=1";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0)
                                        {
                                            while($row = $result->fetch_assoc())
                                            {
                                                ?>
                                                <option><?php echo $row['user_id'];?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select name="ders" class="form-select form-select-sm table_item" aria-label=".form-select-sm example">
                                    <option selected>Kayıt Seçiniz</option>
                                    <option>MBPR 247-Veri Tabanı Yönetimi</option>
                                    <option>MBPR 249-Nesne Tabanlı Programlama</option>
                                    <option>MBPR 251-Web Uygulama ve Geliştirme</option>
                                    <option>MBPR 253-Görsel Programlama I</option>
                                    <option>MBPR 262-İngilizce</option>
                                    <option>MBPR 265-Türk Dili</option>
                                    <option>MBPR 268-İnkılap Tarihi</option>
                                    <option>MBPR 261-Seçmeli Ders</option>
                                </select>
                            </td>
                            <td><input type="text" name="exam_1" class="table_item"></td>
                            <td><input type="text" name="exam_2" class="table_item"></td>
                            <td><input type="submit" class="btn save_button" name="save" value="Kaydet" /></td>
                        </tr>
                    </form>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>