<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2"><?= $title?></h1>

<?= form_open(base_url($action), [
    "class" => "",
    "method" => "post"
])?>
    <div class="form-floating mb-3">
        <?= form_input([
                "type" => "text",
                "placeholder" => "Notification Name",
                "class" => "form-control",
                "name" => "name",
                "id" => "name",
                "required" => true,
                "value" => $name ?? "Name",
                "oninput"  => "changeTitle(this)"
            ]) ?>
        <label class="text-muted" for="name">Name<span style="color:red"> *</span></label>
    </div>

    <div class="form-floating mb-3">
        <?= form_textarea([
                "type" => "text",
                "placeholder" => "Notification Text",
                "class" => "form-control",
                "name" => "text",
                "id" => "text",
                "required" => true,
                "value" => $name ?? "Text",
                "style" =>  "height: 150px",
                "oninput"  => "changeText(this)"
            ]) ?>
        <label class="text-muted" for="text">Text<span style="color:red"> *</span></label>
    </div>

    <div class="form-floating">
        <select class="form-select" id="floatingSelect" aria-label="Select Notification theme" onchange="changeTheme(this)">
            <option selected value="success">Success</option>
            <option value="info">Info</option>
            <option value="warning">Warning</option>
            <option value="danger">Danger</option>
        </select>
        <label for="floatingSelect" class="text-muted">Select Notification theme</label>
    </div>


    <div id="previewNotification" class="d-flex justify-content-center my-3">
        <?= $notifPreview?>
    </div>

    <button type="submit" class="btn btn-primary d-block w-100"><?=$title?></button> 
</form>


<script>
    $(".btn-close.ms-auto").remove();
    function changeTitle(btn){
        $(".toast-header .toast-title").html($(btn).val())
    }

    function changeText(btn){
        $(".toast-body-text").html($(btn).val())
    }

    function changeTheme(btn){
        //remove class that beggins with bg-

        $(".toast-header").removeClass(function (index, className) {
            return (className.match(/\bbg-\S+/g) || []).join(' ');
        });
        $(".toast-body").removeClass(function (index, className) {
            return (className.match(/\bbg-\S+/g) || []).join(' ');
        });
        $(".progress-bar").removeClass(function (index, className) {
            return (className.match(/\bbg-\S+/g) || []).join(' ');
        });
        
        $(".toast-header").addClass("bg-"+$(btn).val());
        $(".toast-body").addClass("bg-"+$(btn).val()+"-subtle");
        $(".progress-bar").addClass("bg-"+$(btn).val());
    }
</script>

<?= $this->endSection() ?>