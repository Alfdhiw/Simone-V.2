<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Mahasiswa</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered data_mahasiswa" id="data_mahasiswa" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Status Magang</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $mhs['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $mhs['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['nama']; ?></b></td>
                                        <td class="text-center">
                                            <?php
                                            if ($mhs['is_active'] == 0) {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Mangkir</span></span>';
                                            } else {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-info" href="<?= base_url('penyelia/detailnilai/') . $swa['kode_magang'] ?>">Detail <i class="fas fa-search"></i></a>
                                            <?php
                                            if ($swa['sertifikat'] == !null) {
                                                echo '<a type="button" class="btn btn-warning disabled">
                                                Sertifikat <i class="fas fa-file"></i>
                                              </a>';
                                            } else {
                                                echo '<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#sertifModal' . $swa['kode_magang'] . '">
                                                Sertifikat <i class="fas fa-file"></i>
                                              </a>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- Modal Sertifikat -->
                                    <div class="modal fade" id="sertifModal<?= $mhs['kode_magang'] ?>" tabindex="-1" aria-labelledby="sertifModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="sertifModalLabel">Upload Sertifikat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('penyelia/upsertifmhs/') . $mhs['kode_magang'] ?>" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="sertifikat">Masukkan File Sertifikat</label>
                                                            <input type="file" class="form-control-file" id="sertifikat" name="sertifikat">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
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
</div>
<!-- End of Main Content -->

<div class="container-fluid mt-5">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Siswa</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered data_siswa" id="data_siswa" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Siswa</th>
                                    <th>Status Magang</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siswa as $swa) : ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $swa['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $swa['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['nama']; ?></b></td>
                                        <td class="text-center">
                                            <?php
                                            if ($swa['is_active'] == 0) {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Mangkir</span></span>';
                                            } else {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-info" href="<?= base_url('penyelia/detailnilai/') . $swa['kode_magang'] ?>">Detail <i class="fas fa-search"></i></a>
                                            <?php
                                            if ($swa['sertifikat'] == !null) {
                                                echo '<a type="button" class="btn btn-warning disabled">
                                                Sertifikat <i class="fas fa-file"></i>
                                              </a>';
                                            } else {
                                                echo '<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#sertifModal' . $swa['kode_magang'] . '">
                                                Sertifikat <i class="fas fa-file"></i>
                                              </a>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <!-- Modal Sertifikat -->
                                    <div class="modal fade" id="sertifModal<?= $swa['kode_magang'] ?>" tabindex="-1" aria-labelledby="sertifModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="sertifModalLabel">Upload Sertifikat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('penyelia/upsertifmhs/') . $swa['kode_magang'] ?>" method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="sertifikat">Masukkan File Sertifikat</label>
                                                            <input type="file" class="form-control-file" id="surat_sertifikat" name="surat_sertifikat">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="confirm" class="btn btn-primary">Confirm</button>
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
</div>
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