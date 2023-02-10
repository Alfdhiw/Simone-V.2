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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check"></i> List Verifikasi Pelamar Kelompok</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datapelamarkel" id="datapelamarkel" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Nama Perwakilan</th>
                                    <th>Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Tingkat Pendidikan</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kelompok as $p) : ?>
                                    <tr>
                                        <td class="text-center" style="text-transform:capitalize;"><a href="<?= base_url('sekretaris/datapelamar_kelompok/' . $p['kode_kelompok'])  ?>"><b><?= $p['nama_1']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['jurusan']; ?></b></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['tingkat_pendidikan']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($p['tgl_daftar'])) ?></b></td>
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
                                                        <form action="<?= base_url('sekretaris/terimakelompok/' . $p['kode_kelompok']) ?>" method="POST">
                                                            <div class="modal-body text-left">
                                                                <p>Dengan ini pelamar diterima dan akan melakukan pengumpulan berkas. Klik "submit" untuk melanjutkan pengiriman email</p>
                                                                <input type="hidden" name="tgl_terima" value="<?= $date ?>">
                                                                <input type="hidden" name="nama1" value="<?= $p['nama_1'] ?>">
                                                                <input type="hidden" name="nama2" value="<?= $p['nama_2'] ?>">
                                                                <input type="hidden" name="nama3" value="<?= $p['nama_3'] ?>">
                                                                <input type="hidden" name="nim1" value="<?= $p['nim_1'] ?>">
                                                                <input type="hidden" name="nim2" value="<?= $p['nim_2'] ?>">
                                                                <input type="hidden" name="nim3" value="<?= $p['nim_3'] ?>">
                                                                <input type="hidden" name="jurusan" value="<?= $p['jurusan'] ?>">
                                                                <input type="hidden" name="sekolah" value="<?= $p['sekolah'] ?>">
                                                                <input type="hidden" name="email_kampus" value="<?= $p['email_kampus'] ?>">
                                                                <input type="hidden" name="telp" value="<?= $sekretaris['telepon'] ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-success" onclick="openInNewTab('mailto:<?= $p['email_kampus'] ?>')">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <span><a type="button" class="badge badge-danger" data-toggle="modal" data-target="#abortModal<?= $p['kode_kelompok']; ?>"><i class="fa-solid fa-xmark"></i> <span style="font-size:15px;">Tolak</span></a></span>
                                            <form action="<?= base_url('sekretaris/abortkelompok/' . $p['kode_kelompok']) ?>" method="POST">
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
<script>
    function openInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }
</script>