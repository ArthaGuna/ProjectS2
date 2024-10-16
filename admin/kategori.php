<?php 
    require '../session.php';
    require '../function.php';

    $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
    $jumlahKategori = mysqli_num_rows($queryKategori);

    $id = isset($_GET['c']) ? $_GET['c'] : '';
    $data = null;
    if ($id) {
        $query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
        $data = mysqli_fetch_array($query);
    }

    function formatTanggal($date){
        return date('d-m-Y H:i:s', strtotime($date));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amerta Sedana | Category </title>
    <link href="assets/images/icon.png" rel="shortcut icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/page.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <h1 class="h3 mb-4 text-gray-800 ms-4">Category</h1>
    
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
            </div>
        <form action="" method="post">
            <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <input type="text" name="kategori" placeholder="Input Category Name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name='simpan_kategori'>Save</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

            <!-- Insert Kategori  -->
            <?php
                if (isset($_POST['simpan_kategori'])){
                    $kategori = htmlspecialchars($_POST['kategori']);
                    
                    $queryCek = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama = '$kategori'");
                    $jumlahDataKategoriBaru = mysqli_num_rows($queryCek);
                    
                    if ($jumlahDataKategoriBaru > 0 ){
                        echo "<p class='alert alert-warning'>Categories are available!</p>";
                    } else {
                        $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama, tanggal) VALUES ('$kategori', NOW())");
            
                        if ($querySimpan) {
                            echo '<meta http-equiv="refresh" content="2; url=kategori.php">';
                            echo '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                        } else {
                            echo mysqli_error($conn);
                        }
                    }
                }

                // Edit Kategori 
                if (isset($_POST['editBtn'])) {
                    $id = $_POST['id'];
                    $kategori = htmlspecialchars($_POST['kategori']);

                    if ($data && $data['nama'] == $kategori){
                        echo '<meta http-equiv="refresh" content="0; url=kategori.php">';
                        echo '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                    } else {
                        $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama='$kategori'");
                        $jumlahData = mysqli_num_rows($query);

                        if ($jumlahData > 0){
                            echo "<p class='alert alert-warning'>Categories are available!</p>";
                        } else {
                            $querySimpan = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");

                            if ($querySimpan) {
                                echo '<meta http-equiv="refresh" content="2; url=kategori.php">';
                                echo '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                            } else {
                                echo mysqli_error($conn);
                            } 
                        }
                    }
                }
                
                // Delete Kategori
                if (isset($_POST['delBtn'])){
                    $id = $_POST['id'];
                    $queryCheck = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$id'");
                    $dataCount = mysqli_num_rows($queryCheck);

                    if ($dataCount > 0){
                        echo "<p class='alert alert-warning'>Categories cannot be deleted because they are already used in the product!</p>";
                        die();
                    }

                    $queryDelete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");

                    if ($queryDelete){
                        echo '<meta http-equiv="refresh" content="2; url=kategori.php">';
                        echo '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            ?>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th style="width: 30%;">Name</th>
                                <th>Date</th>
                                <th style="width: 25%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($jumlahKategori == 0){
                                    echo '<tr><td colspan="4" class="text-center">Category is not available</td></tr>';
                                } else {
                                    $number = 1;
                                    while ($data=mysqli_fetch_array($queryKategori)){
                            ?>
                                <tr>
                                    <td class="text-center"> <?php echo $number; ?> </td>
                                    <td> <?php echo $data['nama']?> </td>
                                    <td class="text-center"> <?php echo formatTanggal($data['tanggal'])?> </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal<?php echo $data['id'];?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal<?php echo $data['id'];?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                        <!-- Edit Modal -->
                                        <form action="" method="post">
                                            <div class="modal fade" id="editCategoryModal<?php echo $data['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCategoryModalLabel<?php echo $data['id'];?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCategoryModalLabel<?php echo $data['id'];?>">Edit Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <input type="text" name="kategori" value="<?php echo $data['nama']; ?>" class="form-control">
                                                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name='editBtn'>Save</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <!-- Delete Modal -->
                                        <form action="" method="post">
                                            <div class="modal fade" id="deleteCategoryModal<?php echo $data['id'];?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCategoryModalLabel<?php echo $data['id'];?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteCategoryModalLabel<?php echo $data['id'];?>">Delete Category</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure want to delete this category?
                                                        <h5 class="mt-1" style="color: red;"><?php echo $data['nama']; ?></h5>
                                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger" name='delBtn'>Delete</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>     
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
