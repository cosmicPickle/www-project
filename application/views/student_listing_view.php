<div class="col-md-12">
    <h1 class="page-header">
        Студенти
    </h1>
    <form method="get" action="">
        <table class="table table-striped">
            <tr>
                <th>Фн</th>
                <th>Име</th>
                <th>Специалност</th>
                <th>Точки</th>
                <th><a class="btn btn-primary" href="<?php echo base_url() ?>index.php/student/edit">Нов</a></th>
            </tr>
            <tr>
                <td><input type="text" placeholder="Търси в Фн..." name="filter[num]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Име..." name="filter[name]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Специалност..." name="filter[points]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Точки..." name="filter[specialty]" class="form-control"></td>
                <td><input type="submit" value="Филтрирай" class="btn btn-default"></td>
            </tr>
            <?php foreach($collection as $student): ?>
            <tr>
                <td><?php echo $student->getNum(); ?></td>
                <td><?php echo $student->getName(); ?></td>
                <td><?php echo $student->getSpecialty(); ?></td>
                <td><?php echo $student->getPoints(); ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                          Действия
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/student/edit/<?php echo $student->getId() ?>">
                                  Редакция
                              </a>
                          </li>
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/history/listing/<?php echo $student->getId() ?>">
                                  История
                              </a>
                          </li>
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/student/delete/<?php echo $student->getId() ?>">
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
