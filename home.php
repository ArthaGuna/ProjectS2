<?php
session_start();

require 'function.php';

$queryHome = mysqli_query($conn, "SELECT id, nama, harga, foto FROM produk LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amerta Sedana | Home</title>
    <link href="admin/assets/images/icon.png" rel="shortcut icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;
        0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- Header -->
    <?php require 'component/navbar.php';?>
    
    <!-- header -->
    <header id = "header" class = "vh-100 carousel slide" data-bs-ride = "carousel" style = "padding-top: 104px; background: rgba(179, 179, 179, 0.10);">
        <div class = "container h-100 d-flex align-items-center carousel-inner">
            <div class = "text-center carousel-item active">
                <h2 class = "text-capitalize text-muted">best collection</h2>
                <h1 class = "text-uppercase py-2 fw-bold text-muted">terracotta</h1>
                <a href = "shop.php" class = "btn mt-3 text-uppercase">shop now</a>
            </div>
            <div class = "text-center carousel-item">
                <h2 class = "text-capitalize text-muted">best price & offer</h2>
                <h1 class = "text-uppercase py-2 fw-bold text-muted">pottery</h1>
                <a href = "#" class = "btn mt-3 text-uppercase">buy now</a>
            </div>
        </div>

        <button class = "carousel-control-prev" type = "button" data-bs-target="#header" data-bs-slide = "prev">
            <span class = "carousel-control-prev-icon"></span>
        </button>
        <button class = "carousel-control-next" type = "button" data-bs-target="#header" data-bs-slide = "next">
            <span class = "carousel-control-next-icon"></span>
        </button>
    </header>
    <!-- end of header -->

    <!-- collection -->
    <section id = "collection" class = "py-5">
    <div class = "title text-center">
                <h2 class = "position-relative d-inline-block">Best Product</h2>
            </div>
        <div class="container content mt-5 d-flex flex-lg-wrap gap-5">
            <?php while($data = mysqli_fetch_array($queryHome)) {?>
            <div class="card " style="width: 220px;">
                <div class="card-header m-auto" style="border-radius: 5px;">
                    <img src="image/<?= $data['foto']; ?>" alt="Patung 1" style="width: 100%">
                </div>
                <div class="card-body">
                    <p class="m-0 text-justify mb-2"><?= $data['nama']?></p>
                    <p class="m-0">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </p>
                </div>
                <div class="card-footer d-flex flex-row justify-content-between align-items-center">
                    <p class="m-0" style="font-size: 16px; font-weight: 600;"><?= $data ['harga'];?></p>
                    <button class="btn btn-outline-primary" style="font-size: 24px;">
                        <i class="fa-solid fa-cart-plus"></i>
                    </button>
                </div>
            </div>
            <?php }?>
        </div>
    </section>
    <!-- end of collection -->

    <hr class="mt-5 mb-5">
    <!-- about us -->
    <section id = "about" class = "py-5">
        <div class = "container">
            <div class = "row gy-lg-5 align-items-center">
                <div class = "col-lg-6 order-lg-1 text-center text-lg-start">
                    <div class = "title pt-3 pb-5">
                        <h2 class = "position-relative d-inline-block ms-4">About Us</h2>
                    </div>
                    <p class = "lead text-muted">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, ipsam.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem fuga blanditiis, modi exercitationem quae quam eveniet! Minus labore voluptatibus corporis recusandae accusantium velit, nemo, nobis, nulla ullam pariatur totam quos.</p>
                </div>
                <div class = "col-lg-6 order-lg-0">
                    <img src = "admin/assets/images/pp.jpg" alt = "" class = "img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- end of about us -->

    <!-- End Footer -->
    <?php require 'component/footer.php';?>
</body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</html>