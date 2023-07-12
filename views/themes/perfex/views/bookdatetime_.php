    <?php
        if($setTime)
        {
            $sn = 1;
            $setTimearr = explode(',', $setTime);
            foreach($setTimearr as $r)
            {
                ?>
                    <input type="radio" name="available_time" <?= ( in_array($r, $arr)?"disabled":""); ?> required id="one<?= $sn; ?>" value="<?= $r; ?>"><label class="label four col sellfield hover active text-danger" for="one<?= $sn; ?>"><?= $r; ?></label>
                <?php
                $sn++;
            }
        }
        else
        {
            ?>
                <input type="radio" name="available_time" <?= ( in_array("09:10am", $arr)?"disabled":""); ?> required id="one" value="09:10am"><label class="one-label four col sellfield hover active" for="one">09:10am</label>
                <input type="radio" name="available_time" <?= ( in_array("10:00am", $arr)?"disabled":""); ?> required id="two" value="10:10am"><label class="two-label four col sellfield hover active" for="two">10:00am</label>
                <input type="radio" name="available_time" <?= ( in_array("11:30am", $arr)?"disabled":""); ?> required id="three" value="11:30am"><label class="three-label four col sellfield hover active" for="three">11:30am</label>
                <input type="radio" name="available_time" <?= ( in_array("12:10pm", $arr)?"disabled":""); ?> required id="four" value="12:10pm"><label class="four-label four col sellfield hover active" for="four">12:10pm</label>
                <input type="radio" name="available_time" <?= ( in_array("01:00pm", $arr)?"disabled":""); ?> required id="five" value="01:00pm"><label class="five-label four col sellfield hover active" for="five">01:00pm</label>
                <input type="radio" name="available_time" <?= ( in_array("02:30pm", $arr)?"disabled":""); ?> required id="six" value="02:30pm"><label class="six-label four col sellfield hover active" for="six">02:30pm</label>
                <input type="radio" name="available_time" <?= ( in_array("05:00pm", $arr)?"disabled":""); ?> required id="seven" value="05:00pm"><label class="seven-label four col sellfield hover active" for="seven">05:00pm</label>
                <input type="radio" name="available_time" <?= ( in_array("06:00pm", $arr)?"disabled":""); ?> required id="eight" value="06:00pm"><label class="eight-label four col sellfield hover active" for="eight">06:00pm</label>
                <input type="radio" name="available_time" <?= ( in_array("07:30pm", $arr)?"disabled":""); ?> required id="nine" value="07:30pm"><label class="nine-label four col sellfield hover active" for="nine">07:30pm</label>
            <?php
        }
    ?>

    
    