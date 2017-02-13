<select class="form-control" name="state_id" id="state_id">
<option value="0">-- Select State --</option>
<?php foreach($states_result AS $state){?>
<option value="<?php echo $state['zone_id']?>"><?php echo $state['name']?></option>
<?php }?>
</select>