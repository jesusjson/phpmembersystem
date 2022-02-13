<?php 
ob_start();
session_start();
include 'baglan.php';

/* Kayıt işlemi başlangıç*/
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST{'password'};
    $passwordtwo = $_POST['passwordtwo'];

    #Kullanıcı sorgulama
    $usernamecheck = $db -> prepare("SELECT * FROM users WHERE username = ?");
    $usernamecheck -> execute(array($username));

    $usermailcheck = $db -> prepare("SELECT * FROM users WHERE usermail = ?");
    $usermailcheck -> execute(array($email));

    if(!$username){
        echo "Kullanıcı adınızı giriniz!";
    }elseif(!$email){
        echo "Lütfen E-posta adresinizi giriniz!";
    }elseif(!$password or !$password){
        echo "Lütfen şifrenizi giriniz!";
    }elseif(strlen($password) < 8){
        echo "Şifreniz 8 karakterden uzun olmalıdır!";
    }elseif($password !== $passwordtwo){
        echo "Şifreleriniz uyuşmuyor!";
    }elseif($usermailcheck -> rowCount()){
        echo "E-posta adresi mevcut!";
    }elseif($usernamecheck->rowCount()){
        echo "Kullanıcı adı mevcut!";
    }else{
        $sorgu = $db -> prepare('INSERT INTO users SET username = ?, usermail = ?, userpass = ?');
        $ekle = $sorgu -> execute([
            $username, $email, $password
        ]);
    
        if($ekle){
            echo "Kayıt tamamlandı yönlendiriliyorsunuz!"; # Kayıt başarılıysa giriş sayfasına yönlendiriyor.
            header("Refresh:2 giris.php");
        }else{
            echo "Kayıt başarısız";
        }
    }
}
/* Kayıt işlemi son */

/* Giriş işlemi başlangıç */
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST{'password'};

    # Bilgileri kontrol edip giriş yapma.
    $usercheck = $db -> prepare('SELECT * FROM users WHERE username = ? and usermail = ? and userpass = ?');
    $usercheck -> execute([
        $username, $email, $password
    ]);
    
    $check = $usercheck -> rowCount();
    if($check == 1){
        $_SESSION['username'] = $username;
        echo "Giriş başarılı yönlendiriliyorsunuz!";
        header("Refresh:2 index.php"); # Giriş işlemi tamamlanınca index sayfasına yönlendiriyor.
    }else{
        echo "Giriş işlemi başarısız.";
    }
}
/* Giriş işlemi son */
?>