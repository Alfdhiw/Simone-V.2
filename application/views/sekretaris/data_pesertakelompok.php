<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
        <btn href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#dataModal"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Report</btn>
        <!-- Modal -->
        <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="dataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="dataModalLabel">Cetak Report Data</h1>
                    </div>
                    <form action="<?= base_url('sekretaris/cetak_laporankelompok') ?>" method="post" id="tes1">
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
        <div class="col-xl-12 col-md-6">
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

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datakelompokx" id="datakelompokx" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Nama Perwakilan</th>
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['from']) && isset($_GET['to'])) {
                                    // tampilkan data yang sesuai dengan range tanggal yang dicari 
                                    $data = mysqli_query($con, "SELECT p. * from peserta_kelompok p where p.tgl_terima BETWEEN '" . $_GET['from'] . "' and '" . $_GET['to'] . "'");
                                } else {
                                    //jika tidak ada tanggal dari dan tanggal ke maka tampilkan seluruh data
                                    $data = mysqli_query($con, "SELECT p. * from peserta_kelompok p");
                                }
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center" style="text-transform:capitalize;"><a href="<?= base_url('sekretaris/datapelamar_kelompok/' . $d['kode_kelompok'])  ?>"><b><?= $d['nama_1']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $d['sekolah']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $d['jurusan']; ?></b></td>
                                        <td class="text-center">
                                            <?php
                                            if ($d['status'] == 1) {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            } elseif ($d['status'] == 2) {
                                                echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Menunggu Berkas</span></span>';
                                            } elseif ($d['status'] == 3) {
                                                echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Ditolak</span></span>';
                                            } else {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Ditolak</span></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <span><a id="btn-hapus" type="button" href="<?= base_url('sekretaris/deletekelompok/' . $d['kode_kelompok']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> <span style="font-size:15px;">Hapus</span></a></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
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