<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">


            <!-- Left Menu Start -->
            <?php
            $session = \Config\Services::session();
            $module_active = uri_segment(0);
            $menu_active = uri_segment(1); ?>
            <ul class="metismenu list-unstyled" id="side-menu" style="min-height: 400px">
                <li class="menu-title" data-key="t-menu">
                    <?= lang('Files.Menu') ?>
                </li>
                <li class="<?= (($module_active == 'main') ? 'active' : '') ?>">
                    <a href="<?= base_url() ?>">
                        <i data-feather="home"></i>
                        <span class="nav-text">Dashboard </span>
                    </a>
                </li>
                <li class="<?= (($module_active == 'main') ? 'active' : '') ?>">
                    <?php if ($session->get('role_code') == 'bpw') { ?>
                        <a href="<?= base_url() ?>/main/dashboard_angkutan">
                            <!-- <span class="nav-icon "></span> -->
                            <i data-feather="map"></i>
                            <span class="nav-text">Dashboard Control Center</span>
                        </a>
                    <?php } else if ($session->get('role_code') == 'sad' || $session->get('role_code') == 'daj') { ?>
                        <a href="<?= base_url() ?>/main/dashboard_angkutan">
                            <i data-feather="map"></i>
                            <span class="nav-text">Dashboard Control Center</span>
                        </a>
                    <?php } ?>
                </li>
                <?php
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
                    if ($key == 'Administrator') {
                        echo '<li>
                        <a href="javascript: void(0);" class="' . (count($_module) > 0 ? "has-arrow" : "") . '">
                            <i data-feather="sliders"></i>
                            <span data-key="t-apps">' . $key . '</span>
                        </a>';
                    } else if (strtolower($key) == 'kspn' || strtolower($key) == 'perintis' || strtolower($key) == 'akap' || strtolower($key) == 'ajap' || strtolower($key) == 'angkutan barang') {
                        echo '<li>
                                <a href="javascript: void(0);" class="' . (count($_module) > 0 ? "has-arrow" : "") . '">
                                    <i data-feather="map-pin"></i>
                                    <span data-key="t-apps">' . strtoupper($key) . '</span>
                                </a>';
                    } else if (strtolower($key) == 'operasional') {
                        echo '<li>
                                <a href="javascript: void(0);" class="' . (count($_module) > 0 ? "has-arrow" : "") . '">
                                    <i data-feather="briefcase"></i>
                                    <span data-key="t-apps">' . $key . '</span>
                                </a>';
                    } else if (strtolower($key) == 'laporan') {
                        echo '<li>
                                <a href="javascript: void(0);" class="' . (count($_module) > 0 ? "has-arrow" : "") . '">
                                    <i data-feather="file-text"></i>
                                    <span data-key="t-apps">' . $key . '</span>
                                </a>';
                    } else {
                        echo '<li>
                            <a href="javascript: void(0);" class="' . (count($_module) > 0 ? "has-arrow" : "") . '">
                                <i data-feather="grid"></i>
                                <span data-key="t-apps">' . $key . '</span>
                            </a>';
                    }

                    echo count($_module) > 0 ? '<ul class="sub-menu" aria-expanded="false">' : '';
                    $grouped = group_by($_module, 'menu_parent');

                    foreach ($grouped as $_key => $_grouped) {
                        if ($_key == "") {
                            foreach ($_grouped as $__key => $menu) {
                                echo '<li class="' . (($menu_active == $menu->menu_url && $module_active == $menu->module_url) ? "active" : "") . '">
                                        <a href="' . base_url() . '/' . $menu->module_url . '/' . $menu->menu_url . '">
                                            <span data-key="t-calendar">' . $menu->menu_name . '</span>' . $_key . '
                                        </a>
                                    </li>';
                            }
                        } else {
                            echo '<li class="' . ((count(array_filter($_grouped, function ($arr) use ($menu_active) {
                                return  strtolower($arr->menu_url) == strtolower($menu_active);
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