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
            <a type="button" class="btn btn-primary rounded" data-toggle="modal" data-target="#magangModal"><i class="fas fa-solid fa-plus"></i> Tambah Magang</a>
        </div>
        <!-- The Modal -->
        <div class="modal fade" id="magangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('dashboard/tambahjob') ?>" method="post">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Lowongan Magang Baru</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                Kategori Magang<select name="kode_kategori" id="kode_kategori" class="custom-select">
                                    <option value="">Pilih Divisi</option>
                                    <?php foreach ($divisi as $divisi) : ?>
                                        <option value="<?= $divisi['kode_kategori']; ?>"><?= $divisi['divisi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                Deskripsi Magang: <textarea type="text" name="desc" placeholder="Deskripsi Magang" class="form-control" rows="3"></textarea><br>
                            </div>
                            <div class="form-group">
                                Start Date: <input type="date" name="start" class="form-control"><br>
                            </div>
                            <div class="form-group">
                                End Date: <input type="date" name="end" class="form-control"><br>
                            </div>
                            <div class="form-group">
                                End Registration: <input type="date" name="endregist" class="form-control"><br>
                            </div>
                            <div class="form-group">
                                Tipe Magang<select class="form-control" name="workingtype">
                                    <option selected values="WFH">WFH</option>
                                    <option value="WFO">WFO</option>
                                    <option value="Mix">MIX WFH-WFO / Rolling</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="status" value="1" id="status" checked>
                                    Kuota Tersedia
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="addjob">Submit</button>
                        </div>

                    </form>
                </div>
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
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-pencil-ruler"></i> List Lowongan Magang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataloker" width="100%" cellspacing="0">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>Posisi Tersedia</th>
                                <th>Periode</th>
                                <th>Maks Pendaftaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($loker as $loker) : ?>
                                <tr>
                                    <td class="text-center"><?= $loker['divisi']; ?></td>
                                    <td class="text-center"><?php echo date('j M Y', strtotime($loker['jobstart'])) ?> - <?php echo date('j M Y', strtotime($loker['jobend'])) ?></td>
                                    <td class="text-center"><?php echo date('j M Y', strtotime($loker['registerend'])) ?></td>
                                    <td class="text-center"><?php
                                                            if ($loker['status'] == 1) {
                                                                echo '<span class="badge text-light bg-success"><span style="font-size:15px;">Lowongan Tersedia</span></span>';
                                                            } else {
                                                                echo '<span class="badge text-light bg-secondary"><span style="font-size:15px;">Lowongan Penuh</span></span>';
                                                            }
                                                            ?></td>
                                    <td class="text-center">
                                        <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editlokerModal<?= $loker['jobid'] ?>"><i class="fa-solid fa-pen-to-square"></i> <span style="font-size:15px;">Kelola</span></a>&ensp;
                                        <!-- The Modal -->
                                        <div class="modal fade" id="editlokerModal<?= $loker['jobid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Lowongan Magang</h4>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body text-left">
                                                        <form action="<?= base_url('dashboard/editjob/' . $loker['jobid']) ?>" method="post">
                                                            <div class="form-group">
                                                                Kategori Magang: <select name="kode_kategori" id="kode_kategori" class="custom-select">
                                                                    <option value="<?= $loker['kode_kategori']; ?>">Pilih Divisi</option>
                                                                    <?php foreach ($kerja as $k) : ?>
                                                                        <option value="<?= $k['kode_kategori']; ?>"><?= $k['divisi']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                Deskripsi Magang: <textarea type="text" name="desc" placeholder="Deskripsi Magang" class="form-control" rows="3"><?= $loker['jobdesc'] ?></textarea><br>
                                                            </div>
                                                            <div class="form-group">
                                                                Start Date: <input type="date" name="start" class="form-control" value="<?= $loker['jobstart'] ?>"><br>
                                                            </div>
                                                            <div class="form-group">
                                                                End Date: <input type="date" name="end" class="form-control" value="<?= $loker['jobend'] ?>"><br>
                                                            </div>
                                                            <div class="form-group">
                                                                End Registration: <input type="date" name="endregist" class="form-control" value="<?= $loker['registerend'] ?>"><br>
                                                            </div>
                                                            <div class="form-group">
                                                                Tipe Magang<select class="form-control" name="workingtype">
                                                                    <option selected values="<?= $loker['workingtype'] ?>">WFH</option>
                                                                    <option value="WFO">WFO</option>
                                                                    <option value="Mix">MIX WFH-WFO / Rolling</option>
                                                                </select>
                                                            </div>
                                                            <div class=" input-group mt-3 mb-3">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($loker['status'] == "1") {
                                                                        echo '<input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked>';
                                                                    } else if ($loker['status'] == "") {
                                                                        echo '<input type="checkbox" class="form-check-input" id="status" name="status" value="1">';
                                                                    } else {
                                                                        echo '<input type="checkbox" class="form-check-input" id="status" name="status" value="1">';
                                                                    }
                                                                    ?>
                                                                    Kuota Tersedia
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="addjob">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a type="button" id="btn-hapus" href="<?= base_url('dashboard/deleteloker/' . $loker['jobid']) ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash" style="font-size:15px;"></i> <span style="font-size:15px;">Hapus</span></a>&ensp;
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
        $('.dataloker').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
</script>