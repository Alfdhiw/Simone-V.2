<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row-fluid mt-3">
        <div class="col-lg">
            <div class="col-xl-12 col-md-12">
                <?php if ($this->session->flashdata('flash')) {
                    echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
                } ?>
                <h5>Role : <?= $role['role'] ?></h5>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($menu as $m) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $m['menu']; ?></td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input akses_role" type="checkbox" <?= check_access($role['idrole'], $m['menuid']); ?> data-role="<?= $role['idrole']; ?>" data-menu="<?= $m['menuid']; ?>">
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- End Content Row -->
        </div>

        <!-- !delete -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->