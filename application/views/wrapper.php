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
                    <li><a href="<?php echo base_url() ?>index.php/ranking">Ранкинг</a></li>
                    <li><a href="<?php echo base_url() ?>index.php/ranking/compare">Сравняване</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>

        <div class="container indent">
            <?php echo $content; ?>
        </div>
        
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/Chart.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
 
        <script type="text/javascript">
            (function(){
                $( ".datepicker" ).each(function(){
                    $(this).datepicker({ 
                         format: 'yyyy-mm-dd', 
                    });
                });
                
                //Creating the ranking chart
                if(document.getElementById("rankingChart"))
                {
                    var ctx = document.getElementById("rankingChart").getContext("2d");
                    var labels = [];
                    var dataset = [];

                    $('.chart-line').each(function(i, v){
                        if(i > 4)
                            return false;
                        labels[labels.length] = $(v).data('label'); 
                        dataset[dataset.length] = $(v).data('val'); 
                    });

                    var data = {
                        labels: labels,
                        datasets: [
                            {
                                label: "Топ 5",
                                fillColor: "rgba(165,246,168,0.5)",
                                strokeColor: "rgba(149,220,152,0.8)",
                                highlightFill: "rgba(134,226,137,0.75)",
                                highlightStroke: "rgba(110,185,112,1)",
                                data: dataset
                            }
                        ]
                    };

                    var chart = new Chart(ctx).Bar(data, {
                        responsive : true,
                    });
                }
                
                //Creating the compare chart
                if(document.getElementById("compareChart")) 
                {
                    var ctx = document.getElementById("compareChart").getContext("2d");
                    var labels = ["Максимални точки", "Минимални точки", "Средна стойност"];
                    var datasets = [];
                    var colors = {
                        fillColor : [165,246,168],
                        strokeColor: [149,220,152],
                        highlightFill: [134,226,137],
                        highlightStroke: [110,185,112],
                    }

                    $('.course-overalls').each(function(i, v){
                        if(i > 2)
                            return false;
                        datasets[datasets.length] = {
                            label: $(v).data('label'),
                            fillColor: "rgba(" + (colors.fillColor[0] + i*20) + ',' + (colors.fillColor[1] - i*20) + ',' + colors.fillColor[2] + ",0.5)",
                            strokeColor: "rgba(" + (colors.strokeColor[0] + i*20) + ',' + (colors.strokeColor[1] - i*20) + ',' + colors.strokeColor[2] + ",0.8)",
                            highlightFill: "rgba(" + (colors.highlightFill[0] + i*20) + ',' + (colors.highlightFill[1] - i*20) + ',' + colors.highlightFill[2] + ",0.75)",
                            highlightStroke: "rgba(" + (colors.highlightStroke[0] + i*20) + ',' + (colors.highlightStroke[1] - i*20) + ',' + colors.highlightStroke[2] + ",1)",
                            data: [$(v).data('max'),$(v).data('min'),$(v).data('avg')]
                        }; 
                    });
                    
                    var data = {
                        labels: labels,
                        datasets: datasets
                    };
                    
                    var chart = new Chart(ctx).Bar(data,{
                        responsive : true,
                    });
                }
            })();
            
        </script>
    </body>
</html>
