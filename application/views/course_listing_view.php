<div class="col-md-12">
    <h1 class="page-header">
        Курсове
    </h1>
    <form method="get" action="">
        <table class="table table-striped">
            <tr>
                <th>Име</th>
                <th>Начална Дата</th>
                <th>Крайна Дата</th>
                <th><a class="btn btn-primary" href="<?php echo base_url() ?>index.php/course/edit">Нов</a></th>
            </tr>
            <tr>
                <td><input type="text" placeholder="Търси в име..." name="filter[name]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Начална Дата..." name="filter[start_date]" class="form-control datepicker"></td>
                <td><input type="text" placeholder="Търси в Крайна Дата..." name="filter[end_date]" class="form-control datepicker"></td>
                <td><input type="submit" value="Филтрирай" class="btn btn-default"></td>
            </tr>
            <?php foreach($collection as $course): ?>
            <tr>
                <td><?php echo $course->getName(); ?></td>
                <td><?php echo $course->getStartDate(); ?></td>
                <td><?php echo $course->getEndDate(); ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                          Действия
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/course/edit/<?php echo $course->getId() ?>">
                                  Редакция
                              </a>
                          </li>
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/course/delete/<?php echo $course->getId() ?>">
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
