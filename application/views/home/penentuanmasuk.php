<?php

if ($peserta['absen'] == 1) {
    require_once('absen_success.php');
} elseif ($peserta['absen'] == 0) {
    require_once('absen_masuk.php');
}
