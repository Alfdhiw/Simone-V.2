<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;"><?= $title ?></h1>
    </div>
    <div class="row pb-3 pt-3">
        <div class="col-xl-12 col-md-12">
            <?php if ($this->session->flashdata('flash')) {
                echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
            } ?>

            <a href="#" class="btn btn-primary rounded" data-toggle="modal" data-target="#submenuModal"><i class="fas fa-solid fa-plus"></i> Tambah Role</a>
        </div>
        <!-- Modal SubMenu-->
        <div class="modal fade" id="submenuModal" tabindex="-1" aria-labelledby="submenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submenuModalLabel">Tambah User Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('dashboard/user_role') ?>" method="POST">
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Role name" id="role" name="role" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-6">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user"></i> List User Role</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datarole" id="dataUser" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($role as $r) : ?>
                                    <tr>
                                        <td class="text-center">#</th>
                                        <td><?= $r['role']; ?></td>
                                        <td class="text-center">
                                            <a type="button" class="btn btn-warning btn-sm" href="<?= base_url('dashboard/akses_role/' . $r['idrole']) ?>"><i class="fa-solid fa-bars"></i> Akses</a>&ensp;
                                            <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editsubModal<?= $r['idrole'] ?>"><i class="fa-solid fa-pen-to-square"></i> Kelola</a>&ensp;
                                            <!-- Modal Edit Sub Menu-->
                                            <div class="modal fade" id="editsubModal<?= $r['idrole'] ?>" tabindex="-1" aria-labelledby="editsubModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editsubModalLabel">Edit Sub Menu</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('dashboard/edit_role/' . $r['idrole']) ?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Role name" id="role" name="role" value="<?= $r['role'] ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <a type="button" id="btn-hapus" class="btn btn-danger btn-sm" href="<?= base_url('dashboard/delete_role/' . $r['idrole']) ?>"><i class="fa-solid fa-trash"></i> Hapus</a>
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
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function() {
        $('.datarole').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
</script>