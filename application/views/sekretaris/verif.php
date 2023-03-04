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
                                    <th>Tanggal Daftar</th>
                                    <th>Kirim Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $p['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td class="text-center" style="text-transform:capitalize;"><a href="<?= base_url('sekretaris/datapelamar/' . $p['kode_magang'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center" style="text-transform:capitalize;"><b><?= $p['sekolah']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($p['tgl_daftar'])) ?></b></td>
                                        <td class="text-center"><span><a type="button" class="badge badge-warning" onclick="openInNewTab('mailto:<?= $p['email_kampus'] ?>')"><i class="fa-solid fa-envelope"></i> <span style="font-size:15px;">Email</span></a></span></td>
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
                                                        <form action="<?= base_url('sekretaris/terimapeserta/' . $p['kode_magang']) ?>" method="POST" id="form4">
                                                            <div class="modal-body text-left">
                                                                <div class="row g-2 mb-2">
                                                                    <div class="col-md-6">
                                                                        <label for="nama" class="form-label">Nama</label>
                                                                        <input type="text" class="form-control" id="nama" name="nama" style="text-transform:uppercase;" value="<?= $p['nama'] ?>" disabled>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="nim" class="form-label">NIM / NISN</label>
                                                                        <input type="text" class="form-control" id="nim" name="nim" style="text-transform:uppercase;" value="<?= $p['nim'] ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2 mb-2">
                                                                    <div class="col-md-6">
                                                                        <label for="sekolah" class="form-label">Asal Sekolah / Universitas</label>
                                                                        <input type="text" class="form-control" id="sekolah" name="sekolah" style="text-transform:uppercase;" value="<?= $p['sekolah'] ?>" disabled>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="jurusan" class="form-label">Jurusan</label>
                                                                        <input type="text" class="form-control" id="jurusan" name="jurusan" style="text-transform:uppercase;" value="<?= $p['jurusan'] ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-12">
                                                                        <label for="email_kampus" class="form-label">Email Kampus / Sekolah</label>
                                                                        <input type="email" class="form-control" id="email_kampus" name="email_kampus" value="<?= $p['email_kampus'] ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2 mb-2">
                                                                    <div class="col-12">
                                                                        <label for="jeniskel" class="form-label">Jenis Kelamin</label>
                                                                        <input type="text" class="form-control" id="jeniskel" name="jeniskel" value="<?php
                                                                                                                                                        if ($p['jeniskel'] == 'P') {
                                                                                                                                                            echo 'Perempuan';
                                                                                                                                                        } else {
                                                                                                                                                            echo 'Laki-Laki';
                                                                                                                                                        }
                                                                                                                                                        ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="row g-2 mb-2">
                                                                    <div class="col-12">
                                                                        <label for="kode_kategori" class="form-label">Divisi</label>
                                                                        <select class="form-control" id="kode_kategori" name="kode_kategori">
                                                                            <option value="">Pilih Divisi</option>
                                                                            <?php foreach ($divisi as $kj) : ?>
                                                                                <option value="<?= $kj['kode_kategori']; ?>"><?= $kj['divisi']; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="nama" value="<?= $p['nama'] ?>">
                                                                <input type="hidden" name="nim" value="<?= $p['nim'] ?>">
                                                                <input type="hidden" name="sekolah" value="<?= $p['sekolah'] ?>">
                                                                <input type="hidden" name="jurusan" value="<?= $p['jurusan'] ?>">
                                                                <input type="hidden" name="email_kampus" id="email_kampus" value="<?= $p['email_kampus'] ?>">
                                                                <input type="hidden" name="jeniskel" value="<?= $p['jeniskel'] ?>">
                                                                <input type="hidden" name="tgl_terima" value="<?= $date ?>">
                                                                <input type="hidden" name="telp" value="<?= $sekretaris['telepon'] ?>">
                                                                <input type='hidden' name="konfirmasi" id="konfirmasi" value="1" />
                                                                <hr>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                <button type="submit" class="btn btn-success">Submit</button>
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