<?php
$students_arr = array();
$tasks_arr = array();
$filter = $this->input->get('filter');
$studentId = NULL;

if(isset($filter['student_id']))
    $studentId = $filter['student_id'];
    
?>
<div class="col-md-12">
    <h1 class="page-header">
        История
    </h1>
    <form method="get" action="">
        <table class="table table-striped">
            <tr>
                <th>Студент</th>
                <th>Задача</th>
                <th>Дата</th>
                <th><a class="btn btn-primary" href="<?php echo base_url() ?>index.php/history/edit/0/<?php echo $studentId; ?>">Нов</a></th>
            </tr>
            <tr>
                <td>
                    <select name="filter[student_id]" class="form-control">
                        <option value="">Избери Студент</option>
                        <?php foreach($students as $student): ?>
                        <?php 
                            //Initializing sorted array for later use
                            $students_arr[$student->getId()] = $student; 
                        ?>
                        <option value="<?php echo $student->getId(); ?>"><?php echo $student->getNum()." ".$student->getName() ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select name="filter[task_id]" class="form-control">
                        <option value="">Избери Задача</option>
                        <?php foreach($tasks as $task): ?>
                        <?php 
                            //Initializing sorted array for later use
                            $tasks_arr[$task->getId()] = $task; 
                        ?>
                        <option value="<?php echo $task->getId(); ?>"><?php echo $task->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="text" placeholder="Търси в Дата..." name="filter[date]" class="form-control datepicker"></td>
                <td><input type="submit" value="Филтрирай" class="btn btn-default"></td>
            </tr>
            <?php foreach($collection as $history): ?>
            <tr>
                <td><?php echo $students_arr[$history->getStudentId()]->getNum(). " " 
                                . $students_arr[$history->getStudentId()]->getName(); ?>
                </td>
                <td><?php echo $tasks_arr[$history->getTaskId()]->getName(); ?></td>
                <td><?php echo $history->getDate();?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                          Действия
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/history/edit/<?php echo $history->getId() ?>/<?php echo $history->getStudentId()?>">
                                  Редакция
                              </a>
                          </li>
                          <li role="presentation">
                              <a role="menuitem" tabindex="-1" 
                                 href="<?php echo base_url() ?>index.php/history/delete/<?php echo $history->getId() ?>">
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
