<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2"><?= $title ?? ""?></h1>

<?= form_open(base_url($action), [
    "class" => "",
    "method" => "post"
])?>
    <div class="form-floating mb-3">
        <?= form_input([
                "type" => "text",
                "placeholder" => "Organisation Name",
                "class" => "form-control",
                "name" => "name",
                "id" => "name",
                "required" => true,
                "value" => $name ?? "Name",
            ]) ?>
        <label class="text-muted" for="name">Organisation Name<span style="color:red"> *</span></label>
    </div>

    <div class="form-floating mb-3">
        <?= form_textarea([
                "type" => "text",
                "placeholder" => "Organisation description",
                "class" => "form-control",
                "name" => "text",
                "id" => "text",
                "required" => true,
                "value" => $name ?? "Text",
                "style" =>  "height: 150px",
            ]) ?>
        <label class="text-muted" for="text">Organisation description<span style="color:red"> *</span></label>
    </div>

    <div class="my-3">
        <label class="ms-2" for="text">Invite user by email<span style="color:red"> *</span></label>
        <?= view_cell('App\Cells\UserSelect::userMAilInput', []); ?>

    </div>

       <button type="submit" class="btn btn-primary d-block w-100"><?=$title?></button> 
</form>


<?= $this->endSection() ?>