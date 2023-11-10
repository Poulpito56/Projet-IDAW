<?php
$yesterday = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
$lestWeek = mktime(0, 0, 0, date("m"), date("d") - 7, date("Y"));
$lastMonth = mktime(0, 0, 0, date("m") - 1, date("d"),   date("Y"));
?>
<select class="text-input" id='date_selection'>
  <option value="<?php echo date('Y-m-d', $yesterday); ?>"><?php echo $tra->last_day; ?></option>
  <option value="<?php echo date('Y-m-d', $lestWeek); ?>"><?php echo $tra->last_week; ?></option>
  <option value="<?php echo date('Y-m-d', $lastMonth); ?>"><?php echo $tra->last_month; ?></option>
</select>