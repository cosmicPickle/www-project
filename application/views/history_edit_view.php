<?php if(!$model) $model = new History();?>
<div class="col-md-12">
    <h1 class="page-header"> История </h1>

    <form method="POST" action="">
        <div class="form-group">
          <label for="studentId">Студент</label>
          <select class="form-control" id="studentId" name="studentId" placeholder="Студент">
              <?php foreach($students as $student) :?>
              <option value="<?php echo $student->getId(); ?>">
                  <?php echo $student->getNum(). " " . $student->getName(); ?>
              </option>
              <?php endforeach;?>
          </select>
        </div>
        <div class="form-group">
          <label for="taskId">Задача</label>
          <select class="form-control" id="taskId" name="taskId" placeholder="Задача">
              <?php foreach($tasks as $task) :?>
              <option value="<?php echo $task->getId(); ?>">
                  <?php echo $task->getName(); ?>
              </option>
              <?php endforeach;?>
          </select>
        </div>
        <div class="form-group">
          <label for="date">Дата</label>
          <input type="text" class="form-control datepicker" id="date" name="date" placeholder="Дата" value="<?php echo $model->getDate(); ?>">
        </div>
        <button type="submit" class="btn btn-default">Запази</button>
  </form>
</div>