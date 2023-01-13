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
                        <table class="table table-hover table-bordered datapelamar" id="datapelamar" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>Sekolah</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $p['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('dashboard/datapelamar/' . $p['kode_magang'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $p['divisi']; ?></b></td>
                                        <td><b><?= date('j F Y H:i:s', strtotime($p['tgl_daftar'])) ?></b></td>
                                        <td class="text-center">
                                            <span><a type="button" class="badge badge-success" data-toggle="modal" data-target="#verifModal<?= $p['kode_magang']; ?>"><i class="fa-solid fa-check"></i> <span style="font-size:15px;">Verif</span></a></span>
                                            <form action="<?= base_url('dashboard/confirm/' . $p['kode_magang']) ?>" method="POST">
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
                                                            <div class="modal-body text-left">
                                                                <p style="font-size: 16px;">
                                                                    Dengan ini setelah pelamar diverifikasi, data selanjutnya akan diproses oleh divisi masing-masing.
                                                                <p>
                                                                <p>
                                                                    <input type='hidden' name="tingkat_pendidikan" id="tingkat_pendidikan" value="<?= $p['tingkat_pendidikan'] ?>" />
                                                                    <input type='hidden' name="status" id="status" value="1" />
                                                                    <input type="hidden" name="tgl_terima" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                    echo date('Y-m-d H:i:s'); ?>">
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
                                            <span><a type="button" class="badge badge-danger" data-toggle="modal" data-target="#abortModal<?= $p['kode_magang']; ?>"><i class="fa-solid fa-xmark"></i> <span style="font-size:15px;">Tolak</span></a></span>
                                            <form action="<?= base_url('dashboard/abort/' . $p['kode_magang']) ?>" method="POST">
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
                                                                    Dengan ini setelah pelamar ditolak, silahkan hubungi nomer ini <span><a target="_blank" href="https://wa.me/<?= $p['telepon']; ?>"><?= $p['telepon'] ?></a></span> untuk pemberitahuan pelamar.
                                                                <p>
                                                                <p>
                                                                    <input type='hidden' name="tingkat_pendidikan" id="tingkat_pendidikan" value="<?= $p['tingkat_pendidikan'] ?>" />
                                                                    <input type='hidden' name="status" id="status" value="2" />
                                                                    <input type="hidden" name="tgl_terima" value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                    echo date('Y-m-d H:i:s'); ?>">
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