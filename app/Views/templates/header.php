<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="dark">

<head>

    <title>S.M.A.R.T. | <?=isset($title)?$title:""?></title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= base_url('public/assets/bootstrap-5.3.0/css/bootstrap.min.css');?>">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script> -->
        <script src="<?=base_url("public/assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js")?>"></script>
        <!-- <script src="<?=base_url("public/assets/bootstrap-5.3.0/js/bootstrap.js")?>"></script> -->
    <!-- fontAwsome-->
        <link rel="stylesheet" href="<?=base_url("public/assets/fontawesome-free-6.2.1-web/css/all.css")?>">
        <script src="<?=base_url("public/assets/fontawesome-free-6.2.1-web/js/all.js")?>"></script>
    <!-- jQuery -->
        <script src="<?=base_url("public/assets/jquery/jquery-3.6.0.min.js")?>"></script>
        <script src="<?=base_url("public/assets/jquery/jquery-ui.js")?>"></script>
    <!-- jscolor -->
        <!-- <script src="<?=base_url("public/assets/jscolor/jscolor.js")?>"></script>
        <link src="<?=base_url("public/assets/jscolor/scriptjs.php")?>"></link> -->
    <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url("public/assets/select2-4.1.0/css/select2.min.css")?>">
        <script src="<?=base_url("public/assets/select2-4.1.0/js/select2.min.js")?>"></script>
    <!-- CHARTS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <!-- ColorPicker -->
    <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5"></script>



    <!-- loader -->
    <!-- <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> 
<lottie-player src="https://assets7.lottiefiles.com/packages/lf20_Ned1WY044V.json"  background="transparent"  speed="1"  style="width: 100px; height: 100px;" hover loop controls autoplay></lottie-player>
-->

    <!-- <link rel="stylesheet" href="assets/css/custom.css"> -->
    <style>
        .text-hide {
            color: transparent;
            text-shadow: 0 0 0 #000;
        }
    </style>
    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }

        .fade-out {
        -webkit-animation-name: fadeout;
        animation-name: fadeout;
        -webkit-animation-duration: 3s;
        animation-duration: 3s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        }

        @-webkit-keyframes fadeout {
        from { opacity: 1; }
        to { opacity: 0; }
        }

        @keyframes fadeout {
        from { opacity: 1; }
        to { opacity: 0; }
        }
    </style>

    <script>
        $(document).ready(function() {
            // const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            // const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

//             const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
// const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        });

        // function progress(bar){

        //     bar = "#"+bar;
        //     var progress = 0; 
        //     var interval = setInterval(function() {
        //         progress += 3;
        //         $(bar).css('width', progress + '%');
        //         if (progress >= 100) {
        //             $(bar).parent().parent().parent().parent().fadeOut(1000);
        //             // clearInterval(interval);
        //         }
        //     }, 100);
        // }  

        function progress(bar){

            bar = "#"+bar;
            var progress = 0; 
            for(var i=0; i<35;i++){
                var interval = setTimeout(function() {
                    progress += 3;
                    $(bar).css('width', progress + '%');
                    if (progress >= 100) {
                        $(bar).parent().parent().parent().parent().fadeOut(1000);
                        // clearInterval(interval);
                    }
                }, 100);
            }
        }  

        function fromNow_ToHuman(val) {
            if (val == 0) {
                return "-";
            }
            val = Math.floor(Date.now() / 1000) - val;
            
            let years = Math.floor(val / 31536000);
            let days = Math.floor((val % 31536000) / 86400);
            let hours = Math.floor(((val % 31536000) % 86400) / 3600);
            let minutes = Math.floor((((val % 31536000) % 86400) % 3600) / 60);
            let seconds = Math.floor((((val % 31536000) % 86400) % 3600) % 60);


            if (years > 0) {
                return  years + "Y ";
            }
            if (days > 0) {
                return  days + "d ";
            }
            if (hours > 0) {
                return  hours + "h ";
            }
            if (minutes > 0) {
                return  minutes + "m ";
            }
            if (seconds > 0 && minutes == 0) {
                return  seconds + "s";
            }
        } 

        // function progress(bar) {
        //     bar = "#" + bar;
        //     var progress = 0;

        //     // Create a closure to store the current progress and interval
        //     function updateProgress() {
        //         progress += 3;
        //         $(bar).css('width', progress + '%');
        //         if (progress >= 100) {
        //             $(bar).parent().parent().parent().parent().fadeOut(1000);
        //             clearInterval(interval);
        //         }
        //     }

        //     // Create a new interval for each call to the progress function
        //     var interval = setInterval(updateProgress, 100);
        // }
    </script>
</head>

<body>
    <?php $uri = service('uri') ?>
    <?php $this->config = config('Auth');
    $redirect = $this->config->assignRedirect; ?>
    <div id="toastWrap" style="z-index:1000" class="bottom-0 end-0 mb-4 me-2 position-fixed">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Hello, world! This is a toast message.
            </div>
        </div>  
    </div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span>
                <a class="navbar-brand" href="#">S.M.A.R.T.</a>
                <?php if (session()->get('isLoggedIn')) : ?>
                    <ul class="d-inline-flex list-group list-group-horizontal navbar-nav mr-auto">
                            <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>" href="<?= site_url("/dashboard") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dashboard"><i class="fa-solid fa-chart-simple"></i></a>
                            </li>
                            <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'display' ? 'active' : null) ?>">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'display' ? 'active' : null) ?>" href="<?= site_url("/display") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Station settings"><i class="fa-solid fa-table-cells"></i></a>
                            </li>
                            <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'homeLight' ? 'active' : null) ?>">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'homeLight' ? 'active' : null) ?>" href="<?= site_url("/homeLight") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Home Light"><i class="fa-solid fa-house"></i></a>
                            </li>
                        </ul>
                </span>

                <span>
                    <ul class="list-group list-group-horizontal navbar-nav my-2 my-lg-0">
                        <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>" href="<?= site_url("/profile") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile"><i class="fa-solid fa-user"></i> </a>
                        </li>
                        <?php if ($this->config->lockScreen) : ?>
                            <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'lockscreen' ? 'active' : null) ?>">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'lockscreen' ? 'active' : null) ?>" href="<?= site_url("/lockscreen") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Lock"><i class="fa-solid fa-lock"></i> </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'logout' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'logout' ? 'active' : null) ?>"  href="<?= site_url("/logout") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout"><i class="fa-solid fa-power-off"></i> </a>
                        </li>
                    </ul>
                </span>
            <?php else : ?>
                
                <ul class="d-inline-flex list-group list-group-horizontal navbar-nav mr-auto">
                    <li class="nav-item mx-2 <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
                        <a class="nav-link" href="<?= site_url("/login") ?>">Login</a>
                    </li>
                    <li class="nav-item mx-2 <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
                        <a class="nav-link" href="<?= site_url("/register") ?>">Register </a>
                    </li>
                </ul>

            <?php endif; ?>

        </div>
    </nav>
    <!-- <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">S.M.A.R.T.</a>

            <?php if (session()->get('isLoggedIn')) : ?>

                <div class="" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>" href="<?= site_url("/dashboard") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Dashboard"><i class="fa-solid fa-chart-simple"></i></a>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'tableView' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'tableView' ? 'active' : null) ?>" href="<?= site_url("/tableView") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Table View"><i class="fa-solid fa-table"></i></a>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'display' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'display' ? 'active' : null) ?>" href="<?= site_url("/display") ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Display settings"><i class="fa-solid fa-table-cells"></i></a>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'configWidgets' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'configWidgets' ? 'active' : null) ?>" href="<?= site_url("/configWidgets") ?>">Config Widgets</a>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'profile' ? 'active' : null) ?>" href="<?php echo $redirect[session()->get('role')] ?>/profile" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile"><i class="fa-solid fa-user"></i> </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <?php if ($this->config->lockScreen) : ?>
                            <li class="nav-item <?= ($uri->getSegment(1) == 'lockscreen' ? 'active' : null) ?>">
                                <a class="nav-link <?= ($uri->getSegment(1) == 'lockscreen' ? 'active' : null) ?>" href="<?php echo $redirect[session()->get('role')] ?>/lockscreen" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Lock"><i class="fa-solid fa-lock"></i> </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'logout' ? 'active' : null) ?>">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'logout' ? 'active' : null) ?>"  href="<?php echo $redirect[session()->get('role')] ?>/logout" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout"><i class="fa-solid fa-power-off"></i> </a>
                        </li>
                    </ul>
                </div>

            <?php else : ?>
 
                <div class="" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?= ($uri->getSegment(1) == '' ? 'active' : null) ?>">
                            <a class="nav-link" href="<?= site_url("/login") ?>">Login</a>
                        </li>
                        <li class="nav-item <?= ($uri->getSegment(1) == 'register' ? 'active' : null) ?>">
                            <a class="nav-link" href="<?= site_url("/register") ?>">Register </a>
                        </li>
                    </ul>
                </div>

            <?php endif; ?>
        </div>
    </nav> -->
    <div id="bodySection" class="mx-4">