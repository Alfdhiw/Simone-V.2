<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 ml-3">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 35px;"><?= $title ?> Ketua</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-6">
            <div class="row mx-2">
                <div class="col-md-8 ml-10">
                    <div class="card card-primary ml-10">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Data Ketua</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr>
                                    <td>Nama</td>
                                    <td style="text-transform:capitalize;"><b><?php echo $detail['nama']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td><b><?php echo $detail['nip']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td><?php
                                        if ($detail['jeniskel'] == 'L') {
                                            echo '<b>Laki-Laki</b>';
                                        } else {
                                            echo '<b>Perempuan</b>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b><?php echo $detail['email']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td><b><?php echo $detail['password']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td><b><?php echo $detail['telp']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Status Kerja</td>
                                    <td><?php
                                        if ($detail['is_active'] == 1) {
                                            echo '<b><span class="badge badge-success" style="font-size:15px;"><b>Aktif</b></span>';
                                        } else {
                                            echo '<span class="badge badge-danger" style="background-color:danger;"><b>Mangkir</b></span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary mr-10" style="height: 50px;">
                        <div class="card-header" style="background-color: #005B5C;">
                            <h5 class="card-heading" style="font-weight: 600; color:white;">Foto Profil</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover table-striped table-hover">
                                <tr class="text-center">
                                    <td><img class="border-right rounded-lg shadow img-thumbnail" src="<?= base_url('assets/data/ketua/pas_foto/' . $detail['foto']); ?>" alt="foto_peserta" style="width:150px; height:200px;"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>