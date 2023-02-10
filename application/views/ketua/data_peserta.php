<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Mahasiswa</h1>
        <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#dataModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
        <!-- Modal -->
        <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="dataModalLabel">Cetak Report Data</h1>
                    </div>
                    <form action="<?= base_url('ketua/cetak_laporan') ?>" method="post" id="tes1">
                        <div class="modal-body">
                            <table>
                                <tr>
                                    <td><b>Periode</b></td>
                                    <td>:</td>
                                    <td></td>
                                    <td><input class="form-control" type="date" name="from" id="from"></td>
                                    <td><b>-</b></td>
                                    <td><input class="form-control" type="date" name="to" id="to"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-primary" type="button" target="_blank" onclick="myFunction()">Cetak</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <div class="row">
                <div class="col-xl-12 col-md-12 mb-6">
                    <form action="" method="get">
                        <table class="text-right">
                            <tr>
                                <td><b>Periode :&ensp;</b></td>
                                <td><input type="date" name="from" class="form-control" required></td>
                                <td><b>-</b></td>
                                <td><input type="date" name="to" class="form-control" required></td>
                                <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <br>
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered datamhs" id="datamhs" width="100%" cellspacing="0">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Foto</th>
                            <th>Nama Mahasiswa</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Divisi</th>
                            <th>Status Verif</th>
                            <th>Status Magang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['from']) && isset($_GET['to'])) {
                            // tampilkan data yang sesuai dengan range tanggal yang dicari 
                            $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='mahasiswa' and p.status='1' and p.tgl_terima BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                        } else {
                            //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                            $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='mahasiswa' and p.status='1'");
                        }
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <!-- <td><?= $i; ?></td> -->
                                <td class="text-center">
                                    <img src="<?= base_url('assets/data/peserta/pas_foto/' . $d['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $d['nama'] ?>">
                                </td>
                                <td style="text-transform:capitalize;"><a href="<?= base_url('ketua/datamhs/' . $d['kode_magang'])  ?>"><b><?= $d['nama']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                <td style="text-transform:capitalize;"><b><?= $d['sekolah']; ?></b></td>
                                <td style="text-transform:capitalize;"><b><?= $d['jurusan']; ?></b></td>
                                <td style="text-transform:capitalize;"><b><?= $d['divisi'] ?></b></td>
                                <td class="text-center"><?php
                                                        if ($d['status'] == 0) {
                                                            echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                        } else {
                                                            echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                        }
                                                        ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($d['is_active'] == 0) {
                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Mangkir</span></span>';
                                    } else {
                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<hr>
<br>
<br>
<div class="container-fluid mt-5">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Siswa</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="row">
                <div class="col-xl-6 col-md-6 mb-4">
                    <form action="" method="get">
                        <table class="text-right">
                            <tr>
                                <td><b>Periode :&ensp;</b></td>
                                <td><input type="date" name="dari" class="form-control" required></td>
                                <td><b>-</b></td>
                                <td><input type="date" name="ke" class="form-control" required></td>
                                <td>&ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-magnifying-glass"></i></button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <!-- DataTales Example -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered dataswa" id="dataswa" width="100%" cellspacing="0">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Foto</th>
                            <th>Nama Mahasiswa</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Divisi</th>
                            <th>Status Verif</th>
                            <th>Status Magang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['dari']) && isset($_GET['ke'])) {
                            // tampilkan data yang sesuai dengan range tanggal yang dicari 
                            $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='siswa' and p.status='1' and p.tgl_terima BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'");
                        } else {
                            //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                            $data = mysqli_query($con, "SELECT p. * ,k.divisi from peserta_magang p, kategori_magang k where  p.kode_kategori=k.kode_kategori  and p.tingkat_pendidikan='siswa' and p.status='1'");
                        }
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?= base_url('assets/data/peserta/pas_foto/' . $d['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $d['nama'] ?>">
                                </td>
                                <td style="text-transform:capitalize;"><a href="<?= base_url('ketua/datamhs/' . $d['kode_magang'])  ?>"><b><?= $d['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                <td style="text-transform:capitalize;"><b><?= $d['sekolah']; ?></b></td>
                                <td style="text-transform:capitalize;"><b><?= $d['jurusan']; ?></b></td>
                                <td style="text-transform:capitalize;"><b><?= $d['divisi']; ?></td>
                                <td class="text-center"><?php
                                                        if ($d['status'] == 0) {
                                                            echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                        } else {
                                                            echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                        }
                                                        ?></td>
                                <td class="text-center"><?php
                                                        if ($d['is_active'] == 0) {
                                                            echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Mangkir</span></span>';
                                                        } else {
                                                            echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                                        }
                                                        ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.data_mahasiswa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.data_siswa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
</script>
<!-- End of Main Content -->