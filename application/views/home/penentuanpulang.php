<?php

if ($peserta['absen'] == 1) {
    require_once('absen_pulang.php');
} elseif ($peserta['absen'] == 0) {
    require_once('absen_salam.php');
}
