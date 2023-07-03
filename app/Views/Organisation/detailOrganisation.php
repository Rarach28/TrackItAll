<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2"><?= $title ?? ""?></h1>
<div id="oWrap" class='row'>
    <div class="col-12 bg-danger">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a onclick="changeShowType(this)" class="nav-link changeShowType changeShowType-allTrack active" aria-current="page" data-bs-toggle="collapse" href="#allTrack" role="button" aria-expanded="false" aria-controls="allTrack">All Tracks<i class="ms-2 fa fa-br fa-suitcase"></i></a>
            </li>
            <li class="nav-item">
                <a  onclick="changeShowType(this)" class="nav-link changeShowType changeShowType-settings" aria-current="page" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings">Settings <i class="ms-2 fa fa-br fa-gear"></i></a>
            </li>
            <li class="nav-item">
                <a  onclick="changeShowType(this)" class="nav-link changeShowType changeShowType-link" aria-current="page" data-bs-toggle="collapse" href="#link" role="button" aria-expanded="false" aria-controls="link">Link</a>
            </li>
        </ul>
        
        <div class="collapse changeShowTypeContent changeShowTypeContent-allTrack" id="allTrack">
            <div class="card card-body bg-dark">
                Tady bude to vypadat jak Mess, vlevo jmena uzivatelu, vpravo jako chat budou scrollable zazname recordu i s ikonou a pak z trackControlleru history
            </div>
        </div>
        <div class="collapse changeShowTypeContent changeShowTypeContent-settings" id="settings">
            <div class="card card-body bg-dark">
                Nastaveni
                    - Jake moje aktivity jsou zobrazitelne
                    - Pozvat uzivatele
                    - Menit role
                    - V budoucnu statistiky

                    /jinak
                        - Notifikace Prehled notifikaci
                        - Na talcitko v navu refresh se objevi ty co jsem jeste nevidel
                        - Osetrit se nemuzu startnout tracker dokud nemam prirazenou aktivitu
                        
            </div>
        </div>
        <div class="collapse changeShowTypeContent changeShowTypeContent-link" id="link">
            <div class="card card-body bg-dark">
                Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
            </div>
        </div>
    </div>
</div>

<script>
    function changeShowType(btn){
        console.log($(btn).attr("aria-controls"));
        $(".changeShowType").removeClass("active");
        $(".changeShowTypeContent").addClass("d-none");
        $(btn).addClass("active")
        $(".changeShowTypeContent-"+$(btn).attr("aria-controls")).addClass("d-block");
        $(".changeShowTypeContent-"+$(btn).attr("aria-controls")).removeClass("d-none");

    }
</script>


<?= $this->endSection() ?>