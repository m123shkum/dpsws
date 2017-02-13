<?php //print_r($location_result);die;?>
<select class="form-control" name="location" id="location">
<option value="">-- Select Location --</option>
<?php
foreach($location_result AS $location){?>
<option value="<?php echo $location['location']?>"><?php echo $location['location']?></option>
<?php }?>
</select>