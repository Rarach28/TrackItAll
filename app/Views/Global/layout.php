<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>T.I.A | <?=isset($title)?$title:""?></title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= base_url('/assets/bootstrap-5.3.0/css/bootstrap.min.css');?>">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> -->
        <script src="<?=base_url("/assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js")?>"></script>
        <!-- <script src="<?=base_url("/assets/bootstrap-5.3.0/js/bootstrap.js")?>"></script> -->
    <!-- fontAwsome-->
        <link rel="stylesheet" href="<?=base_url("/assets/fontawesome-free-6.2.1-web/css/all.css")?>">
        <script src="<?=base_url("/assets/fontawesome-free-6.2.1-web/js/all.js")?>"></script>
    <!-- jQuery -->
        <script src="<?=base_url("/assets/jquery/jquery-3.6.0.min.js")?>"></script>
        <script src="<?=base_url("/assets/jquery/jquery-ui.js")?>"></script>
    <!-- jscolor -->
        <!-- <script src="<?=base_url("/assets/jscolor/jscolor.js")?>"></script>
        <link src="<?=base_url("/assets/jscolor/scriptjs.php")?>"></link> -->
    <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url("/assets/select2-4.1.0/css/select2.min.css")?>">
        <script src="<?=base_url("/assets/select2-4.1.0/js/select2.min.js")?>"></script>
    <!-- CHARTS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <!-- ColorPicker -->
    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5"></script>

    <!-- my js -->
    <script src="<?=base_url("/assets/js/script.js")?>"></script>


    <link rel="icon" type="image/x-icon" href="<?=base_url("/favicon.ico")?>">


<div class="container-fluid h-100">
    <div class="row flex-nowrap overflow-auto">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark border-end">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Track It All</span>
                </a>
                <?php if(session()->get('isLoggedIn')){?>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="<?=site_url("tracker")?>" class="nav-link align-middle px-0">
                            <i class="fa-solid fa-hourglass-half"></i> <span class="ms-1 d-none d-sm-inline">Tracker</span>
                        </a>
                        <a href="<?=site_url("Activity/show")?>" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-briefcase"></i> <span class="ms-1 d-none d-sm-inline">Activities</span> 
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fa fa-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dash</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fa fa-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span></a>
                    </li>
                    <li>
                        <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <i class="fa fa-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                        <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fa fa-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                            </li>
                            <li>
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fa fa-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?=getUserIcon()?>
                        <span class="d-none d-sm-inline mx-1"><?=userName()?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="<?= site_url("profile")?>"><i class="fa-solid fa-user me-1"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="<?= site_url("lockscreen")?>"><i class="fa-solid fa-lock me-1"></i>Lock</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= site_url("setup")?>"><i class="fa-solid fa-database me-1"></i>Setup</a></li>
                        <li><a class="dropdown-item" href="<?= site_url("logout")?>"><i class="fa-solid fa-power-off me-1"></i> Sign out</a></li>
                    </ul>
                </div>
                <?php }?>
            </div>
        </div>
        <div class="col py-3 text-light bg-dark overflow-auto">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>