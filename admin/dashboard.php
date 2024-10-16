<?php 
    require '../session.php';
    require '../function.php';

    // Mengecek Kategori
    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    // Mengecek Produk
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
    $jumlahProduk = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amerta Sedana | Dashboard</title>

    <link href="assets/images/icon.png" rel="shortcut icon">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
    <link rel="stylesheet" href="css/page.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<div>
    <?php 
    require 'component/header.php';
    require 'component/navbar.php';
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="kategori.php" style="text-decoration: none;">
                        <div class="fs-5 font-weight-bold text-primary text-uppercase mb-1">
                            Category
                        </div>
                        </a>
                        <div class="text-s mb-0 font-weight-bold text-gray-800"><?= $jumlahKategori; ?> Category</div>
                    </div>
                    <div class="col-auto">
                        <a href="kategori.php"><i class="bx bx-category fa-3x text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="produk.php" style="text-decoration: none;">
                        <div class="fs-5 font-weight-bold text-success text-uppercase mb-1">
                            Product
                        </div>
                        </a>
                        <div class="text-s mb-0 font-weight-bold text-gray-800"><?= $jumlahProduk; ?> Product</div>
                    </div>
                    <div class="col-auto">
                        <a href=""><i class="fa-solid fa-box fa-3x text-gray-300"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
                            <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
</body>
</html>
