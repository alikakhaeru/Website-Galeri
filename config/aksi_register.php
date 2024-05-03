<?php
include'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];
$regis = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' OR email='$email'"));

if($regis == 0){
    mysqli_query($koneksi, "INSERT INTO user VALUES('','$username','$password','$email','$namalengkap','$alamat')");
    echo "<script>
    alert('Pendaftaran akun berhasil');
    location.href='../login.php';
    </script>";
} else{
    echo "<script>
    alert('Maaf, Akun Sudah Terdaftar');
    location.href='../register.php';
    </script>";
}
?>