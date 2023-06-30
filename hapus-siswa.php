<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $nisn = $_POST['nisn'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    // Lakukan validasi data (jika diperlukan)
    $errors = [];

    if (empty($nisn)) {
        $errors[] = 'NISN siswa harus diisi.';
    }

    if (empty($nama_lengkap)) {
        $errors[] = 'Nama lengkap siswa harus diisi.';
    }

    if (empty($alamat)) {
        $errors[] = 'Alamat siswa harus diisi.';
    }

    // Jika tidak ada error validasi, lakukan pembaruan data
    if (empty($errors)) {
        $query = "DELETE FROM tbl_siswa WHERE id_siswa = $id_siswa";

        $result = mysqli_query($connection, $query);

        if ($result) {
            // Jika pembaruan berhasil, arahkan pengguna ke halaman lain (misalnya halaman daftar siswa)
            header('Location: index.php');
            exit();
        } else {
            $errors[] = 'Gagal melakukan pembaruan data. Silakan coba lagi.';
        }
    }
}

$id = $_GET['id'];

$query = "SELECT * FROM tbl_siswa WHERE id_siswa = $id LIMIT 1";

$result = mysqli_query($connection, $query);

$row = mysqli_fetch_array($result);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <title>Edit Siswa</title>
</head>

<body>

    <div class="container" style="margin-top: 80px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        EDIT SISWA
                    </div>
                    <div class="card-body">
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li>
                                            <?php echo $error; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">

                            <div class="form-group">
                                <label>NISN</label>
                                <input type="text" name="nisn" value="<?php echo $row['nisn'] ?>"
                                    placeholder="Masukkan NISN Siswa" class="form-control">
                                <input type="hidden" name="id_siswa" value="<?php echo $row['id_siswa'] ?>">
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" value="<?php echo $row['nama'] ?>"
                                    placeholder="Masukkan Nama Siswa" class="form-control">

                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat Siswa"
                                    rows="4"><?php echo $row['alamat'] ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button type="reset" class="btn btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>