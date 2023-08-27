<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menuz">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu" style="min-height: 400px;">
            <?php
            $session = \Config\Services::session();
            $lang = $session->get('lang');
            ?>
            <div class="dropdown d-inline-block mt-l" style="float:right;">
                <button type="button" class="btn header-item" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= base_url() ?>/assets/images/users/avatar-1.jpg" alt="Header Avatar">

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <div class="card">
                        <div class="card-body text-center">
                            <img class="rounded-circle header-profile-user" src="<?= base_url() ?>/assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <h4 class="card-title"><?= $session->get('username') ?></h4>
                        </div>
                    </div>
                    <a class="dropdown-item" href="<?= base_url() ?>/main/userprofile">


                        <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                        <?= lang('Files.Change_Password') ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" id="edit-bus">Edit Armada</a>
                    <a class="dropdown-item" href="<?= base_url() ?>/auth/action/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                        <?= lang('Files.Logout') ?>
                    </a>
                </div>
            </div>

            <!-- Left Menu Start -->
            <?php $module_active = uri_segment(0);
            $menu_active = uri_segment(1); ?>
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">
                    <?= lang('Files.Menu') ?>
                </li>
                <li class="<?= (($module_active == 'main') ? 'active' : '') ?>">
                    <a href="<?= base_url() ?>">
                        <span class="nav-icon "><i data-feather="home"></i></span>
                        <span class="nav-text">Dashboard </span>
                    </a>
                    <a href="<?= base_url() ?>/main/dashboard_angkutan">
                        <span class="nav-icon "><i data-feather="home"></i></span>
                        <span class="nav-text">Dashboard Control Center</span>
                    </a>
                </li>
                <?php
                $session = \Config\Services::session();

                function group_by($array, $by)
                {
                    $groups = array();

                    foreach ($array as $key => $value) {
                        $groups[$value->$by][] = $value;
                    }

                    return $groups;
                }

                $module = group_by($session->get('menu'), 'module_name');

                foreach ($module as $key => $_module) {

                    echo '<li>
                            <a href="javascript: void(0);" class="' . (count($_module) > 0 ? "has-arrow" : "") . '">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps">' . $key . '</span>
                            </a>';
                    echo count($_module) > 0 ? '<ul class="sub-menu" aria-expanded="false">' : '';
                    $grouped = group_by($_module, 'menu_parent');

                    foreach ($grouped as $_key => $_grouped) {
                        if ($_key == "") {
                            foreach ($_grouped as $__key => $menu) {
                                echo '<li class="' . (($menu_active == $menu->menu_url) ? "active" : "") . '">
                                        <a href="' . base_url() . '/' . $menu->module_url . '/' . $menu->menu_url . '">
                                            <span data-key="t-calendar">' . $menu->menu_name . '</span>' . $_key . '
                                        </a>
                                        </li>';
                            }
                        } else {
                            echo '<li class="' . ((count(array_filter($_grouped, function ($arr) use ($menu_active) {
                                return strtolower($arr->menu_url) == strtolower($menu_active);
                            })) > 0) ? 'active' : '') . '">
                                    <a href="javascript: void(0);" class="has-arrow">
                                    <span data-key="t-contacts">' . $_key . '</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">';

                            foreach ($_grouped as $__key => $menu) {
                                echo '<li class="' . (($menu_active == $menu->module_url) ? 'active' : '') . '">
                                                        <a href="' . base_url() . '/' . $menu->module_url . '/' . $menu->menu_url . '" class="">
                                                            <span class="nav-text">' . $menu->menu_name . '</span>
                                                        </a>
                                                    </li>';
                            }


                            echo '</ul>
                                        </li>';
                        }
                    }
                    echo count($_module) > 0 ? '</ul>' : '';
                }

                ?>
                <?php

                ?>
            </ul>


            <!-- <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-5">
                <div class="card-body">
                    <img src="<?= base_url() ?>/assets/images/fleet-mng.jpg" width="200" alt="" >
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">
                            <?= lang('Files.') ?>
                        </h5>
                        <p class="font-size-13">
                            <?= lang("Files.App_description") ?>
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->