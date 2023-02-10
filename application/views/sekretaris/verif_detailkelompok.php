<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-3">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 35px;"><?= $title ?> Pelamar</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <div class="row mx-2 mb-4">
                <div class="col-md-12 ml-12">
                    <div class="card card-primary ml-10">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">DataPelamar 1</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td><b><?php echo $pelamar['nama_1']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NISN/NIM</td>
                                    <td><b><?php echo $pelamar['nim_1']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td><b><?php echo $pelamar['jurusan']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td><b><?php echo $pelamar['sekolah']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Email Sekolah</td>
                                    <td><b><?php echo $pelamar['email_kampus']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php
                                        if ($pelamar['jeniskel_1'] == 'L') {
                                            echo '<b>Laki-Laki</b>';
                                        } else {
                                            echo '<b>Perempuan</b>';
                                        }
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php echo $pelamar['email_1']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><b><?php echo $pelamar['telp_1']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Tingkat Pendidikan</td>
                                    <td><b><?php
                                            if ($pelamar['tingkat_pendidikan'] == 'mahasiswa') {
                                                echo '<span class="text" style="font-size:16px"><b>Mahasiswa</b></span>';
                                            } else {
                                                echo '<span class="text" style="font-size:16px;"><b>Siswa</b></span>';
                                            }
                                            ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Akun</td>
                                    <td><?php
                                        if ($pelamar['status'] == 1) {
                                            echo '<b><span class="badge badge-success" style="font-size:15px;"><b>Telah Diverifikasi</b></span>';
                                        } else {
                                            echo '<span class="badge badge-secondary" style="background-color:secondary;"><b>Belum Diverifikasi</b></span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-2 mb-4">
                <div class="col-md-12 ml-12">
                    <div class="card card-primary ml-10">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">DataPelamar 2</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td><b><?php echo $pelamar['nama_2']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NISN/NIM</td>
                                    <td><b><?php echo $pelamar['nim_2']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td><b><?php echo $pelamar['jurusan']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Asal Sekolah</td>
                                    <td><b><?php echo $pelamar['sekolah']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Email Sekolah</td>
                                    <td><b><?php echo $pelamar['email_kampus']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php
                                        if ($pelamar['jeniskel_2'] == 'L') {
                                            echo '<b>Laki-Laki</b>';
                                        } else {
                                            echo '<b>Perempuan</b>';
                                        }
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php echo $pelamar['email_2']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><b><?php echo $pelamar['telp_2']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Tingkat Pendidikan</td>
                                    <td><b><?php
                                            if ($pelamar['tingkat_pendidikan'] == 'mahasiswa') {
                                                echo '<span class="text" style="font-size:16px"><b>Mahasiswa</b></span>';
                                            } else {
                                                echo '<span class="text" style="font-size:16px;"><b>Siswa</b></span>';
                                            }
                                            ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status Akun</td>
                                    <td><?php
                                        if ($pelamar['status'] == 1) {
                                            echo '<b><span class="badge badge-success" style="font-size:15px;"><b>Telah Diverifikasi</b></span>';
                                        } else {
                                            echo '<span class="badge badge-secondary" style="background-color:secondary;"><b>Belum Diverifikasi</b></span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($pelamar['nama_3'] == null) {
                echo '';
            } else {
                require_once('kolom3.php');
            }
            ?>
        </div>
    </div>
</div>