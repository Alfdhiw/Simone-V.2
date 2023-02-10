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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check"></i> List Konfirmasi</h6>
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
                                    <th>Tanggal Diterima</th>
                                    <th>Telepon</th>
                                    <th>Konfirmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $p['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('penyelia/datapelamar/' . $p['kode_magang'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $p['divisi']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($p['tgl_terima'])) ?></b></td>
                                        <td><b><a href="https://wa.me/<?= $p['telepon'] ?>" target="_blank"><?= $p['telepon']; ?> <i class="fa-brands fa-whatsapp"></i></a></b></td>
                                        <td class="text-center"><?php
                                                                if ($p['konfirmasi'] == 0) {
                                                                    echo '<span class="btn text-light bg-danger" data-toggle="modal" data-target="#konfirmasiModal"><span style="font-size:15px;">Belum</span></span>';
                                                                }
                                                                if ($p['konfirmasi'] == 1) {
                                                                    echo '<span class="btn text-light bg-success"><span style="font-size:15px;">Sudah</span></span>';
                                                                }
                                                                ?></td>
                                    </tr>
                                    <!-- Modal Konfirmasi -->
                                    <div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Anggota</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('penyelia/confirm/' . $p['kode_magang']) ?>" method="POST">
                                                    <div class="modal-body">
                                                        Peserta Akan Dikonfirmasi Diterima Melalui Email.
                                                        <input type='hidden' name="konfirmasi" id="konfirmasi" value="1" />
                                                        <input type='hidden' name="email" id="email" value="<?= $p['email'] ?>" />
                                                        <input type='hidden' name="nama" id="nama" value="<?= $p['nama'] ?>" />
                                                        <input type='hidden' name="divisi" id="divisi" value="<?= $p['divisi'] ?>" />
                                                        <input type='hidden' name="password" id="password" value="<?= $p['password'] ?>" />

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Confirm</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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