<div class="col-md-12">
    <h1 class="page-header">
        Сравнение
    </h1>
    <form>
        <div class="form-group">
            <select name="courses[]" class="form-control" multiple="">
                <option value="">Изберете курсове за сравнение...</option>
                <?php foreach($courseList as $c) : ?>
                <option <?php if( $this->input->get('courses') && in_array($c->getId(), $this->input->get('courses'))) echo 'selected'; ?> value="<?php echo $c->getId(); ?>"><?php echo $c->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select name="type" class="form-control">
                <option value="">Изберете период ...</option>
                <option <?php if($this->input->get('type') == "hour") echo 'selected'; ?> value="hour"><?php echo $this->time->getString('hour'); ?></option>
                <option <?php if($this->input->get('type') == "day") echo 'selected'; ?> value="day"><?php echo $this->time->getString('day'); ?></option>
                <option <?php if($this->input->get('type') == "week") echo 'selected'; ?> value="week"><?php echo $this->time->getString('week'); ?></option>
                <option <?php if($this->input->get('type') == "month") echo 'selected'; ?> value="month"><?php echo $this->time->getString('month'); ?></option>
                <option <?php if($this->input->get('type') == "course") echo 'selected'; ?> value="course"><?php echo $this->time->getString('course'); ?></option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Покажи класация" class="btn btn-default" /> 
        </div>
    </form>
</div>
<div class="col-md-12">
    <?php
    if(isset($overalls)) :
        foreach($overalls as $c) :
    ?>
        <span type="hidden" 
               class="course-overalls" 
               data-label="<?php echo $c->getName(); ?>" 
               data-max="<?php echo $c->getMaxPoints(); ?>"
               data-min="<?php echo $c->getMinPoints(); ?>"
               data-avg="<?php echo $c->getAvgPoints(); ?>"></span>
    <?php 
        endforeach;
    endif;
    ?>
    <canvas id="compareChart" height="400" width="800"></canvas>
</div>
