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
            <a type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#menuModal"><i class="fas fa-solid fa-plus"></i> Tambah Menu</a>
        </div>
        <!-- Modal Menu-->
        <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModalLabel">Tambah Menu Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('dashboard/menu_management') ?>" method="POST">
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nama Menu" id="menu" name="menu" required>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder"></i> List Menu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datamenu" id="dataUser" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Menu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($menu as $m) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $m['menu']; ?></td>
                                        <td class="text-center">
                                            <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editmenuModal<?= $m['menuid'] ?>"><i class="fa-solid fa-pen-to-square"></i> Kelola</a>&ensp;
                                            <!-- Modal Edit Menu-->
                                            <div class="modal fade" id="editmenuModal<?= $m['menuid'] ?>" tabindex="-1" aria-labelledby="editmenuModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editmenuModalLabel">Edit Menu Baru</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('dashboard/editMenu/' . $m['menuid'])  ?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Menu name" id="menu" name="menu" value="<?= $m['menu'] ?>">
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
                                            <a type="button" id="btn-hapus" class="btn btn-danger btn-sm" href="<?= base_url('dashboard/delete_menu/' . $m['menuid']) ?>"><i class="fa-solid fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
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
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="font-size: 40px;">Sub <?= $title; ?></h1>
    </div>
    <div class="row pb-3 pt-3">
        <div class="col-xl-12 col-md-12">
            <a type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#submenuModal"><i class="fas fa-solid fa-plus"></i> Tambah SubMenu</a>
        </div>
        <!-- Modal SubMenu-->
        <div class="modal fade" id="submenuModal" tabindex="-1" aria-labelledby="submenuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="submenuModalLabel">Tambah Sub Menu Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('dashboard/submenu') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Judul SubMenu" id="title" name="title">
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="menu_id" id="menu_id" class="custom-select">
                                        <option value="">Pilih Menu</option>
                                        <?php foreach ($menu as $m) : ?>
                                            <option value="<?= $m['menuid']; ?>"><?= $m['menu']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SubMenu url" id="url" name="url">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="SubMenu Icon" id="icon" name="icon">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                                    Active?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
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
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder"></i> List Sub Menu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datamenusub" id="dataUser" width="100%" cellspacing="0">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Menu</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $sm['title']; ?></td>
                                        <td><?= $sm['menu']; ?></td>
                                        <td><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <td><?php
                                            if ($sm['is_active'] == 1) {
                                                echo '<span class="badge text-light bg-success">Active</span>';
                                            } else {
                                                echo '<span class="badge text-light bg-secondary">Not Active</span>';
                                            }
                                            ?></td>
                                        <td class="text-center">
                                            <a href="#" class="badge text-light bg-success" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['submenuid']; ?>"><i class="fas fa-pen-to-square"></i> Kelola</a>
                                            <!-- Edit SubMenu Modal -->
                                            <div class="modal fade" id="editSubMenuModal<?= $sm['submenuid'] ?>" tabindex="-1" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content bg-light">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editSubMenuModalLabel">Edit SubMenu</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= base_url('dashboard/editsubmenu/') . $sm['submenuid']; ?>" method="POST">
                                                            <div class="modal-body">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="SubMenu Title" id="title" name="title" value="<?= $sm['title'] ?>">
                                                                </div>
                                                                <div class="input-group mt-3">
                                                                    <select name="menu_id" id="menu_id" class="custom-select">
                                                                        <option value="<?= $sm['menuid']; ?>">Pilih Menu</option>
                                                                        <?php foreach ($menu as $m) : ?>
                                                                            <option value="<?= $m['menuid']; ?>"><?= $m['menu']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="input-group mt-3">
                                                                    <input type="text" class="form-control" placeholder="SubMenu url" id="url" name="url" value="<?= $sm['url']; ?>">
                                                                </div>
                                                                <div class=" input-group mt-3">
                                                                    <input type="text" class="form-control" placeholder="SubMenu Icon" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                                                                </div>
                                                                <div class=" input-group mt-3 mb-3">
                                                                    <div class="form-check">
                                                                        <?php
                                                                        if ($sm['is_active'] == "1") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>';
                                                                        } else if ($sm['is_active'] == "") {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">';
                                                                        } else {
                                                                            echo '<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">';
                                                                        }
                                                                        ?>
                                                                        Active?
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <a id="btn-hapus" type="button" href="<?= base_url('dashboard/deletesubmenu/' . $sm['submenuid']) ?>" class="badge text-light bg-danger"><i class="fas fa-trash"></i> Hapus</a>

                                        </td>
                                    </tr>
                                    <?php $i++; ?>
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
        $('.datamenu').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datamenusub').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
</script>