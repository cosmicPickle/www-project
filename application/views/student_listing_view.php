<div class="col-md-12">
    <h1 class="page-header">
        Студенти
    </h1>
    <form method="get" action="">
        <table class="table table-striped">
            <tr>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('num')); ?>">
                        <span class="glyphicon <?php echo icon_order('num') ?>"></span>
                        Фн
                    </a>
                </th>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('name')); ?>">
                        <span class="glyphicon <?php echo icon_order('name') ?>"></span>
                        Име
                    </a>
                </th>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('specialty')); ?>">
                        <span class="glyphicon <?php echo icon_order('specialty') ?>"></span>
                        Специалност
                    </a>
                </th>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('points')); ?>">
                        <span class="glyphicon <?php echo icon_order('points') ?>"></span>
                        Точки
                    </a>
                </th>
                <th><a class="btn btn-primary" href="<?php echo base_url() ?>index.php/student/edit">Нов</a></th>
            </tr>
            <tr>
                <td><input type="text" placeholder="Търси в Фн..." name="filter[num]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Име..." name="filter[name]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Специалност..." name="filter[specialty]" class="form-control"></td>
                <td><input type="text" placeholder="Търси в Точки..." name="filter[points]" class="form-control"></td>
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
    <?php
        $rpp = $this->api->getRpp();
        $pageMin = 1;
        $curPage = $this->input->get('p') ? $this->input->get('p') : 1;
    ?>
    <div class="btn-group" role="group" aria-label="...">
        <a class="btn btn-default <?php if( $curPage == $pageMin ) echo ' disabled' ?>" 
           href="<?php echo gen_query_string(array('p' => $curPage - 1))?>">Предишна Страница</a>
        <a class="btn btn-default <?php if( count($collection) < $rpp ) echo ' disabled' ?>" 
           href="<?php echo gen_query_string(array('p' => $curPage + 1))?>">Следваща Страница</a>
    </div>
</div>
