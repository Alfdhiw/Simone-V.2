<div class="row mx-2 mb-4">
    <div class="col-md-12 ml-12">
        <div class="card card-primary ml-10">
            <div class="card-header" style="background-color: #005B5C;">
                <h5 class="card-heading" style="font-weight: 600; color:white;">DataPelamar 3</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-striped table-hover">
                    <tr>
                        <td>Nama</td>
                        <td><b><?php echo $pelamar['nama_3']; ?></b></td>
                    </tr>
                    <tr>
                        <td>NISN/NIM</td>
                        <td><b><?php echo $pelamar['nim_3']; ?></b></td>
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
                            if ($pelamar['jeniskel_3'] == 'L') {
                                echo '<b>Laki-Laki</b>';
                            } else {
                                echo '<b>Perempuan</b>';
                            }
                            ?>
                        </td>

                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><b><?php echo $pelamar['email_3']; ?></b></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><b><?php echo $pelamar['telp_3']; ?></b></td>
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