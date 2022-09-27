<?php
    include "databaseconnect.php";
    $control = true;
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        $postDatas = $_POST;
        if($postDatas['ogrenci'] == "Kayıt Seçiniz") {
            $control = false;
            echo "<script>alert('İşlem Yapmak İstediğiniz Öğrenciyi Seçiniz.')</script>";
        }
        if($control) {
            $user_id =  $postDatas['ogrenci'];
            $sql_select = "SELECT * FROM user_data WHERE user_id='$user_id'";
            $result_select = $conn->query($sql_select);
            if($result_select->num_rows > 0) {            
                try {
                    $sql_insert = "DELETE FROM user_data WHERE user_id = '$user_id'";
                    $conn->query($sql_insert);
                    echo "<script>alert('İşlem Başarılı')</script>";
                } catch (Exception $e) {
                    echo "<script>alert('İşlem Başarısız')</script>";
                }
            }
        }
    }
    function exit_function() {
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
    <title>Kayıt Silme Sayfası</title>
</head>
<body class="body_ogretmen">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11"><h3 class="mb-3 text-danger">Kayıt Silme Paneli</h3></div>
            <div class="col-md-1"><form method="post"><input type="submit" class="btn btn-secondary" name="exit" value="Çıkış" /></form></div>
        </div>
        <div class="row">
            <table class="table table-dark table-bordered table-striped" style="text-align: center;">
                <thead>
                    <th scope="cow">Kullanıcı Adı</th>
                    <th scope="cow">#</th>
                </thead>
                <tbody>
                    <?php if(isset($_SESSION['nick'])){?>
                        <form method="post">
                            <tr>
                                <td>
                                    <select name="ogrenci" class="form-select form-select-sm table_item" aria-label=".form-select-sm example">
                                        <option selected>Kayıt Seçiniz</option>
                                        <?php
                                            $sql = "SELECT * FROM user_data WHERE user_role=1 or user_role=2";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                ?>
                                                <option><?php echo $row['user_id'];?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td><input type="submit" class="btn save_button" name="delete" value="Sil" /></td>
                            </tr>
                        </form>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>