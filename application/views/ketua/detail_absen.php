<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
        <a href="<?= base_url('ketua/invoice_absen/') . $kode_magang ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered dataabsen" width="100%" cellspacing="0">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Kegiatan</th>
                        <th>Surat Ijin</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absen as $absen) : ?>
                        <tr>
                            <td class="text-center <?php if ($absen['status'] == 1) {
                                                        echo 'table-success';
                                                    } else if ($absen['status'] == 2) {
                                                        echo 'table-warning';
                                                    } else {
                                                        echo 'table-danger';
                                                    } ?>">#</td>
                            <td class="text-center <?php if ($absen['status'] == 1) {
                                                        echo 'table-success';
                                                    } else if ($absen['status'] == 2) {
                                                        echo 'table-warning';
                                                    } else {
                                                        echo 'table-danger';
                                                    } ?>"><?= date('j F Y H:i:s', strtotime($absen['tgl_absen'])) ?></td>
                            <td class="<?php if ($absen['status'] == 1) {
                                            echo 'table-success';
                                        } else if ($absen['status'] == 2) {
                                            echo 'table-warning';
                                        } else {
                                            echo 'table-danger';
                                        } ?>"><?= $absen['kegiatan'] ?></td>
                            <td class="text-center <?php if ($absen['status'] == 1) {
                                                        echo 'table-success';
                                                    } else if ($absen['status'] == 2) {
                                                        echo 'table-warning';
                                                    } else {
                                                        echo 'table-danger';
                                                    } ?>"><b><?php if ($absen['surat_ijin'] == null) {
                                                                    echo '<a type="button" class="badge badge-secondary"><span class="text-light" style="font-size:15px;">No Data <i class ="fas fa-exclamation"></i></span></a>';
                                                                } else {
                                                                    echo '<a type="button" href="' . base_url('assets/data/peserta/surat_ijin/') . '' . $absen['surat_ijin'] . '" target="_blank" class="btn btn-success"><span style="font-size:15px;">Download File <i class ="text-light fas fa-solid fa-download"> </i></span></a>';
                                                                } ?> </b>
                            </td>
                            <td class="text-center <?php if ($absen['status'] == 1) {
                                                        echo 'table-success';
                                                    } else if ($absen['status'] == 2) {
                                                        echo 'table-warning';
                                                    } else {
                                                        echo 'table-danger';
                                                    } ?>"><b><?php if ($absen['status'] == 0) {
                                                                    echo '<span class="badge badge-danger"><span style="font-size:15px;">Belum Absen</span></span>';
                                                                } else if ($absen['status'] == 1) {
                                                                    echo '<span class="badge badge-success"><span style="font-size:15px;">Sudah Absen</span></span>';
                                                                } else {
                                                                    echo '<span class="badge badge-warning"><span style="font-size:15px;">Ijin Absen</span></span>';
                                                                } ?></b>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->