<select class="form-control" name="news_location" id="news_location" style="max-width:200px;">
<?php
foreach($location_result AS $location){?>
<option value="<?php echo $location['location']?>"><?php echo $location['location']?></option>
<?php }?>
</select>