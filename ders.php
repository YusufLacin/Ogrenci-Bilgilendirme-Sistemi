<?php
    include "databaseconnect.php";
    session_start();
    $control_lesson = true;
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_lesson'])) {
        $postDatas = $_POST;
        if(strlen($postDatas['lesson']) == null) {
            $control_lesson = false;
            echo "<script>alert('Ders Adı Giriniz.')</script>";
        }
        if($postDatas['credit'] < 0) {
            $control_lesson = false;
            echo "<script>alert('Kredi 0 Rakamından Küçük Olamaz.')</script>";
        }
        if($control_lesson) {
            $lesson =  $postDatas['lesson'];
            $credit =  $postDatas['credit'];
            $sql_select = "SELECT * FROM lesson WHERE lesson='$lesson'";
            $result_select = $conn->query($sql_select);
            if($result_select->num_rows > 0) {
                echo "<script>alert('Girilen Ders Adı Kullanılmaktadır.')</script>"; 
            } else {
                try {
                    $sql_insert = "INSERT INTO lesson (lesson, credit) VALUES ('$lesson', '$credit')";
                    $result_insert = $conn->query($sql_insert);
                    echo "<script>alert('Kayıt Başarılı.')</script>";
                } catch (Exception $e) {
                    echo "<script>alert('Kayıt Başarısız.')</script>";
                }
            }
        }
    }
    function exit_function() {
        session_destroy();
        header("Location:index.php");
    }
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['exit'])) {
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
    <title>Ders Ekleme Paneli</title>
</head>
<body class="body_ogretmen">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11"><h3 class="mb-3 text-danger">Ders Ekleme Paneli</h3></div>
            <div class="col-md-1"><form method="post"><input type="submit" class="btn btn-secondary" name="exit" value="Çıkış" /></form></div>
        </div>
        <div class="row">
            <div class="tab-content">
                <table class="table table-dark table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <th scope="cow">Ders Adı</th>
                        <th scope="cow">Ders Kredi</th>
                        <th scope="cow">#</th>
                    </thead>
                    <tbody>
                    <?php if(isset($_SESSION['nick'])){?>
                        <form method="post">
                            <tr>
                                <td><input type="text" name="lesson" class="table_item"></td>
                                <td><input type="number" name="credit" class="table_item"></td>
                                <td><input type="submit" class="btn save_button" name="save_lesson" value="Kaydet" /></td>
                            </tr>
                        </form>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>