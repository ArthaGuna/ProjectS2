<?php 
    session_start();
    require 'function.php';

    if (isset($_POST['login'])){
        $email = htmlspecialchars ($_POST['email']);
        $password = htmlspecialchars ($_POST['password']);
        
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        $countData = mysqli_num_rows($query);
        $data = mysqli_fetch_array($query);

        if ($countData > 0){
            if (password_verify($password, $data['password'])){
                $_SESSION['email'] = $data['email'];
                $_SESSION['login'] = true;
                // Cek remember me
                if (isset($_POST['remember'])){

                    setcookie('id', $row['id'], time()+60);
                    setcookie('key', hash('sha256', $row['email']), time()+60);
                }
                header('location: admin/dashboard.php');
                
            } else {
                ?>
                    <script type="text/javascript">
                        window.alert('You are not admin');
                    </script>
                <?php
            }

        } else {
            ?>
                <script type="text/javascript">
                    window.alert('Account not available');
                </script>
            <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amerta Sedana | Login</title>
    <link href="admin/assets/images/icon.png" rel="shortcut icon">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;
        0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">

</head>

<style>
    .icons{
        position: absolute;
        margin-left: 435px;
        margin-top: 12px;
        cursor: pointer;
        font-size: 26px;
    }
    .kotak{
        border-radius: 10px;
    }
</style>

<body>  
    <div class="shadow p-4 position-absolute top-50 start-50 translate-middle col-lg-4 kotak">
        <div  class="input-box">
            <header class="fs-3 mt-2">SIGN IN</header>
            <p>Log in to continue on Website</p>
        </div>
        <form action="" method="POST">
            <div class="input-field">
                <input type="text" name="email" class="input-login" required autocomplete="off">
                <label for="email">Email<span style="color: red;">*</span></label>
            </div>

            <div class="input-field">
                <input type="password" name="password" id="loginpassword" class="input-login" required>
                <label for="password">Password<span style="color: red;">*</span></label>
                <ion-icon class="toggle-password icons"  name="eye-outline" onclick="togglePasswordVisibility('loginpassword')"></ion-icon>
            </div>
            <div class="form-check mb-3">   
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label for="remember"> Remember Me</label>
            </div>

            <div>
                <input type="submit" name="login" class="btn btn-primary form-control mt-2 fs-5" value="Login">
            </div>

            <div class="text-center mb-3 mt-3">
                <span>Don't Have Account? <a href="register.php" style="color: rgb(87, 87, 87); text-decoration: none;">Create Account</a></span>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    
    <script src="script.js"></script>

</body>
</>