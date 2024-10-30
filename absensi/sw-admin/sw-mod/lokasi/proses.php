<?php
session_start();

// Memeriksa apakah sesi pengguna valid
if (empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])) {
    header('location:../../login/');
    exit;
} else {
    // Memasukkan konfigurasi, session login, dan fungsi lain
    require_once '../../../sw-library/sw-config.php';
    require_once '../../login/login_session.php';
    include('../../../sw-library/sw-function.php');

    switch (@$_GET['action']) {

        /* --------------- Case 'add' --------------- */
        case 'add':
            // Fungsi untuk menghasilkan string acak (kode gedung)
            function acakangkahuruf($panjang) {
                $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $string = '';
                for ($i = 0; $i < $panjang; $i++) {
                    $pos = rand(0, strlen($karakter) - 1); // Mengambil posisi karakter acak
                    $string .= $karakter[$pos];  // Menggunakan kurung siku untuk indeks
                }
                return $string;
            }

            $year = date('Y'); // Inisialisasi variabel $year dengan tahun saat ini
            $code = 'SW' . acakangkahuruf(3) . '/' . $year;

            // Validasi input data dari form
            $error = array();

            if (empty($_POST['name'])) {
                $error[] = 'Nama tidak boleh kosong';
            } else {
                $name = mysqli_real_escape_string($connection, $_POST['name']);
            }

            if (empty($_POST['address'])) {
                $error[] = 'Alamat tidak boleh kosong';
            } else {
                $address = mysqli_real_escape_string($connection, $_POST['address']);
            }

            // Jika tidak ada error, proses untuk memasukkan data ke dalam database
            if (empty($error)) {
                $add = "INSERT INTO building (code, name, address, building_scanner) VALUES ('$code', '$name', '$address', '')";
                if ($connection->query($add) === false) {
                    die('Error: ' . $connection->error); // Tampilkan error query
                } else {
                    echo 'success'; // Sukses memasukkan data
                }
            } else {
                foreach ($error as $err) {
                    echo $err . '<br>'; // Tampilkan semua error inputan
                }
            }
            break;

        /* --------------- Case 'update' --------------- */
        case 'update':
            $error = array();

            if (empty($_POST['id'])) {
                $error[] = 'ID tidak boleh kosong';
            } else {
                $id = mysqli_real_escape_string($connection, $_POST['id']);
            }

            if (empty($_POST['name'])) {
                $error[] = 'Nama tidak boleh kosong';
            } else {
                $name = mysqli_real_escape_string($connection, $_POST['name']);
            }

            if (empty($_POST['address'])) {
                $error[] = 'Alamat tidak boleh kosong';
            } else {
                $address = mysqli_real_escape_string($connection, $_POST['address']);
            }

            // Jika tidak ada error, update data ke database
            if (empty($error)) {
                $update = "UPDATE building SET name='$name', address='$address' WHERE building_id='$id'";
                if ($connection->query($update) === false) {
                    die('Error: ' . $connection->error); // Tampilkan error query
                } else {
                    echo 'success'; // Sukses memperbarui data
                }
            } else {
                foreach ($error as $err) {
                    echo $err . '<br>'; // Tampilkan semua error inputan
                }
            }
            break;

        /* --------------- Case 'delete' --------------- */
        case 'delete':
            $id = mysqli_real_escape_string($connection, epm_decode($_POST['id']));

            // Cek apakah lokasi digunakan oleh karyawan (employees)
            $query = "SELECT building.building_id, employees.building_id 
                      FROM building, employees 
                      WHERE building.building_id = employees.building_id 
                      AND employees.building_id = '$id'";

            $result = $connection->query($query);

            // Jika tidak ada karyawan yang terkait dengan lokasi, hapus data
            if (!$result->num_rows > 0) {
                $deleted = "DELETE FROM building WHERE building_id='$id'";
                if ($connection->query($deleted) === true) {
                    echo 'success'; // Sukses menghapus data
                } else {
                    echo 'Data tidak berhasil dihapus.!';
                    die('Error: ' . $connection->error);
                }
            } else {
                echo 'Lokasi digunakan, Data tidak dapat dihapus.!';
            }
            break;
    }
}
