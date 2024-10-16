<style>
    .text-nav{
        margin-left: 270px;
    }
    nav i {
        transition:  .2s;
        color: black;
        border-radius: 50%;
        padding: 8px 10px;
    }
    nav i:hover{
        background-color: lightgray;
        transform: scale(0.9);
    }
    nav ul li a{
        transition:  .2s;
        color: black;
        padding: 8px 10px;
    }
    nav ul li a:hover{
        transform: scale(0.9);
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: white;">
        <div class="container">
            <a class="navbar-brand fs-4 text-dark fw-bold me-4" href="#">Amerta Sedana</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse gap-4" id="navbarScroll">
                <ul class="text-nav navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link navbar text-dark" aria-current="page" href="home.php">Home</a>
                    </li>

                    <li class="nav-item mt-2">
                        |
                    </li>

                    <li class="nav-item">
                        <a class="nav-link navbar text-dark" href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item mt-2">
                        |
                    </li>

                    <li class="nav-item">
                        <a class="nav-link navbar text-dark" href="#about">About Us</a>
                    </li>
                </ul>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarScroll"></div>
                        <form class="d-flex" role="search" action="" method="post">
                            <input class="form-control me-2" type="search" style="width: 62%;" name="keyword" placeholder="Search" aria-label="Search">
                            <button type="submit" name="cari" style="border: none; background-color: transparent;"><i class='bx bx-search fs-4'></i></button>
                        </form>
                        <div class="d-flex">
                            <a href="../uas_artha/login.php" >
                                <i class='bx bx-user fs-4' style="margin-left: -50px;"></i>
                            </a>
                        </div>
                        <div class="d-flex">
                             <a href="/transaksi">
                                <i class='bx bx-shopping-bag fs-4'></i>
                            </a>
                        </div>
                        
        </div>
</nav>
        <hr class="mt-1">