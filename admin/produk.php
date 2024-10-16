<?php 
    require '../session.php';
    require '../function.php';

    $queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
    $jumlahProduk = mysqli_num_rows($queryProduk);

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amerta Sedana | Product </title>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php 
    require 'component/header.php';
    require 'component/navbar.php';
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 ms-4">Product</h1>
    
    <!-- Add Product -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div>
                                <label for="nama">Name</label>
                                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
                            </div>

                            <!-- Mengambil dari table kategori -->
                            <div>
                                <label for="kategori">Category</label>
                                <select name="kategori" id="kategori" class="form-control" required>
                                    <option value="">Select one</option>
                                    <?php
                                        while($data = mysqli_fetch_array($queryKategori)){
                                    ?>
                                        <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="harga">Price</label>
                                <input type="number" class="form-control" name="harga" required>
                            </div> 

                            <div>
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>

                            <div>
                                <label for="detail">Detail</label>
                                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            
                            <div>
                                <label for="ketersediaan_stok">Stock Availability</label>
                                <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                                    <option value="available">Available</option>
                                    <option value="soldout">Sold Out</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="simpan">Save</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])){
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

            $target_dir = "../image/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $imageSize = $_FILES["foto"]["size"];
            $randomName = generateRandomString(10);
            $newName = $randomName . '.' . $imageFileType;

            if ($nama == '' || $kategori == '' || $harga == ''){
        ?>
                <div class="alert alert-warning" role="alert">
                    Name, Category, and Price must be filled!
                </div>
        <?php    
            } else {
                if ($nama_file != ''){
                    if ($imageSize > 1000000) {
        ?>
                        <div class="alert alert-warning" role="alert">
                            Files cannot be more than 1 mb!
                        </div>
        <?php
                    } else {
                        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'){
        ?>
                            <div class="alert alert-warning" role="alert">
                                Uploaded files must be in JPG, PNG, JPEG format!
                            </div>
        <?php
                        } else {
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newName);
                        }
                    }
                }
                // Query insert ke table produk
                $queryTambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
                VALUES ('$kategori', '$nama', '$harga', '$newName', '$detail', '$ketersediaan_stok')");

                if ($queryTambah) {
        ?>
                    <!-- Refresh Otomatis -->
                    <meta http-equiv="refresh" content="2; url=produk.php">
                    <div class="text-center mt-1">
                    <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>       
        <?php
                } else {
                    echo mysqli_error($conn);
                }
            }
        }
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock Availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <div>
                    <?php
                        if ($jumlahProduk == 0){
                    ?>
                        <tr>
                        <td colspan="6" class="text-center">Product is not available</td>
                        </tr>
                    <?php
                        } else {
                            $number = 1;
                            while ($data = mysqli_fetch_array($queryProduk)) {
                    ?>
                            <tr>
                                <td class="text-center"><?php echo $number; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                                <td class="text-center"><?php echo $data['ketersediaan_stok']; ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $data['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $data['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal fade" id="editModal<?php echo $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel<?php echo $data['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo $data['id']; ?>">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                <div>
                                                    <label for="nama">Name</label>
                                                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?php echo $data['nama']; ?>" required>
                                                </div>

                                                <div>
                                                    <label for="kategori">Category</label>
                                                    <select name="kategori" id="kategori" class="form-control" required>
                                                        <option value="">Select one</option>
                                                        <?php
                                                            $queryKategoriEdit = mysqli_query($conn, "SELECT * FROM kategori");
                                                            while($dataKategori = mysqli_fetch_array($queryKategoriEdit)){
                                                        ?>
                                                            <option value="<?php echo $dataKategori['id']; ?>" <?php if ($dataKategori['id'] == $data['kategori_id']) echo 'selected'; ?>><?php echo $dataKategori['nama']; ?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div>
                                                    <label for="harga">Price</label>
                                                    <input type="number" class="form-control" name="harga" value="<?php echo $data['harga']; ?>" required>
                                                </div> 

                                                <div>
                                                    <label for="foto">Foto</label>
                                                    <input type="file" name="foto" id="foto" class="form-control">
                                                    <img src="image/<?php echo $data['foto']; ?>" alt="" width="100px" class="mt-2">
                                                </div>

                                                <div>
                                                    <label for="detail">Detail</label>
                                                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail']; ?></textarea>
                                                </div>
                                                
                                                <div>
                                                    <label for="ketersediaan_stok">Stock Availability</label>
                                                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                                                        <option value="available" <?php if ($data['ketersediaan_stok'] == 'available') echo 'selected'; ?>>Available</option>
                                                        <option value="soldout" <?php if ($data['ketersediaan_stok'] == 'soldout') echo 'selected'; ?>>Sold Out</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                            // Update Produk
                            if (isset($_POST['update'])){
                                $id = htmlspecialchars($_POST['id']);
                                $nama = htmlspecialchars($_POST['nama']);
                                $kategori = htmlspecialchars($_POST['kategori']);
                                $harga = htmlspecialchars($_POST['harga']);
                                $detail = htmlspecialchars($_POST['detail']);
                                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                                $target_dir = "../image/";
                                $nama_file = basename($_FILES["foto"]["name"]);
                                $target_file = $target_dir . $nama_file;
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $imageSize = $_FILES["foto"]["size"];
                                $randomName = generateRandomString(10);
                                $newName = $randomName . '.' . $imageFileType;

                                if ($nama == '' || $kategori == '' || $harga == ''){
                            ?>
                                    <div class="alert alert-warning" role="alert">
                                        Name, Category, and Price must be filled!
                                    </div>
                            <?php    
                                } else {
                                    if ($nama_file != ''){
                                        if ($imageSize > 1000000) {
                            ?>
                                            <div class="alert alert-warning" role="alert">
                                                Files cannot be more than 1 mb!
                                            </div>
                            <?php
                                        } else {
                                            if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'){
                            ?>
                                                <div class="alert alert-warning" role="alert">
                                                    Uploaded files must be in JPG, PNG, JPEG format!
                                                </div>
                            <?php
                                            } else {
                                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $newName);
                                                // Delete foto lama
                                                unlink("image/".$data['foto']);
                                            }
                                        }
                                    } else {
                                        $newName = $data['foto'];
                                    }
                                    // Query update ke table produk
                                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', foto='$newName', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id'");

                                    if ($queryUpdate) {
                            ?>
                                       <!-- Refresh Otomatis -->
                                        <meta http-equiv="refresh" content="2; url=produk.php">
                                        <div class="text-center mt-1">
                                        <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>       
                            <?php
                                    } else {
                                        echo mysqli_error($conn);
                                    }
                                }
                            }
                            ?>

                            <!-- Modal Delete -->
                            <form action="" method="post">
                                <div class="modal fade" id="deleteModal<?php echo $data['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $data['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel<?php echo $data['id']; ?>">Delete Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                            <p>Are you sure you want to delete this product?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                            // Delete Produk
                            if (isset($_POST['delete'])){
                                $id = htmlspecialchars($_POST['id']);
                                // Query delete ke table produk
                                $queryDelete = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

                                if ($queryDelete) {
                                   
                                    
                            ?>
                                    <!-- Refresh Otomatis -->
                                    <meta http-equiv="refresh" content="2; url=produk.php">
                                    <div class="text-center mt-1">
                                    <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>       
                            <?php
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }
                            ?>

                    <?php
                            $number++;
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

     <!-- Bootstrap core JavaScript-->
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>
