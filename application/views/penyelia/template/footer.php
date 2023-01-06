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
        $('.datamahasiswa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'desc']
            ]
        });
    });
    $(document).ready(function() {
        $('.datasiswa').DataTable({
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
                [0, 'desc']
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
        $('.datanilai').DataTable({
            "pageLength": 10,
            order: [
                [1, 'asc']
            ]
        });
    });

    $(document).ready(function() {
        $('.absen_mhs').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });

    $(document).ready(function() {
        $('.absen_swa').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });

    $(document).ready(function() {
        $('.dataunverifabsen').DataTable({
            "pageLength": 10,
            order: [
                [0, 'asc']
            ]
        });
    });
</script>
</script>

<?php
$kode_magang = $this->session->userdata['userid'];
$kode_kategori = $this->session->userdata['kode_kategori'];

$sql1 = "select p.tingkat_pendidikan AS pendidikan,count(0) AS jumlah 
from peserta_magang p
where p.tingkat_pendidikan = 'mahasiswa' and p.kode_kategori = '$kode_kategori' and p.status='1' union 
select p.tingkat_pendidikan AS pendidikan,count(0) AS jumlah 
from peserta_magang p 
where p.tingkat_pendidikan = 'siswa' and p.kode_kategori = '$kode_kategori' and p.status='1'";
$result1 = mysqli_query($con, $sql1);
$chart_data = "";
while ($row1 = mysqli_fetch_array($result1)) {

    $rolepeserta[]  = $row1['pendidikan'];
    $jumlahpeserta[] = $row1['jumlah'];
}

?>

<?php
if (!$con) {
    echo "Problem in database connection! Contact administrator!";
} elseif ($this->uri->segment('3') == 'detailnilai') {
    $magang = $this->uri->segment('3');
    $sql = "SELECT 'Januari',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=1
                    UNION
                    SELECT 'Februari',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=2
                    UNION
                    SELECT 'Maret',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=3
                    UNION
                    SELECT 'April',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=4
                    UNION
                    SELECT 'Mei',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=5
                    UNION
                    SELECT 'Juni',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=6
                    UNION
                    SELECT 'Juli',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=7
                    UNION
                    SELECT 'Agustus',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=8
                    UNION
                    SELECT 'September',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=9
                    UNION
                    SELECT 'Oktoboer',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=10
                    UNION
                    SELECT 'November',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=11
                    UNION
                    SELECT 'Desember',avg(nilai_rata) as totaltrx from penilaian_detail where penilaian_detail.kode_magang='$magang' and month(penilaian_detail.tanggal_penilaian)=12;";
    $result = mysqli_query($con, $sql);
    $chart_data = "";
    while ($row = mysqli_fetch_array($result)) {
        $productname[]  = $row['Januari'];
        $sales[] = $row['totaltrx'];
    }
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
</body>

</html>