<?php if(!$model) $model = new Student();?>
<div class="col-md-12">
    <h1 class="page-header">Студент <?php echo $model->getName(); ?></h1>

    <form method="POST" action="">
        <div class="form-group">
          <label for="courseId">Курс</label>
          <select class="form-control" id="courseId" name="courseId" placeholder="Курс">
              <?php foreach($courses as $course) :?>
              <option value="<?php echo $course->getId(); ?>"><?php echo $course->getName(); ?></option>
              <?php endforeach;?>
          </select>
        </div>
        <div class="form-group">
          <label for="num">Факултетен №</label>
          <input type="text" class="form-control" id="num" name="num" placeholder="Факултетен №" value="<?php echo $model->getNum(); ?>">
        </div>
        <div class="form-group">
          <label for="name">Име</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Име" value="<?php echo $model->getName(); ?>">
        </div>
        <div class="form-group">
          <label for="specialty">Специалност</label>
          <input type="text" class="form-control" id="specialty" name="specialty" placeholder="Специалност" value="<?php echo $model->getSpecialty(); ?>">
        </div>
        <div class="form-group">
          <label for="group">Група</label>
          <input type="text" class="form-control" id="group" name="group" placeholder="Група" value="<?php echo $model->getGroup(); ?>">
        </div>
        <div class="form-group">
          <label for="points">Точки</label>
          <input type="text" class="form-control disabled" id="points" disabled="" name="points" placeholder="Точки" value="<?php echo $model->getPoints(); ?>">
        </div>
        <button type="submit" class="btn btn-default">Запази</button>
  </form>
</div>