<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "Belajar_PHP";

$koneksi = mysqli_connect($host, $username, $password, $db);
if ($koneksi) {
}

$nama = "";
$email = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "delete from user where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);

    if ($q1) {
        $sukses = "berhasil menghapus data";
    } else {
        $error = "gagal hapus data";
    }
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "select * from user where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama = $r1['nama'];
    $email = $r1['email'];

    if ($nama == '') {
        $error = "data tidak di temukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];


    if ($nama && $email) {
        if ($op == 'edit') {
            $sql1 = "update user set nama = '$nama' , email = '$email' where id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "data berhasil di update";
            } else {
                $error = "data gagal di update";
            }
        } else {
            $sql1 = "insert into user(nama,email) values('$nama','$email')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "berhasil memasukan data baru";
            } else {
                $error = "gagal menampilkan data";
            }
        }
    } else {
        $error = "silahkan masukan data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {}
            }
        }
    </script>
    <title>Belajar CRUD</title>
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
    </style>
</head>

<body>

    <div class="bg-blue-200 min-h-screen flex items-center">
        <div class="w-full">
            <div class="flex flex-col max-w-lg mt-20 mx-auto">
                <?php
                if ($error) {
                ?>
                    <div class="flex inline-flex justify-between bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-2 rounded  "
                        role="alert">
                        <span class="block sm:inline pl-2">
                            <strong class="font-bold"> Error</strong>
                            <?php echo $error ?>
                        </span>
                        <span class="inline" onclick="return this.parentNode.remove();">
                            <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="flex inline-flex justify-between bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 my-2 rounded "
                        role="alert">
                        <span class="block sm:inline pl-2">
                            <strong class="font-bold">Success</strong>
                            <?php echo $sukses ?>
                        </span>
                        <span class="inline" onclick="return this.parentNode.remove();">
                            <svg class="fill-current h-6 w-6" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>

                    </div>
                <?php
                }
                ?>
            </div>
            <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Selamat Datang Di Latihan CRUD</h2>
            <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                <form action="" method="post">
                    <div class="mb-5">
                        <label for="username" class="block mb-2 font-bold text-gray-600">Nama</label>
                        <input type="text" id="username" name="nama" placeholder="Isi nama kalian." class="border border-gray-300 shadow p-3 w-full rounded mb-">
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block mb-2 font-bold text-gray-600">Email</label>
                        <input type="email" id="email" name="email" placeholder="Isi email kalian." class="border border-red-300 shadow p-3 w-full rounded mb-">
                    </div>

                    <input type="submit" name="simpan" value="simpan" class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">
                </form>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-blue-500 divide-y divide-gray-200">
                    <?php
                    $sql2 = "select * from user order by id desc";
                    $q2 = mysqli_query($koneksi, $sql2);
                    while ($data1 = mysqli_fetch_array($q2)) {
                        $id = $data1['id'];
                        $nama = $data1['nama'];
                        $email = $data1['email'];
                        $nomer = 1;
                    ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $nomer++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $nama ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $email ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="index.php?op=edit&id=<?php echo $id ?>"><button class="px-4 py-2 font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue active:bg-blue-600 transition duration-150 ease-in-out">Edit</button></a>
                                <a href="index.php?op=delete&id=<?php echo $id ?>"><button class="ml-2 px-4 py-2 font-medium text-white bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:shadow-outline-red active:bg-red-600 transition duration-150 ease-in-out" onclick="return confrim('yakin hapus data?')">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>