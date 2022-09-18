<?php
    include "databaseconnect.php";
    $control = true;
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save']))
    {
        $postDatas = $_POST;
        if(strlen($postDatas['user_nick']) == null)
        {
            $control = false;
            echo "<script>alert('Kullanıcı Adı Kısmını Boş Bırakmayınız!')</script>";
        }
        else
        {
            if(!preg_match('/^[0-9]{9}+$/', $postDatas['user_nick']))
            {
                $control = false;
                echo "<script>alert('Lütfen Geçerli Bir Kullanıcı Adı Giriniz!')</script>";
            }
        }        
        if(strlen($postDatas['user_pass']) == null)
        {
            $control = false;
            echo "<script>alert('Şifre Kısmını Boş Bırakmayınız!')</script>";
        }
        if($postDatas['status'] == "Kayıt Seçiniz")
        {
            $control = false;
            echo "<script>alert('Statü Seçiniz!')</script>";
        }
        else
        {
            switch ($postDatas['status'])
            {
                case 'Öğrenci':
                    $postDatas['status'] = "ogrenci";
                break;
                case 'Öğretmen':
                    $postDatas['status'] = "ogretmen";
                break;
                case 'Yönetici':
                    $postDatas['status'] = "yonetici";
                break;                
                default:
                break;
            }
        }
        if(strlen($postDatas['user_name']) == null)
        {
            $control = false;
            echo "<script>alert('Ad Kısmını Boş Bırakmayınız!')</script>";
        }
        if(strlen($postDatas['user_surname']) == null)
        {
            $control = false;
            echo "<script>alert('Soyad Kısmını Boş Bırakmayınız!')</script>";
        }
        if($postDatas['college'] == "Kayıt Seçiniz")
        {
            $control = false;
            echo "<script>alert('Fakülte Seçiniz!')</script>";
        }
        if($control)
        {
            $user_id =  $postDatas['user_nick'];
            $user_pass =  $postDatas['user_pass'];
            $status =  $postDatas['status'];
            $user_name =  $postDatas['user_name'];
            $user_surname = $postDatas['user_surname'];
            $college = $_POST['college'];
            $sql_select = "SELECT * FROM user_data WHERE user_id='$user_id'";
            $result_select = $conn->query($sql_select);
            if($result_select->num_rows > 0)
            {
                echo "<script>alert('Kayıt Zaten Var!')</script>"; 
            }
            else
            {
                try
                {
                    $sql_insert = "INSERT INTO user_data (user_id, user_pass, user_role, user_name, user_surname, user_college) VALUES ('$user_id', '$user_pass', '$status', '$user_name', '$user_surname', '$college')";
                    $result_insert = $conn->query($sql_insert);
                    echo "<script>alert('Kayıt Başarılı')</script>";
                }
                catch (Exception $e)
                {
                    echo "<script>alert('Kayıt Başarısız')</script>";
                }
            }
        }
    }
    function exit_function()
    {
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
    <title>Yönetici Paneli</title>
</head>
<body class="body_ogretmen">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-11"><h3 class="mb-3 text-danger">Yönetici Paneli</h3></div>
            <div class="col-md-1"><form method="post"><input type="submit" class="btn btn-secondary" name="exit" value="Çıkış" /></form></div>
        </div>
        <div class="row">
            <table class="table table-dark table-bordered table-striped" style="text-align: center;">
                <thead>
                    <th scope="cow">Kullanıcı Adı</th>
                    <th scope="cow">Şifre</th>
                    <th scope="cow">Statü</th>
                    <th scope="cow">Ad</th>
                    <th scope="cow">Soyad</th>
                    <th scope="cow">Fakülte</th>
                    <th scope="cow"></th>
                </thead>
                <tbody>
                    <form method="post">
                        <tr>
                            <td><input type="text" name="user_nick" class="table_item"></td>
                            <td><input type="password" name="user_pass" class="table_item"></td>
                            <td>
                                <select name="status" class="form-select form-select-sm table_item" aria-label=".form-select-sm example">
                                    <option selected>Kayıt Seçiniz</option>
                                    <option>Öğrenci</option>
                                    <option>Öğretmen</option>
                                    <option>Yönetici</option>
                                </select>
                            </td>
                            <td><input type="text" name="user_name" class="table_item"></td>
                            <td><input type="text" name="user_surname" class="table_item"></td>
                            <td>
                                <select name="college" class="form-select form-select-sm table_item" aria-label=".form-select-sm example">
                                    <option selected>Kayıt Seçiniz</option>
                                    <option>Meslek Yüksekokulu</option>
                                </select>
                            </td>
                            <td><input type="submit" class="btn save_button" name="save" value="Kaydet" /></td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>