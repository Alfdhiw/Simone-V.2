<div class="mahadashboard">
    <div class="container-fluid pt-5">
        <h1 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="pr-3" style="color: #444444; font-weight:500;">Dashboard</span></h1>
        <div class="row px-xl-5 pb-3">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-dark text-white mb-4">
                    <div class="card-body" style="font-size: 20px; font-weight:500;"><i class="fa-solid fa-boxes-stacked"></i> Data Absen
                        </br>
                        <h4 class="mx-auto my-auto text-white"><?= $totalabsen ?> Absen</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#" data-toggle="modal" data-target="#absenModal" type="button">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
                <!-- Modal Total Absen -->
                <div class="modal fade" id="absenModal" tabindex="-1" aria-labelledby="absenModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-secondary" id="absenModalLabel"><i class="fa-solid fa-users"></i> Total Absen Peserta Magang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-auto text-secondary">
                                <center class="text-secondary mb-5">
                                    <p>Jumlah Absen Peserta Magang Berdasarkan Status Absen</p>
                                </center>
                                <div style="width: 650px;">
                                    <canvas id="absenChart"></canvas>
                                </div>
                                <table class="mt-5">
                                    <tr>
                                        <td>
                                            <li>Absen Masuk</li>
                                        </td>
                                        <td>: <?= $totalmasuk ?> absen</td>
                                        <td>&emsp;</td>
                                        <td>
                                            <li>Absen Ijin</li>
                                        </td>
                                        <td>: <?= $totalijin ?> absen</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <li>Tidak Absen</li>
                                        </td>
                                        <td>: <?= $totallibur ?> absen</td>
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
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body" style="font-size: 20px; font-weight:500;"><i class="fa-solid fa-boxes-stacked"></i> Penilaian Magang
                        </br>
                        <h5 class="mx-auto my-auto text-white"><?= $totalnilai ?> Penilaian</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="<?= base_url('home/penilaian') ?>">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body" style="font-size: 20px; font-weight:500;"><i class="fa-solid fa-arrow-right-arrow-left"></i> sertifikat Magang
                        </br>
                        <h5 class="mx-auto my-auto text-white">1 sertifikat</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="large text-white stretched-link" href="#" data-toggle="modal" data-target="#transaksiModal">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-1 pb-1">
            <h1 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="pr-3" style="color: #444444; font-weight:500;">Absensi Magang</span></h1>
        </div>
        <div class="row px-xl-5 pb-3">
            <a class="btn btn-success" href="<?= base_url('home/absen') ?>"><i class="fas fa-solid fa-plus"></i> Tambah Absen </a>
        </div>
        <div class="row px-xl-5 pb-3">
            <div class="col-xl-12 card mb-4 bg-light">
                <div class="card-header bg-light">
                    <i class="fas fa-table me-1"></i>
                    Riwayat Absensi Terbaru
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataabsen" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Surat Ijin</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($absen as $absen) : ?>
                                    <tr>
                                        <td class="text-center <?php if ($absen['status'] == 1) {
                                                                    echo 'table-success';
                                                                } else if ($absen['status'] == 2) {
                                                                    echo 'table-warning';
                                                                } else {
                                                                    echo 'table-danger';
                                                                } ?>">#</td>
                                        <td class="text-center <?php if ($absen['status'] == 1) {
                                                                    echo 'table-success';
                                                                } else if ($absen['status'] == 2) {
                                                                    echo 'table-warning';
                                                                } else {
                                                                    echo 'table-danger';
                                                                } ?>"><?= date('j F Y H:i:s', strtotime($absen['tgl_absen'])) ?></td>
                                        <td class="<?php if ($absen['status'] == 1) {
                                                        echo 'table-success';
                                                    } else if ($absen['status'] == 2) {
                                                        echo 'table-warning';
                                                    } else {
                                                        echo 'table-danger';
                                                    } ?>"><?= $absen['kegiatan'] ?></td>
                                        <td class="text-center <?php if ($absen['status'] == 1) {
                                                                    echo 'table-success';
                                                                } else if ($absen['status'] == 2) {
                                                                    echo 'table-warning';
                                                                } else {
                                                                    echo 'table-danger';
                                                                } ?>"><b><?php if ($absen['surat_ijin'] == null) {
                                                                                echo '<a type="button" class="badge badge-secondary"><span class="text-light" style="font-size:15px;">No Data <i class ="fas fa-exclamation"></i></span></a>';
                                                                            } else {
                                                                                echo '<a type="button" href="' . base_url('assets/data/peserta/surat_ijin/') . '' . $absen['surat_ijin'] . '" target="_blank" class="btn btn-success"><span style="font-size:15px;">Download File <i class ="text-light fas fa-solid fa-download"> </i></span></a>';
                                                                            } ?> </b>
                                        </td>
                                        <td class="text-center <?php if ($absen['status'] == 1) {
                                                                    echo 'table-success';
                                                                } else if ($absen['status'] == 2) {
                                                                    echo 'table-warning';
                                                                } else {
                                                                    echo 'table-danger';
                                                                } ?>"><b><?php if ($absen['status'] == 0) {
                                                                                echo '<span class="badge badge-danger"><span style="font-size:15px;">Belum Absen</span></span>';
                                                                            } else if ($absen['status'] == 1) {
                                                                                echo '<span class="badge badge-success"><span style="font-size:15px;">Sudah Absen</span></span>';
                                                                            } else {
                                                                                echo '<span class="badge badge-warning"><span style="font-size:15px;">Ijin Absen</span></span>';
                                                                            } ?></b>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Products End -->
        <script>
            $(document).ready(function() {
                $('#dataabsen').DataTable({
                    "pageLength": 10,
                    order: [
                        [0, 'desc']
                    ]
                });
            });
        </script>