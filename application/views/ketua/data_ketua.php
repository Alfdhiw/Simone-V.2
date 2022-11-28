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
            <div class="table-responsive">
                <table class="table table-hover table-bordered dataketua" id="dataketua" width="100%" cellspacing="0">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Foto</th>
                            <th>Nama </th>
                            <th>NIP</th>
                            <th>Status Kerja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ketua as $k) : ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?= base_url('assets/data/ketua/pas_foto/' . $k['foto']); ?>" class="img-thumbnail zoom" width="80px" alt="Foto <?= $k['nama'] ?>">
                                </td>
                                <td><a href="<?= base_url('ketua/detailketua/' . $k['kode_ketua'])  ?>"><b><?= $k['nama']; ?> <i class="fa-solid fa-eye"></i></b></a></td>
                                <td><b><?= $k['nip']; ?></b></td>
                                <td class="text-center"><?php
                                                        if ($k['is_active'] == 0) {
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
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->