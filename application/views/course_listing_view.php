<div class="col-md-12">
    <h1 class="page-header">
        Курсове
    </h1>
    <form method="get" action="">
        <table class="table table-striped">
            <tr>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('name')); ?>">
                        <span class="glyphicon <?php echo icon_order('name') ?>"></span>
                        Име
                    </a>
                </th>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('start_date')); ?>">
                        <span class="glyphicon <?php echo icon_order('start_date') ?>"></span>
                        Начална Дата
                    </a>
                </th>
                <th>
                    <a href="<?php echo gen_query_string(gen_ord_array('end_date')); ?>">
                        <span class="glyphicon <?php echo icon_order('end_date') ?>"></span>
                        Крайна Дата
                    </a>
                </th>
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
