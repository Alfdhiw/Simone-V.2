<div style="min-height: 100vh;" class="bg-light pt-md-5 pb-5">

    <div class="col-lg-6 col-md-8 col-12 m-auto">
        <?php if ($this->session->flashdata('flash')) {
            echo '<p class="warning" style="margin: 10px 20px;">' . $this->session->flashdata('flash') . '</p>';
        } ?>
        <?php
        date_default_timezone_set("Asia/Bangkok");
        $time_now = date("G:i:s");

        if ($time_now  <=  $waktu['masuk']) {
            require_once('penentuanmasuk.php');
        } elseif ($time_now >= $waktu['masuk'] && $time_now <= $waktu['pulang']) {
            require_once('penentuantutup.php');
        } elseif ($time_now >= $waktu['pulang']) {
            require_once('penentuanpulang.php');
        }
        ?>
    </div>

</div>