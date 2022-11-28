<?php
function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('roleid', $role_id);
    $ci->db->where('menuid', $menu_id);
    $result = $ci->db->get('user_access_menu');

    // $result = $ci->db->get('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

if (!function_exists('get_month')) {
    function get_month($mo)
    {
        $months = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        return $months[$mo];
    }
}
