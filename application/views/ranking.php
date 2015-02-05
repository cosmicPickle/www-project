<div class="col-md-12">
    <h1 class="page-header">
        Ранкинг 
        <?php if($ranking) : ?>
        за курс: <?php echo $course->getName(); ?>
        <br>
        <small> <?php echo $this->time->getString($type); ?></small> 
        <?php endif; ?>
    </h1>
    <form>
        <table class="table table-striped">
            <tr>
                <td colspan="2">
                    <select name="course" class="form-control">
                        <option value="">Изберете курс ...</option>
                        <?php foreach($courseList as $c) : ?>
                        <option <?php if($this->input->get('course') == $c->getId()) echo 'selected'; ?> value="<?php echo $c->getId(); ?>"><?php echo $c->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td colspan="2">
                    <select name="type" class="form-control">
                        <option value="">Изберете период ...</option>
                        <option <?php if($this->input->get('type') == "hour") echo 'selected'; ?> value="hour"><?php echo $this->time->getString('hour'); ?></option>
                        <option <?php if($this->input->get('type') == "day") echo 'selected'; ?> value="day"><?php echo $this->time->getString('day'); ?></option>
                        <option <?php if($this->input->get('type') == "week") echo 'selected'; ?> value="week"><?php echo $this->time->getString('week'); ?></option>
                        <option <?php if($this->input->get('type') == "month") echo 'selected'; ?> value="month"><?php echo $this->time->getString('month'); ?></option>
                        <option <?php if($this->input->get('type') == "course") echo 'selected'; ?> value="course"><?php echo $this->time->getString('course'); ?></option>
                    </select>
                </td>
                <th><input type="submit" value="Покажи класация" class="btn btn-default" /> </th>
            </tr>
            <tr>
                <th>Факултетен №</th>
                <th>Име</th>
                <th>Специалност</th>
                <th>Група</th>
                <th>Точки</th>
            </tr>
            <?php if($ranking) :?>
                <?php foreach($ranking as $rank): ?>
                <tr class="chart-line" data-label="<?php echo $rank->getNum(). " " . $rank->getName(); ?>" data-val="<?php echo $rank->getPoints(); ?>">
                    <td><?php echo $rank->getNum(); ?></td>
                    <td><?php echo $rank->getName(); ?></td>
                    <td><?php echo $rank->getSpecialty(); ?></td>
                    <td><?php echo $rank->getGroup(); ?></td>
                    <td><?php echo $rank->getPoints(); ?></td>
                <tr>
                <?php endforeach;?>
            <?php endif;?>
        </table>      
    </form>
</div>

<div class="col-md-12">
    <h1 class="page-header">Топ 5</h1>
    <canvas id="rankingChart" height="400" width="800"></canvas>
</div>
