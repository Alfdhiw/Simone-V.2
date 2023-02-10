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
        </div>
        <div class="card shadow mb-4 col-xl-12 col-md-6 mb-6">
            <div class="card-body">
                <table class="table mt-5">
                    <tbody>
                        <?php foreach ($monitoring as $mt) : ?>
                            <tr>
                                <td><b>#</b></td>
                                <td><b><?= $mt['divisi'] ?></b></td>
                                <td>
                                    <a class="btn btn-info" href="<?= base_url('dashboard/detailmonitor/') . $mt['kode_kategori'] ?>">Detail <i class="fas fa-search"></i></a>
                                </td>
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