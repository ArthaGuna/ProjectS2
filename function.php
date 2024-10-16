<?php 
$conn = mysqli_connect("localhost", "root", "", "uas");

// Register 
if (!function_exists('register')) {
    function register($data){
        global $conn;
        $nama = ($data['nama']);
        $email = htmlspecialchars($data['email']);
        $password = mysqli_real_escape_string($conn, $data['password']);
        $alamat = ($data['alamat']);
        
        // Cek username sudah ada
        $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
        if (mysqli_fetch_assoc($result)){
            echo "Email telah terdaftar";
            return;
        }
        
        // Enkripsi password
        $passwordEnkripsi = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert data ke users
        $queryData = "INSERT INTO users (nama, email, password, alamat) VALUES ('$nama', '$email', '$passwordEnkripsi', '$alamat')";
        mysqli_query($conn, $queryData);
        return mysqli_affected_rows($conn);
    }
}


// Untuk ubah nama file menjadi random agar tidak sama / overrite
if (!function_exists('generateRandomString')) {
    function generateRandomString ($length = 10) {
        $characters = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('cari')) {
function cari($keyword){
    $query="SELECT * FROM produk WHERE
            nama LIKE '%$keyword%'";
            return cari($query);
    }
}