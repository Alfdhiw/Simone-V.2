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
                        <table class="table table-hover table-bordered absen_mhs" id="absen_mhs" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Divisi</th>
                                    <th>Absen Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($absenmhs as $abm) : ?>
                                    <tr>
                                        <!-- <td><?= $i; ?></td> -->
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $abm['foto']); ?>" class="img-thumbnail" width="80px" alt="Foto <?= $abm['nama'] ?>">
                                        </td>
                                        <td class="text-center"><a href="<?= base_url('penyelia/datamhs/' . $abm['kode_magang'])  ?>"><b><?= $abm['nama']; ?></b> <i class="fa-solid fa-eye"></i></a></td>
                                        <td class="text-center"><b><?= $abm['divisi']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($abm['tgl_absen'])) ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($abm['status'] == 4) {
                                                                    echo '<span class="btn text-light bg-danger" data-toggle="modal" data-target="#konfirmasiabmModal"><span style="font-size:15px;">Verifikasi</span></span>';
                                                                }
                                                                ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Modal Konfirmasi Mahasiswa -->
                        <div class="modal fade" id="konfirmasiabmModal" tabindex="-1" aria-labelledby="konfirmasiabmModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="konfirmasiabmModalLabel">Konfirmasi Absen Mahasiswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('penyelia/verifconfirm/' . $abm['absen_id']) ?>" method="POST">
                                        <div class="modal-body">
                                            Apakah mahasiswa telah hadir di tempat kerja? jika iya klik 'confirm'
                                            <input type='hidden' name="status" id="status" value="1" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                        <table class="table table-hover table-bordered absen_swa" id="absen_swa" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Siswa</th>
                                    <th>Divisi</th>
                                    <th>Absen Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($absenswa as $asw) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?= base_url('assets/data/peserta/pas_foto/' . $asw['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $asw['nama'] ?>">
                                        </td>
                                        <td class="text-center"><a href="<?= base_url('dashboard/datamhs/' . $asw['kode_magang'])  ?>"><b><?= $asw['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                        <td class="text-center"><b><?= $asw['divisi']; ?></b></td>
                                        <td class="text-center"><b><?= date('j F Y H:i:s', strtotime($asw['tgl_absen'])) ?></b></td>
                                        <td class="text-center"><?php
                                                                if ($asw['status'] == 4) {
                                                                    echo '<span class="btn text-light bg-danger" data-toggle="modal" data-target="#konfirmasiaswModal"><span style="font-size:15px;">Verifikasi</span></span>';
                                                                }
                                                                ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <!-- Modal Konfirmasi Siswa -->
                        <div class="modal fade" id="konfirmasiaswModal" tabindex="-1" aria-labelledby="konfirmasiaswModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="konfirmasiaswModalLabel">Konfirmasi Absen Siswa</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('penyelia/confirm/' . $asw['absen_id']) ?>" method="POST">
                                        <div class="modal-body">
                                            Apakah siswa telah hadir di tempat kerja? jika iya klik 'confirm'
                                            <input type='hidden' name="status" id="status" value="1" />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Confirm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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