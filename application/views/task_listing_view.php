<div class="col-md-12">
    <h1 class="page-header">
        Задачи
    </h1>
    <form method="get" action="">
        <table class="table table-striped">
            <tr>
                <th>Име</th>
                <th>Точки</th>
                <th><a class="btn btn-primary" href="<?php echo base_url() ?>index.php/task/edit">Нов</a></th>
            </tr>
            <tr>
                <td><input type="text" placeholder="Търси в Име..." name="filter[name]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Точки..." name="filter[reward]" class="form-control"></td>
                <td><input type="submit" value="Филтрирай" class="btn btn-default"></td>
            </tr>
            <?php foreach($collection as $task): ?>
            <tr>
                <td><?php echo $task->getName(); ?></td>
                <td><?php echo $task->getReward(); ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                          Действия
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/task/edit/<?php echo $task->getId() ?>">
                                  Редакция
                              </a>
                          </li>
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/task/delete/<?php echo $task->getId() ?>">
                                  Изтриване
                              </a>
                          </li>
                        </ul>
                    </div>          
                </td>
            <tr>
            <?php endforeach;?>
        </table>      
    </form>
</div>
