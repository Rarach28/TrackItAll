<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">Add Activity</h1>

<?= form_open(base_url($action), [
    "class" => "",
    "method" => "post"
])?>
    <label for="name">Name<span style="color:red"> *</span></label>
        <?= form_input([
            "type" => "text",
            "placeholder" => "Activity Name",
            "class" => "form-control",
            "name" => "name",
            "id" => "name",
            "required" => true,
            "value" => $name
        ]) ?>

    <label for="name">Priority <span class="text-white-50">(1-1000)</span><span style="color:red"> *</span></label>
        <?= form_input([
            "type" => "number",
            "class" => "form-control",
            "name" => "priority",
            "id" => "priority",
            "value" => $priority,
            "min" => 1,
            "max" => 1000,
            "required" => true,
        ]) ?>
   
   <label for="name" class="mt-1">Color<span style="color:red"> *</span></label>
        <?= form_input([
            "type" => "color",
            "class" => "d-inline-block w-25",
            "name" => "color",
            "id" => "color",
            "value" => $color,
            "style" => "
                width: 2rem;
                height: 1rem;
                padding: 0;
            "

        ]) ?>

       <button type="submit" class="btn btn-primary d-block w-100"><?=$title?></button> 
</form>


<?= $records ?? ""?>


<?= $this->endSection() ?>