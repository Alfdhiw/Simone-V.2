<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?> <?= $nilai['divisi'] ?></h1>
       
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>
        </div>
        <div class="card shadow mb-4 col-xl-12 col-md-6 mb-6">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-desktop"></i> List Absen</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered data_absen1" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Foto</th>
                                <th scope="col" class="text-center">Nama</th>
                                <th scope="col" class="text-center">Status Magang</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail as $dt) : ?>
                                <tr>
                                    <td class="text-center"><img src="<?= base_url('assets/data/peserta/pas_foto/' . $dt['foto']); ?>" class="img-thumbnail" width="70px" alt="Foto <?= $dt['nama'] ?>"></td>
                                    <td><b><?= $dt['nama'] ?></b></td>
                                    <td class="text-center">
                                        <?php
                                        if ($dt['is_active'] == 0) {
                                            echo '<span class="badge text-light bg-danger"><span style="font-size:20px;">Mangkir</span></span>';
                                        } else {
                                            echo '<span class="badge text-light bg-success"><span style="font-size:20px;">Aktif</span></span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-info" href="<?= base_url('ketua/detail_nilai/') . $dt['kode_magang'] ?>">Detail <i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->