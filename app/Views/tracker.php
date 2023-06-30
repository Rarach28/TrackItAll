<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">Tracker</h1>

<div class="Tracker w-100 d-flex justify-content-between align-items-center p-2 rounded bg-secondary">
    <span class="d-inline-flex align-items-center ">
        <input id="trackerName" class="form-control text-light bg-body-emphasis" type="text" placeholder="What are you doing..." data-url=""></input>
        <span id="trackerActivity" data-id="<?= $activities[0]["id"] ?? 0?>" class="text-muted ms-2"><?= $activities[0]["name"] ?? ""?></span>
    </span>
    <span class="d-flex align-items-center"> 
        <span id="trackerTime" class="text-light" style="font-size: 1.45rem"><span id="hours">00</span>:<span id="minutes">00</span>:<span id="seconds">00</span></span>
        <span class="ms-2">
            <button style="width: 40px; background:<?= $activities[0]["color"] ?? bin2hex(random_bytes(3))?>;" id="playButton" class="btn btn-secondary d-block rounded-0 rounded-top"><i class='fa-solid fa-play'></i></button>
            <div class="dropdown">
                <button class="btn btn-secondary d-block dropdown-toggle p-0 py-1 rounded-0 rounded-bottom w-100" data-bs-toggle="dropdown" aria-expanded="false">
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <?php foreach($activities as $k=>$a){?>
                        <li><a data-id="<?= $a["id"]?>" class="dropdown-item activitySwitch" style="background:<?=$a["color"]?>" href="#"><?= $a["name"]?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </span>

    </span>
</div>

<span class="h4 d-block mt-5">Tracker History</span>
<div id="trackerHistory"></div>















<script>
    // $(document).ready(function() {
        

    //     $('#reset').click(function() {
            // clearInterval(stopwatchInterval);
            // hours = 0;
            // minutes = 0;
            // seconds = 0;
            // $('#hours').text('00');
            // $('#minutes').text('00');
            // $('#seconds').text('00');
    //     });
    // });


    $(document).ready(function(){
        loadHistory();
        var stopwatchInterval;
        var hours = 0;
        var minutes = 0;
        var seconds = 0;

        function updateTime() {
            seconds++;
            if (seconds === 60) {
            seconds = 0;
            minutes++;
            }
            if (minutes === 60) {
            minutes = 0;
            hours++;
            }
            $('#hours').text(('0' + hours).slice(-2));
            $('#minutes').text(('0' + minutes).slice(-2));
            $('#seconds').text(('0' + seconds).slice(-2));
        }

        $("#playButton").click(function(){
            if($(this).find("svg").attr("data-icon")=="pause"){ //pause
                $("#favicon").attr("href","<?=base_url("/favicon-pause.ico")?>");


                console.log($(this).find("svg").attr("data-icon","play"));
                clearInterval(stopwatchInterval);

                hours = 0;
                minutes = 0;
                seconds = 0;
                $('#hours').text('00');
                $('#minutes').text('00');
                $('#seconds').text('00');



                stopTracker();
            }else{  //play
                $("#favicon").attr("href","<?=base_url("/favicon-play.ico")?>");
                startTracker();
                console.log($(this).find("svg").attr("data-icon","pause"));
                stopwatchInterval = setInterval(updateTime, 1000);
                
            }
        });

        $(".activitySwitch").click(function(){
            var activity = $(this).text();
            var color = $(this).css("background");
            $("#trackerActivity").html(activity);
            $("#trackerActivity").attr("data-id",$(this).attr("data-id"))
            $("#playButton").css("background",color);
        });
    });

    function loadHistory(){
        $("#trackerHistory").html("<div class='text-center'><div class='spinner-border text-primary'></div></div>");
        $.ajax({
            type: 'POST',
            url: "<?=site_url("ajax");?>",
            data: {
                action: "loadTrackerHistory"
            },
            // async:false,
            success: function (response) {
                $("#trackerHistory").html(response);
            }
        });
    };

    function startTracker(){
        $.ajax({
            url: "<?=site_url("ajax");?>",
            type: 'POST',
            data: {
                action: "startTracker",
                params: {
                    "activity_id": $("#trackerActivity").attr("data-id"),
                    "name": $("#trackerName").val(),
                }
            },
            // async:false,
            success: function (url) {
                $("#trackerName").attr("data-url",url);
            }
        });
    };

    function stopTracker(){
        $.ajax({
            type: 'POST',
            url: "<?=site_url("ajax");?>",
            data: {
                action: "stopTracker",
                params: {
                    "url": $("#trackerName").attr("data-url"),
                    "name": $("#trackerName").val(),
                }
            },
            // async:false,
            success: function (response) {
                $("#trackerHistory").prepend(response);
                $(".emptyRecords").addClass("d-none");
            }
        });
    };


    function testToast(){
        $.ajax({
            type: 'POST',
            url: "<?=site_url("ajax");?>",
            data: {
                action: "testToast"
            },
            // async:false,
            success: function (response) {
               $("#toastWrpapper").append(response);
            }
        });
    };
</script>
<?= $this->endSection() ?>