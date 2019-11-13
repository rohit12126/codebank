<?php  
$segment1      = $this->uri->segment(1);
$segment2      = $this->uri->segment(2);
$segment3      = $this->uri->segment(3);
$segment4      = $this->uri->segment(4);
?>
<html class="fixed">
    <head>
        <!-- Basic -->
        <meta charset="UTF-8">
        <title><?php if(isset($title)) { echo $title." | "; } ?><?= SITE_NAME; ?></title>
        <link rel="icon" href="<?= base_url("assets/favicon.png"); ?>" type="image/x-icon"/>
        <meta name="keywords" content="HTML5 Admin Template" />
        <meta name="description" content="Porto Admin - Responsive HTML5 Template">
        <meta name="author" content="okler.net">
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/animate/animate.css">
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/font-awesome-5/css/fontawesome.min.css" />
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/jquery-ui/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/jquery-ui/jquery-ui.theme.css" />
        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/theme.css" />
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/font-awesome/css/fontawesome-all.min.css" />
        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/global_css_settings.css">
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/style.css" />
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>css/custom.css">
        <script src="<?php echo BACKEND_THEME_URL;?>vendor/jquery/jquery.js"></script>

        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>vendor/datatables/media/css/dataTables.bootstrap4.css">
        <script src="<?php echo BACKEND_THEME_URL;?>js/examples/examples.datatables.editable.js"></script>
        <script src="<?php echo BACKEND_THEME_URL;?>vendor/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo BACKEND_THEME_URL;?>vendor/datatables/media/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo BACKEND_THEME_URL;?>js/notify.min.js"></script>
        <script type="text/javascript" src="<?= base_url("assets/backend/vendor/tinymce/tinymce.min.js"); ?>"></script>
        <script src="<?= base_url("assets/backend/plugin/sweetalert/dist/sweetalert.min.js"); ?>"></script>
        <!-- Select2 css and js -->
        <link rel="stylesheet" href="<?= base_url("assets/backend/vendor/select2/css/select2.css"); ?>" /> 
        <link rel="stylesheet" href="<?= base_url("assets/backend/vendor/select2-bootstrap-theme/select2-bootstrap.min.css"); ?>" />
        <script src="<?= base_url("assets/backend/vendor/select2/js/select2.js"); ?>"></script>
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo BACKEND_THEME_URL;?>plugin/select2/select2.css" />
        <!-- Select2 css and js -->
        <script src="<?= base_url("assets/backend/js/parsley.js"); ?>"></script>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script>
            SITE_URL = "<?= base_url(); ?>";
            PER_PAGE = <?= PER_PAGE; ?>;
        </script>
       <script src="<?php echo BACKEND_THEME_URL;?>js/custom.js"></script>
        <?php
        if(isset($css)) {
            foreach ($css as $c) {
                ?>
                <link rel="stylesheet" type="text/css" href="<?= base_url($c); ?>">
                <?php
            }
        }
        ?>
        <style type="text/css">
            .search-btn-col {
                display: flex;
                align-items: end;
                display: -webkit-flex;
                align-items: flex-end;
            }
        </style>

    </head>
    <div class="loader-wrap dn text-center"> 
        <div class="main-loader" >
            <div class="loader">
                <svg class="circular-loader" viewBox="25 25 50 50">
                    <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#016ccb" strokeWidth="2.5"></circle>
                </svg>
            </div>
        </div>
    </div>
    <body>
    <section class="body">
        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="<?php echo base_url('backend/dashboard'); ?>" class="logo"> <img src="<?= base_url("assets/frontend/img/chapter-logo-1.png"); ?>" width="140"  alt="Super Admin" /></a>
                <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened"><i class="fas fa-bars" aria-label="Toggle sidebar"></i></div>
            </div>
            <!-- start: search & user box -->
            <div class="header-right">

                <div id="userbox" class="userbox">
                    <a href="#" data-toggle="dropdown">
                        <?php $details = superadmin_details(); ?>
                        <figure class="profile-picture">
                            <img src="<?php echo base_url("assets/frontend/img/user-login-backend.svg"); ?>" alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?= ucfirst($details['user_name']); ?>" />
                        </figure>
                        <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                            <span class="name"><?= ucfirst($details['user_name']); ?></span>
                           <!--  <span class="role">administrator</span> -->
                        </div>
                        <i class="fas fa-caret-down"></i>
                    </a>
                    <div class="dropdown-menu">
                        <ul class="list-unstyled mb-2 mt-2">
                            <li>
                                <a role="menuitem" tabindex="-1" target="blank" href="<?= base_url(); ?>"><i class="fa fa-globe"></i> <?= $this->lang->line('dropdown_title_go_to_the_website')?></a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('backend/superadmin/profile')?>"><i class="fas fa-user"></i> <?= $this->lang->line('dropdown_title_my_profile')?></a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="<?php echo base_url('backend/superadmin/logout')?>"><i class="fas fa-power-off"></i> <?= $this->lang->line('dropdown_title_logout')?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- end: search & user box -->
        </header>
        <!-- end: header -->
        <div class="inner-wrapper">
            <!-- start: sidebar -->
            <aside id="sidebar-left" class="sidebar-left">
                <div class="nano">
                    <div class="nano-content">
                        <nav id="menu" class="nav-main" role="navigation">
                            <ul class="nav nav-main">
                                <li class="<?php if($segment2 == 'dashboard') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?= base_url('backend/dashboard');  ?>">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    <span><?= $this->lang->line('menu_title_dashboard')?></span>
                                    </a>                        
                                </li>
                                <li class="<?php if($segment2 == 'users') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?php echo base_url('backend/users')?>">
                                    <i class="fa fa-user"></i>
                                    <span><?= $this->lang->line('menu_title_user')?></span>
                                    </a>                        
                                </li>
                                <li class="<?php if($segment2 == 'template') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?= base_url('backend/template'); ?>">
                                        <i class="fas fa-envelope" aria-hidden="true"></i>
                                        <span><?= $this->lang->line('menu_title_email_template')?></span>
                                    </a>
                                </li>
                                <li class="nav-parent  <?php if($segment2 == 'faq' || $segment2 == 'pages') echo 'nav-expanded nav-active'; ?>">
                                    <a class="nav-link" href="#">
                                    <i class="fas fa-table" aria-hidden="true"></i>
                                    <span><?= $this->lang->line('menu_title_cms')?></span>
                                    </a>
                                    <ul class="nav nav-children" style="">
                                        <li class="<?php if($segment2 == 'pages') echo 'nav-active'; ?>">
                                            <a class="nav-link" href="<?= base_url('backend/pages');  ?>">
                                                <i class="fa fa-book" aria-hidden="true"></i>
                                                <span><?= $this->lang->line('menu_title_pages_content')?></span>
                                            </a>
                                        </li>
                                        <li class="<?php if($segment2 == 'faq') echo 'nav-active'; ?>">
                                            <a class="nav-link" href="<?= base_url('backend/faq');  ?>">
                                                <i class="fa fa-book" aria-hidden="true"></i>
                                                <span><?= $this->lang->line('menu_title_faq')?></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="<?php if($segment2 == 'contact') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?= base_url('backend/contact'); ?>"> 
                                        <i class="fas fa-comments" aria-hidden="true"></i>
                                        <span><?= $this->lang->line('menu_title_contact')?></span>
                                    </a>
                                </li>
                                <li class="<?php if($segment2 == 'support') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?= base_url('backend/support'); ?>"> 
                                        <i class="fas fa-ticket-alt"></i>
                                        <span><?= $this->lang->line('menu_title_support')?></span>
                                    </a>
                                </li>
                                <li class="<?php if($segment2 == 'settings') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?= base_url('backend/settings'); ?>"> 
                                        <i class="fas fa-cog" aria-hidden="true"></i>
                                        <span><?= $this->lang->line('menu_title_settings')?></span>
                                    </a>
                                </li>
                                <li class="<?php if($segment2 == 'theme_settings') echo 'nav-active'; ?>">
                                    <a class="nav-link" href="<?= base_url('backend/theme_settings'); ?>"> 
                                        <i class="fas fa-cogs" aria-hidden="true"></i>
                                        <span><?= $this->lang->line('menu_title_theme_settings')?></span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <hr class="separator" />
                    </div>
                    <script>
                        // Maintain Scroll Position
                        if (typeof localStorage !== 'undefined') {
                            if (localStorage.getItem('sidebar-left-position') !== null) {
                                var initialPosition = localStorage.getItem('sidebar-left-position'),
                                sidebarLeft = document.querySelector('#sidebar-left .nano-content');
                                sidebarLeft.scrollTop = initialPosition;
                            }
                        }
                    </script>
                </div>
            </aside>
        <section role="main" class="content-body card-margin">
        <?= msg_alert(); ?>