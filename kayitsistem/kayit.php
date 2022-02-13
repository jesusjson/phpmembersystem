<?php 
include 'baglan.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Kayit | jesujson</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <form action="islem.php" method="post">
                <div>
                    <input type="text" name="username" placeholder="Kullanıcı adı">
                    <input type="mail" name="email" placeholder="E-posta">
                    <input type="password" name="password" placeholder="Şifre">
                    <input type="password" name="passwordtwo" placeholder="Şifre tekrar">
                </div>
                <button name="register">Kayıt Ol</button>
            </form>
            <p>Zaten bir hesabın varmı <a href="giris.php">Giriş Yap</a></p>
        </div>
    </div>
</body>
</html>