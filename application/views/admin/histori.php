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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-check"></i> List Peserta Yang Diterima</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered dataterima" id="dataterima" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>Sekolah</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($terima as $t) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $t['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $t['nama'] ?>">
                                        </td>
                                        <td><a href="<?= base_url('dashboard/datapelamar/' . $t['kode_magang'])  ?>"><b><?= $t['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center"><b><?= $t['sekolah']; ?></b></td>
                                        <td class="text-center"><b><?= $t['divisi']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($t['tgl_terima'])) ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($t['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Unverified</span></span>';
                                                                }
                                                                if ($t['status'] == 1) {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                } else {
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
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-xmark"></i> List Peserta Yang Ditolak</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datatolak" id="datatolak" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama </th>
                                    <th>Sekolah</th>
                                    <th>Divisi</th>
                                    <th>Tanggal Ditolak</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tolak as $tolak) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $tolak['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $tolak['nama'] ?>">
                                        </td>
                                        <td><a href="<?= base_url('dashboard/datapelamar/' . $tolak['kode_magang'])  ?>"><b><?= $tolak['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td><b><?= $tolak['sekolah']; ?></b></td>
                                        <td><b><?= $tolak['divisi']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($tolak['tgl_terima'])) ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($tolak['status'] == 0) {
                                                                    echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Unverified</span></span>';
                                                                }
                                                                if ($tolak['status'] == 1) {
                                                                    echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Diterima</span></span>';
                                                                } else {
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