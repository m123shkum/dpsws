<select class="form-control" name="event_location" id="event_location" style="max-width:200px;">
<?php
foreach($location_result AS $location){?>
<option value="<?php echo $location['location']?>"><?php echo $location['location']?></option>
<?php }?>
</select>