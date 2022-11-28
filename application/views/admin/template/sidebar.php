<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-solid fa-user-gear"></i>
                </div>

                <div class="sidebar-brand-text mx-3">Dashboard <?= $session ?></div>
            </a>

            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `menu`.`menuid`, `menu`
                                  FROM `menu` JOIN `user_access_menu`
                                  ON `menu`.`menuid` = `user_access_menu`.`menuid`
                                  WHERE `user_access_menu`.`roleid` = $role_id AND menu.menuid != 7
                                  AND menu.menuid != 8 AND menu.menuid != 9
                                  ORDER BY `user_access_menu`.`menuid` ASC
                                  ";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>
            <?php foreach ($menu as $m) : ?>
                <hr class="sidebar-divider my-2">
                <div class="sidebar-heading">
                    <?= $m['menu']; ?>
                </div>
                <?php
                $menuId = $m['menuid'];
                $querySubMenu = "SELECT `submenu`.`submenuid`,`menu`.`menuid`,`submenu`.`title`,`submenu`.`url`,`submenu`.`icon`,`submenu`.`is_active` FROM `submenu` JOIN `menu` ON `submenu`.`menuid` = `menu`.`menuid` WHERE `submenu`.`menuid` = $menuId AND `submenu`.`is_active` = 1
                                     ";
                $querySubMenu = $this->db->query($querySubMenu)->result_array();
                ?>
                <?php foreach ($querySubMenu as $sm) : ?>
                    <?php if ($title == $sm['title']) : ?>
                        <li class="nav-item active">
                            <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                            <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                            <?php endif; ?>
                            <i class="<?= $sm['icon']; ?>"></i>
                            <span><?= $sm['title']; ?></span></a>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach ?>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">