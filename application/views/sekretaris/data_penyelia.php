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
            <!-- <a type="button" class="btn btn-primary rounded mb-4" data-toggle="modal" data-target="#penyeliaModal"><i class="fas fa-solid fa-plus"></i> Tambah Penyelia</a> -->
            <!-- Modal Penyelia-->
            <div class="modal fade" id="penyeliaModal" tabindex="-1" aria-labelledby="penyeliaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="penyeliaModalLabel">Tambah Penyelia Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('dashboard/data_penyelia') ?>" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="foto" value="default.png">
                                <div class="form-row md-2">
                                    <div class="col-6 form-group">
                                        <input type="text" class="form-control" placeholder="Nama Penyelia" id="nama" name="nama" required>
                                    </div>
                                    <div class="col-6 form-group">
                                        <input type="text" class="form-control" placeholder="NIP" id="nip" name="nip" required>
                                    </div>
                                </div>
                                <div class="form-row md-2">
                                    <div class="col-6 form-group">
                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                                    </div>
                                    <div class="col-6 form-group">
                                        <input type="password" class="input100 form-control" placeholder="Password" id="password" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <select class="form-control" id="jeniskel" name="jeniskel">
                                        <option>Pilih Jenis Kelamin</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</optionc>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nomor HP" id="telepon" name="telepon" required>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="kode_kategori" name="kode_kategori">
                                        <option value="">Pilih Divisi</option>
                                        <?php foreach ($kerja as $kj) : ?>
                                            <option value="<?= $kj['kode_kategori']; ?>"><?= $kj['divisi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                                        Active?
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="status" value="1">
                                <input type="hidden" name="role" value="4">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-tie"></i> List Penyelia</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datapenyelia" id="dataPenyelia" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>NIP</th>
                                    <th>Divisi</th>
                                    <th>Status Kerja</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penyelia as $p) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/penyelia/pas_foto/' . $p['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $p['nama'] ?>">
                                        </td>
                                        <td><a href="<?= base_url('sekretaris/detailpenyelia/' . $p['kode_penyelia'])  ?>"><b><?= $p['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td><b><?= $p['nip']; ?></b></td>
                                        <td><b><?= $p['divisi']; ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($p['is_active'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Mangkir</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
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