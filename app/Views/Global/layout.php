<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* #trackerName::placeholder {
            color: #f8f9fa;
        } */

        .select2-selection__choice{
            background-color: #212529 !important;
        }
    </style>

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
        <!-- <script src="https://cdn.jsdelivr.net/npm/@jaames/iro@5"></script> -->

        <!-- my js -->
        <script src="<?=base_url("/assets/js/script.js")?>"></script>

        <!-- dateRange -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


        <link id="favicon" rel="icon" type="image/x-icon" href="<?= base_url("/favicon-pause.ico") ?>">
</head>
<body>
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
                    </li>
                    <li class="nav-item">
                        <a href="<?=site_url("Activity")?>" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-briefcase"></i> <span class="ms-1 d-none d-sm-inline">Activities</span> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=site_url("Organisation")?>" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-users"></i> <span class="ms-1 d-none d-sm-inline">Organizations</span> 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=site_url("Notification")?>" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-bell"></i> <span class="ms-1 d-none d-sm-inline">Notifications</span> 
                        </a>
                    </li>
                    <li>
                        <a href="#" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fa-solid fa-car"></i> <span class="ms-1 d-none d-sm-inline">Dash</span> </a>
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
                        <li><a class="dropdown-item" href="<?= site_url("Notification/refresh")?>"><i class="fa-solid fa-bell me-1"></i>Refresh Notifications</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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

<div id="toastWrpapper" style="
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-end;"><?= $toast ?? ""?></div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalTitle" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="myModalTitle">Modal title</h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="myModalBody" class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function toast(title, message, type, persistent=false){
    $.ajax({
        type: 'POST',
        url: "<?=site_url("ajax");?>",
        data: {
            action: "toast",
            params: {
                "title": title,
                "message": message,
                "type": type,
                "persistent": persistent
            }
        },
        success: function (response) {
            $("#toastWrpapper").append(response);
        }
    });
};

function tModal(type,data){
    $.ajax({
        type: 'POST',
        url: "<?=site_url("ajax");?>",
        data: {
            action: "modal",
            params: {
                "type": type,
                "data": data,
            }
        },
        // async:false,
        success: function (result) {
            response = JSON.parse(result);
            $("#myModalTitle").html(response["title"])
            $("#myModalBody").html(response["body"])
            $("#myModal").modal("show");
        }
    });
}

function updateTimeTrackData(btn){
    var timeFrom = $(btn).parent().find(".dateFrom").val();
    var timeTo = $(btn).parent().find(".dateTo").val();
    var url = $(btn).attr("data-url");

    $.ajax({
        type: 'POST',
        url: "<?=site_url("ajax");?>",
        data: {
            action: "updateTimeTrackData",
            params: {
                "timeFrom": timeFrom,
                "timeTo": timeTo,
                "url": url
            }
        },
        // async:false,
        success: function (result) {
            res = JSON.parse(result);
            $("#myModal").modal("hide");
            toast("Saved","Data Updated Successfully","success");

            $("#trackHistoryRecord_"+url).find("#trackerStart_"+url).html(res["startFormated"]);

            $("#trackHistoryRecord_"+url).find("#hours_"+url).html(res["hour"]);
            $("#trackHistoryRecord_"+url).find("#minutes_"+url).html(res["min"]);
            $("#trackHistoryRecord_"+url).find("#seconds_"+url).html(res["sec"]);
        }
    });
}

function deleteTrackerRecord(btn,url){
    $.ajax({
        type: 'POST',
        url: "<?=site_url("ajax");?>",
        data: {
            action: "deleteTrackerRecord",
            params: {
                "url": url
            }
        },
        // async:false,
        success: function (result) {
            $(btn).parent().parent().remove()
        }
    });
}
</script>


</body>
</html>