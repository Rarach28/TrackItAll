<?= $this->extend("Global/layout") ?>
<?= $this->section("content") ?>
<h1 class="text-4xl mb-2">Add Activity</h1>

<?= form_open(base_url("insertActivity"), [
    "class" => "",
    "method" => "post"
])?>
    <label for="name">Name<span style="color:red"> *</span></label>
        <?= form_input([
            'type' => 'text',
            'class' => 'form-control',
            'name' => 'name',
            'id' => 'name',
            "required" => true
        ]) ?>

    <label for="name">Priority<span style="color:red"> *</span></label>
        <?= form_input([
            'type' => 'number',
            'class' => 'form-control',
            'name' => 'priority',
            'id' => 'priority',
            "required" => true
        ]) ?>
   
   <label for="name">Color<span style="color:red"> *</span></label>
        <?= form_input([
            'type' => 'color',
            'class' => 'form-control',
            'name' => 'color',
            'id' => 'color'
        ]) ?>

       <button type="submit" class="btn btn-primary">Create</button> 
</form>



<?= $this->endSection() ?>