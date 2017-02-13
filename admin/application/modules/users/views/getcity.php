<select class="form-control" name="city" id="city">
<option value="">-- Select City --</option>
<?php foreach($citys_result AS $city){?>
<option value="<?php echo $city['cityname']?>"><?php echo $city['cityname']?></option>
<?php }?>
</select>