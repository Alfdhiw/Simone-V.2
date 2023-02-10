<!-- Footer -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih tombol "Logout" dibawah ini untuk keluar dari akun saat ini</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url(); ?>login/logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/admin/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/admin/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/admin/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/admin/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/admin/chart.js/Chart.bundle.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>js/admin/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>js/admin/datatables/js/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/admin/demo/datatables-demo.js"></script>
<script src="<?= base_url('assets/') ?>js/admin/sweetalert2.min.js"></script>


<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/admin/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/') ?>js/admin/demo/chart-pie-demo.js"></script>

<script>
    //DATA SWEET ALERT

    $(document).on('click', '#btn-hapus', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan terhapus selamanya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = link;
            }
        })
    })


    // assumes you're using jQuery
    $(document).ready(function() {
        $('#flash').hide();
        <?php if ($this->session->flashdata('success')) { ?>
            $('#flash').html('<?php echo $this->session->flashdata('success'); ?>').show();
        <?php } ?>
    });
</script>

<script>
    $('.akses_role').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('dashboard/changeaccess') ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('dashboard/akses_role/') ?>" + roleId;
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.datamhs').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataswa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datajadwal').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datapenyelia').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datapelamar').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataterima').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datatolak').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataproses').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataloker').DataTable({
            "pageLength": 5,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.databaru').DataTable({
            "pageLength": 5,
            order: [
                [date_create, 'desc']
            ]
        });
    });

    $(document).ready(function() {
        $('.data_absen1').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataabsen').DataTable({
            "pageLength": 10,
            order: [
                [1, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.dataunverif').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });

    $(document).ready(function() {
        $('.dataunproses').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });

    $(document).ready(function() {
        $('.datanilai').DataTable({
            "pageLength": 10,
            order: [
                [1, 'asc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datadivisi').DataTable({
            "pageLength": 10,
            order: [
                [1, 'asc']
            ]
        });
    });
    $(document).ready(function() {
        $('.databerkas').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datapelamarkel').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datakelompokx').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
</script>
<script>
    function myFunction() {
        document.getElementById("tes1").submit();
    }
</script>
</script>

<?php
$kode_magang = $this->session->userdata['userid'];
$sql1 = "select p.tingkat_pendidikan AS pendidikan,count(0) AS jumlah 
from peserta_magang p
where p.tingkat_pendidikan = 'mahasiswa' union 
select p.tingkat_pendidikan AS pendidikan,count(0) AS jumlah 
from peserta_magang p 
where p.tingkat_pendidikan = 'siswa';";
$result1 = mysqli_query($con, $sql1);
$chart_data = "";
while ($row1 = mysqli_fetch_array($result1)) {

    $rolepeserta[]  = $row1['pendidikan'];
    $jumlahpeserta[] = $row1['jumlah'];
}
$sql2 = "select penyelia.jeniskel AS jeniskel,count(0) AS jumlah 
from penyelia
where penyelia.jeniskel = 'P' union 
select penyelia.jeniskel AS jeniskel,count(0) AS jumlah 
from penyelia 
where penyelia.jeniskel = 'L';";
$result2 = mysqli_query($con, $sql2);
$chart_data2 = "";
while ($row2 = mysqli_fetch_array($result2)) {

    $rolepenyelia[]  = $row2['jeniskel'];
    $jumlahpenyelia[] = $row2['jumlah'];
}


?>
<script>
    var rolepeserta = <?= json_encode($rolepeserta); ?>

    // [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
    var jumlahpeserta = <?= json_encode($jumlahpeserta); ?>
    // [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
    var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145",
        "#ff0097"
    ];

    new Chart("pesertaChart", {
        type: "pie",
        data: {
            labels: rolepeserta,
            datasets: [{
                backgroundColor: barColors,
                data: jumlahpeserta
            }]
        },
        options: {
            title: {
                display: false,
                text: "Jumlah Peserta Berdasarkan Tingkat Pendidikan"
            },
            legend: {
                display: true,
                position: "bottom"
            }
        }
    });
</script>

<script>
    var rolepenyelia = <?= json_encode($rolepenyelia); ?>

    // [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
    var jumlahpenyelia = <?= json_encode($jumlahpenyelia); ?>
    // [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];
    var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145",
        "#ff0097"
    ];

    new Chart("penyeliaChart", {
        type: "pie",
        data: {
            labels: rolepenyelia,
            datasets: [{
                backgroundColor: barColors,
                data: jumlahpenyelia
            }]
        },
        options: {
            title: {
                display: false,
                text: "Jumlah Penyelia Berdasarkan Gender"
            },
            legend: {
                display: true,
                position: "bottom"
            }
        }
    });
</script>



</body>

</html>