<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-3">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 35px;"><?= $title ?> Pelamar</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="row mx-2">
                <div class="col-md-8 ml-10">
                    <div class="card card-primary ml-10">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">DataPelamar</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td><b><?php echo $pelamar['nama']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NISN/NIM</td>
                                    <td><b><?php echo $pelamar['nim']; ?></b></td>
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
                                        if ($pelamar['jeniskel'] == 'L') {
                                            echo '<b>Laki-Laki</b>';
                                        } else {
                                            echo '<b>Perempuan</b>';
                                        }
                                        ?>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php echo $pelamar['email']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><b><?php echo $pelamar['password']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><b><?php echo $pelamar['telepon']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Tingkat Pendidikan</td>
                                    <td><b><?php
                                            if ($pelamar['tingkat_pendidikan'] = 'mahasiswa') {
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
                <div class="col-md-4">
                    <div class="card card-primary mr-10" style="height: 50px;">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Foto Profil</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr class="text-center">
                                    <td><img class="border-right rounded-lg shadow img-thumbnail" src="<?= base_url('assets/data/peserta/pas_foto/' . $pelamar['foto']); ?>" alt="foto_peserta" style="width:150px; height:200px;"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="card card-primary mr-10 mt-5" style="height: 50px;">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Dokumen Pelamar</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr class="text-center">
                                    <td>
                                        <a class="btn btn-success" href="<?= base_url('assets/data/peserta/surat_pengantar/') . $pelamar['surat_pengantar'] ?>" target="_blank">Lihat Dokumen Pelamar</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>