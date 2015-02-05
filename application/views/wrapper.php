<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/js/bootstrap-datepicker/css/datepicker.css" />
    
        <meta charset="utf-8"/>
    </head>
    <body role="document">

        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Класация на студенти (Админ)</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url() ?>index.php/course/listing">Курсове</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/student/listing">Студенти</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/task/listing">Задачи</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        <div class="container indent">
            <?php echo $content; ?>
        </div>
        
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
            $( ".datepicker" ).each(function(){
                $(this).datepicker({ 
                     format: 'yyyy-mm-dd', 
                });
            });
        </script>
    </body>
</html>
