<?php if(!$model) $model = new Student();?>
<div class="col-md-12">
    <h1 class="page-header">Курс <?php echo $model->getName(); ?></h1>
    
    <form method="POST" action="">
        <div class="form-group">
          <label for="name">Курс</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Име на курса" value="<?php echo $model->getName(); ?>">
        </div>
        <div class="form-group">
          <label for="startDate">Начална дата</label>
          <input type="text" class="form-control datepicker" id="startDate" name="startDate" placeholder="Начална дата" value="<?php echo $model->getStartDate(); ?>">
        </div>
        <div class="form-group">
          <label for="endDate">Крайна дата</label>
          <input type="text" class="form-control datepicker" id="endDate" name="endDate" placeholder="Крайна дата" value="<?php echo $model->getEndDate(); ?>">
        </div>
        <button type="submit" class="btn btn-default">Запази</button>
  </form>
</div>