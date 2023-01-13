<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Mahasiswa</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List Mahasiswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered data_mahasiswa" id="data_mahasiswa" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Divisi</th>
                                    <th>Konfirmasi</th>
                                    <th>Status Magang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $mhs['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $mhs['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('penyelia/datamhs/' . $mhs['kode_magang'])  ?>"><b><?= $mhs['nama']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['jurusan']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $mhs['divisi'] ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($mhs['konfirmasi'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Belum</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Sudah</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($mhs['is_active'] == 0) {
                                                echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Mangkir</span></span>';
                                            } else {
                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Aktif</span></span>';
                                            }
                                            ?>
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
</div>
<!-- End of Main Content -->

<div class="container-fluid mt-5">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> Siswa</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
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
                                    <th>Asal Sekolah</th>
                                    <th>Jurusan</th>
                                    <th>Divisi</th>
                                    <th>Status Verif</th>
                                    <th>Status Magang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($siswa as $swa) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $swa['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $swa['nama'] ?>">
                                        </td>
                                        <td style="text-transform:capitalize;"><a href="<?= base_url('dashboard/datamhs/' . $swa['kode_magang'])  ?>"><b><?= $swa['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['sekolah']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['jurusan']; ?></b></td>
                                        <td style="text-transform:capitalize;"><b><?= $swa['divisi']; ?></td>
                                        <td class="text-center"><?php
                                                                if ($swa['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-danger"><span style="font-size:15px;">Unverified</span></span>';
                                                                } else {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Verified</span></span>';
                                                                }
                                                                ?></td>
                                        <td class="text-center"><?php
                                                                if ($swa['is_active'] == 0) {
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