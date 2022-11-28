<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;">Dashboard</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Card Total Mahasiswa -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <a type="button" data-toggle="modal" data-target="#mahasiswaModal" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                Total Anggota Magang <?= $penyelia['divisi'] ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalpeserta ?> Peserta</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
                <div class="card-footer text-primary">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a type="button" data-toggle="modal" data-target="#mahasiswaModal" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                View Chart
                            </a>
                        </div>
                        <!-- Modal Total Mahasiswa -->
                        <div class="modal fade" id="mahasiswaModal" tabindex="-1" aria-labelledby="mahasiswaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-secondary" id="mahasiswaModalLabel"><i class="fa-solid fa-users"></i> Total Peserta Magang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mx-auto text-secondary">
                                        <center class="text-secondary">
                                            <p>Jumlah Peserta Magang Berdasarkan Tingkat Pendidikan (ROLE)</p>
                                        </center>
                                        <div style="width: 650px;">
                                            <canvas id="pesertaChart"></canvas>
                                        </div>
                                        <table class="mt-3">
                                            <tr>
                                                <td>
                                                    <li>Mahasiswa</li>
                                                </td>
                                                <td>: <?= $totalmhs ?> peserta</td>
                                                <td>&emsp;</td>
                                                <td>
                                                    <li>Siswa SMK</li>
                                                </td>
                                                <td>: <?= $totalswa ?> peserta</td>
                                            </tr>
                                        </table>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <a type="button" data-toggle="modal" data-target="#pendaftarModal" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-info text-uppercase mb-3">Total Pendaftar Magang Yang Menunggu Diverifikasi
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $unverif ?> Pendaftar</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto ml-3">
                            <i class="fas fa-clipboard-list fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </a>
                <div class="card-footer text-info">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a type="button" data-toggle="modal" data-target="#unverifModal" class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                View Detail
                            </a>
                        </div>
                        <!-- Modal Total Unverif -->
                        <div class="modal fade" id="unverifModal" tabindex="-1" aria-labelledby="unverifModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="width: 1000px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-secondary" id="unverifModalLabel"><i class="fas fa-clipboard-list"></i> Total Peserta Unverif</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-secondary">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered dataunverif" id="dataunverif" width="100%" cellspacing="0">
                                                <thead class="thead-dark text-center">
                                                    <tr>
                                                        <th>Foto</th>
                                                        <th>Nama</th>
                                                        <th>Sekolah</th>
                                                        <th>Divisi</th>
                                                        <th>Status</th>
                                                        <th>Konfirmasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($unverifuser as $us) : ?>
                                                        <tr>

                                                            <td class="text-center">
                                                                <img src="<?= base_url('assets/data/peserta/pas_foto/' . $us['foto']); ?>" class="img-thumbnail zoom" width="60px" alt="Foto <?= $us['nama'] ?>">
                                                            </td>
                                                            <td><b><?= $us['nama'] ?></b></td>
                                                            <td><b><?= $us['sekolah'] ?></b></td>
                                                            <td><b><?= $us['divisi'] ?></b></td>
                                                            <td class="text-center"><?php
                                                                                    if ($us['status'] == 0) {
                                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Unverif</span></span>';
                                                                                    }
                                                                                    if ($us['status'] == 1) {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                                    }
                                                                                    ?>
                                                            </td>
                                                            <td class="text-center"><?php
                                                                                    if ($us['konfirmasi'] == 0) {
                                                                                        echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Belum</span></span>';
                                                                                    }
                                                                                    if ($us['konfirmasi'] == 1) {
                                                                                        echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Sudah</span></span>';
                                                                                    }
                                                                                    ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa-regular fa-pen-to-square"></i> Pendaftar Baru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered databaru" id="databaru" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>Sekolah</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status</th>
                                    <th>Konfirmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $p['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td><a href="<?= base_url('dashboard/datapelamar/' . $p['kode_magang'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td><b><?= $p['sekolah']; ?></b></td>
                                        <td><b><?= $p['divisi']; ?></b></td>
                                        <td><b><?= date('j F Y H:i:s', strtotime($p['tgl_daftar'])) ?></b></td>
                                        <td><b><?= date('j F Y H:i:s', strtotime($p['tgl_terima'])) ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($p['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Unverified</span></span>';
                                                                }
                                                                if ($p['status'] == 1) {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                }
                                                                if ($p['status'] == 2) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center"><?php
                                                                if ($p['konfirmasi'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Belum</span></span>';
                                                                }
                                                                if ($p['konfirmasi'] == 1) {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Sudah</span></span>';
                                                                }
                                                                ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->