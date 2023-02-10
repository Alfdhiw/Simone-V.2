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
                                Total Peserta Magang</div>
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <a type="button" data-toggle="modal" data-target="#penyeliaModal" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                                Total Anggota Penyelia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalpenyelia ?> Penyelia</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
                <div class="card-footer text-warning">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a type="button" data-toggle="modal" data-target="#penyeliaModal" class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                View Chart
                            </a>
                        </div>
                        <!-- Modal Total Penyelia -->
                        <div class="modal fade" id="penyeliaModal" tabindex="-1" aria-labelledby="penyeliaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-secondary" id="penyeliaModalLabel"><i class="fa-solid fa-users"></i> Total Anggota Penyelia</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mx-auto text-secondary">
                                        <center class="text-secondary">
                                            <p>Jumlah Anggota Penyelia Berdasarkan Jenis Kelamin</p>
                                        </center>
                                        <div style="width: 650px;">
                                            <canvas id="penyeliaChart"></canvas>
                                        </div>
                                        <table class="mt-3">
                                            <tr>
                                                <td>
                                                    <li>Laki-Laki (L)</li>
                                                </td>
                                                <td>: <?= $totallaki ?> peserta</td>
                                                <td>&emsp;</td>
                                                <td>
                                                    <li>Perempuan (P)</li>
                                                </td>
                                                <td>: <?= $totalcewe ?> peserta</td>
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <a type="button" data-toggle="modal" data-target="#kuotaModal" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                Total Kuota Magang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $job['total'] ?> Kuota</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-pie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </a>
                <div class="card-footer text-success">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a type="button" data-toggle="modal" data-target="#kuotaModal" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                View Chart
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                    <!-- Modal Total Job -->
                    <div class="modal fade" id="kuotaModal" tabindex="-1" aria-labelledby="kuotaModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" style="width: 800px;">
                                <div class="modal-header">
                                    <h5 class="modal-title text-secondary" id="kuotaModalLabel"><i class="fas fa-chart-pie"></i> Total Kuota Magang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-secondary">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered dataloker" id="dataloker" width="100%" cellspacing="0">
                                            <thead class="thead-dark text-center">
                                                <tr>
                                                    <th>Divisi</th>
                                                    <th>Kuota</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($loker as $loker) : ?>
                                                    <tr>

                                                        <td class="text-center"><?= $loker['divisi']; ?></td>
                                                        <td class="text-center"><?= $loker['kuota']; ?></td>
                                                        <td class="text-center"><?php
                                                                                if ($loker['kuota'] == 0) {
                                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Kuota Penuh</span></span>';
                                                                                } else {
                                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Kuota Tersedia</span></span>';
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
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
                            <div class="modal-dialog">
                                <div class="modal-content" style="width: 800px;">
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
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($unverifuser as $us) : ?>
                                                        <tr>

                                                            <td class="text-center">
                                                                <img src="<?= base_url('assets/data/peserta/pas_foto/' . $us['foto']); ?>" class="img-thumbnail zoom" width="60px" alt="Foto <?= $us['nama'] ?>">
                                                            </td>
                                                            <td style="text-transform:capitalize;"><b><?= $us['nama'] ?></b></td>
                                                            <td style="text-transform:capitalize;"><b><?= $us['sekolah'] ?></b></td>
                                                            <td style="text-transform:capitalize;"><b><?= $us['divisi'] ?></b></td>
                                                            <td class="text-center"><?php
                                                                                    if ($us['status'] == 0) {
                                                                                        echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Unverif</span></span>';
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
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <a type="button" data-toggle="modal" data-target="#pendaftarModal" class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-info text-uppercase mb-3">Total Pendaftar Magang Yang Menunggu Berkas
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $proses ?> Pendaftar</div>
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
                            <a type="button" data-toggle="modal" data-target="#prosesModal" class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                View Detail
                            </a>
                        </div>
                        <!-- Modal Total proses -->
                        <div class="modal fade" id="prosesModal" tabindex="-1" aria-labelledby="prosesModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content" style="width: 800px;">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-secondary" id="prosesModalLabel"><i class="fas fa-clipboard-list"></i> Total Peserta Unverif</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-secondary">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered dataunproses" id="dataunproses" width="100%" cellspacing="0">
                                                <thead class="thead-dark text-center">
                                                    <tr>
                                                        <th>Foto</th>
                                                        <th>Nama</th>
                                                        <th>Sekolah</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($unproses as $us) : ?>
                                                        <tr>

                                                            <td class="text-center">
                                                                <img src="<?= base_url('assets/data/peserta/pas_foto/' . $us['foto']); ?>" class="img-thumbnail zoom" width="60px" alt="Foto <?= $us['nama'] ?>">
                                                            </td>
                                                            <td class="text-center" style="text-transform:capitalize;"><b><?= $us['nama'] ?></b></td>
                                                            <td class="text-center" style="text-transform:capitalize;"><b><?= $us['sekolah'] ?></b></td>
                                                            <td class="text-center"><?php
                                                                                    if ($us['status'] == 2) {
                                                                                        echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Menunggu Berkas</span></span>';
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
                                    <th>Jurusan</th>
                                    <th>Tingkat Pendidikan</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $p['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td class="text-center" style="text-transform:capitalize;"><a href="<?= base_url('sekretaris/datapelamar/' . $p['kode_magang'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['jurusan']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['tingkat_pendidikan']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($p['tgl_daftar'])) ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($p['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Unverified</span></span>';
                                                                }
                                                                if ($p['status'] == 1) {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                }
                                                                if ($p['status'] == 2) {
                                                                    echo '<span class="badge text-light bg-warning"><span style="font-size:15px;">Menunggu Berkas</span></span>';
                                                                }
                                                                if ($p['status'] == 3) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Ditolak</span></span>';
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