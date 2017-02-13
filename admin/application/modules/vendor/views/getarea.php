<select class="form-control" name="area" id="area" onchange="locationshow(this.value);">
<option value="">-- Select Area --</option>
<?php foreach($area_result AS $area){?>
<option value="<?php echo $area['zone_id']?>"><?php echo $area['cityname']?></option>
<?php }?>
</select>