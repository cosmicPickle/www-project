<?php if(!$model) $model = new Task();?>
<div class="col-md-12">
    <h1 class="page-header">Задача <?php echo $model->getName(); ?></h1>

    <form method="POST" action="">

        <div class="form-group">
          <label for="name">Име</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Име" value="<?php echo $model->getName(); ?>">
        </div>
        <div class="form-group">
          <label for="reward">Точки</label>
          <input type="text" class="form-control" id="reward" name="reward" placeholder="Точки" value="<?php echo $model->getReward(); ?>">
        </div>
        <button type="submit" class="btn btn-default">Запази</button>
  </form>
</div>