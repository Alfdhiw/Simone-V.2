<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check"></i> List Verifikasi Pelamar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered databerkas" id="databerkas" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>Email </th>
                                    <th>Password</th>
                                    <th>Divisi</th>
                                    <th>Sekolah</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $p['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td class="text-center" style="text-transform:capitalize;"><a href="<?= base_url('sekretaris/detailpeserta/' . $p['kode_magang'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['email']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['password']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['divisi']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($p['tgl_terima'])) ?></b></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#verifModal<?= $p['kode_magang']; ?>"><i class="fa-solid fa-check"></i> <span style="font-size:15px;">Verif</span></a></span>
                                            <!-- Modal Verif-->
                                            <div class="modal fade" id="verifModal<?= $p['kode_magang'] ?>" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="verifModalLabel">Verifikasi Pelamar !</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('sekretaris/terimaberkas/' . $p['kode_magang']) ?>" method="POST">
                                                            <div class="modal-body text-left">
                                                                <p>Apakah yang bersangkutan telah melengkapi berkas? Jika iya silahkan konfirmasi untuk melanjutkan</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <span><a type="button" class="badge badge-danger" data-toggle="modal" data-target="#abortModal<?= $p['kode_magang']; ?>"><i class="fa-solid fa-xmark"></i> <span style="font-size:15px;">Tolak</span></a></span>
                                            <form action="<?= base_url('sekretaris/abort/' . $p['kode_magang']) ?>" method="POST">
                                                <!-- Modal Verif-->
                                                <div class="modal fade" id="abortModal<?= $p['kode_magang'] ?>" tabindex="-1" aria-labelledby="abortModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="abortModalLabel">Verifikasi Pelamar !</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <p style="font-size: 16px;">
                                                                    Dengan ini pelamar akan ditolak, apakah anda yakin ?
                                                                <p>
                                                                <p>
                                                                    <input type='hidden' name="status" id="status" value="3" />
                                                                    <input type="hidden" name="tgl_terima" value="<?= $date ?>">
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-success">Setuju</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check"></i> List Verifikasi Pelamar Kelompok</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered databerkas" id="databerkas" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Nama Perwakilan</th>
                                    <th>Email Kampus</th>
                                    <th>Sekolah</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kelompok as $p) : ?>
                                    <tr>

                                        <td class="text-center" style="text-transform:capitalize;"><a href="<?= base_url('sekretaris/datapelamar_kelompok/' . $p['kode_kelompok'])  ?>"><b><?= $p['nama_1']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['email_kampus']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y', strtotime($p['tgl_terima'])) ?></b></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#verifModal<?= $p['kode_kelompok']; ?>"><i class="fa-solid fa-check"></i> <span style="font-size:15px;">Verif</span></a></span>
                                            <!-- Modal Verif-->
                                            <div class="modal fade" id="verifModal<?= $p['kode_kelompok'] ?>" tabindex="-1" aria-labelledby="verifModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="verifModalLabel">Verifikasi Pelamar !</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('sekretaris/terimaberkaskelompok/' . $p['kode_kelompok']) ?>" method="POST">
                                                            <div class="modal-body text-left">
                                                                <p>Apakah yang bersangkutan telah melengkapi berkas? Jika iya silahkan konfirmasi untuk melanjutkan</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <span><a type="button" class="badge badge-danger" data-toggle="modal" data-target="#abortModal<?= $p['kode_kelompok']; ?>"><i class="fa-solid fa-xmark"></i> <span style="font-size:15px;">Tolak</span></a></span>
                                            <form action="<?= base_url('sekretaris/abort/' . $p['kode_kelompok']) ?>" method="POST">
                                                <!-- Modal Verif-->
                                                <div class="modal fade" id="abortModal<?= $p['kode_kelompok'] ?>" tabindex="-1" aria-labelledby="abortModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="abortModalLabel">Verifikasi Pelamar !</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <p style="font-size: 16px;">
                                                                    Dengan ini pelamar akan ditolak, apakah anda yakin ?
                                                                <p>
                                                                <p>
                                                                    <input type='hidden' name="status" id="status" value="3" />
                                                                    <input type="hidden" name="tgl_terima" value="<?= $date ?>">
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-success">Setuju</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
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