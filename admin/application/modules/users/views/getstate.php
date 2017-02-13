<select class="form-control" name="state" id="state" onchange="cityshow(this.value);">
<option value="">-- Select State --</option>
<?php foreach($states_result AS $state){?>
<option value="<?php echo $state['zone_id']?>"><?php echo $state['name']?></option>
<?php }?>
</select>