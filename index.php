<?php
    include "databaseconnect.php";
    $errors = array();
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST)) {
        $postDatas = $_POST;
        $number = $postDatas['number'];
        $password = $postDatas['password'];
        $sql = "SELECT * FROM user_data WHERE user_id='$number'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                if($password == $row["user_pass"]) {
                    session_start();
                    $_SESSION['nick'] = $postDatas['number'];
                    if($row["user_role"] == 1) {
                        header("Location:ogrencisayfasi.php");
                    } elseif($row["user_role"] == 2) {
                        header("Location:ogretmensayfasi.php");
                    } else {
                        header("Location:yoneticisayfasi.php");
                    }
                } else {
                    $errors['password'] = 'Şifre Yanlış!';
                }
            }
        } else {
            $errors['number'] = 'Kullanıcı Bulunamadı!';
        }
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
    <title>Giriş Sayfası</title>
</head>
<body class="body_index">
    <div class="row" style="height: 29vh;"></div>
    <div class="row" style="height: 39vh;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 giris_panel" style="text-align: center;">
                    <form method="post">
                        <label for="s_title" class="text-info h3">Giriş Paneli</label><br><br>
                        <input type="text" name="number" <?php if(isset($errors['number'])): ?> class="input-error" placeholder="<?php echo $errors['number'] ?>" <?php else: ?>  placeholder="Kullanıcı Adı" <?php endif; ?> style="text-align: center; width: 400px"><br><br>
                        <input type="password" name="password" <?php if(isset($errors['password'])): ?> class="input-error" placeholder="<?php echo $errors['password'] ?>" <?php else: ?>  placeholder="Şifre" <?php endif; ?> style="text-align: center; width: 400px" ><br><br>
                        <button type="submit" name="submit" class="border border-0">Giriş Yap</button><br><br>
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row" style="height: 29vh;"></div>
</body>
</html>