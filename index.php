<?php
include 'koneksi.php';

// Menambahkan buku
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];

    $query = "INSERT INTO buku (judul, penulis, tahun) VALUES ('$judul', '$penulis', '$tahun')";
    mysqli_query($conn, $query);
}

// Menghapus buku
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query = "DELETE FROM buku WHERE id = $id";
    mysqli_query($conn, $query);
}

// Mengambil data buku
$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
   
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="logo.png" alt="" width="50">
      Perpustakaan Online
    </a>
  </div>
</nav>

<div class="continer">



<!-- <h1>Daftar Buku</h1>
    <form method="POST">
        <input type="text" name="judul" placeholder="Judul Buku" required>
        <input type="text" name="penulis" placeholder="Penulis" required>
        <input type="number" name="tahun" placeholder="Tahun" required>
        <button type="submit" name="tambah">Tambah Buku</button>
    </form> -->

    <br><br>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
        <?php while ($buku = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $buku['id']; ?></td>
            <td><?php echo $buku['judul']; ?></td>
            <td><?php echo $buku['penulis']; ?></td>
            <td><?php echo $buku['tahun']; ?></td>
            <td><a class="btn btn-danger" href="?hapus=<?php echo $buku['id']; ?>">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
// ... kode sebelumnya tetap sama

// Mengupdate buku
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];

    $query = "UPDATE buku SET judul='$judul', penulis='$penulis', tahun='$tahun' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: index.php");
}

// Cek jika ada id untuk diedit
$bukuEdit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM buku WHERE id = $id";
    $resultEdit = mysqli_query($conn, $query);
    $bukuEdit = mysqli_fetch_assoc($resultEdit);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Perpustakaan</title>
</head>
<style>
    body {
        margin: auto;
    }

    .container-form {}
</style>
<body>

<br><br><br>


<h1>Tambah Daftar Buku</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $bukuEdit ? $bukuEdit['id'] : ''; ?>">
        <input type="text" name="judul" placeholder="Judul Buku" value="<?php echo $bukuEdit ? $bukuEdit['judul'] : ''; ?>" required>
        <input type="text" name="penulis" placeholder="Penulis" value="<?php echo $bukuEdit ? $bukuEdit['penulis'] : ''; ?>" required>
        <input type="number" name="tahun" placeholder="Tahun" value="<?php echo $bukuEdit ? $bukuEdit['tahun'] : ''; ?>" required>
        <button class="btn btn-success" type="submit" name="<?php echo $bukuEdit ? 'update' : 'tambah'; ?>">
            <?php echo $bukuEdit ? 'Update Buku' : 'Tambah Buku'; ?>
        </button>
    </form>
</div>
    

    <table border="1">
        <!-- <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr> -->
        <?php while ($buku = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?php echo $buku['id']; ?></td>
            <td><?php echo $buku['judul']; ?></td>
            <td><?php echo $buku['penulis']; ?></td>
            <td><?php echo $buku['tahun']; ?></td>
            <td>
                <a href="?edit=<?php echo $buku['id']; ?>">Edit</a>
                <a href="?hapus=<?php echo $buku['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    
</div>


<footer class="bg-body-tertiary text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2025 Copyright: Created by Kelompok 3
  </div>
  <!-- Copyright -->
</footer>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
</body>
</html>