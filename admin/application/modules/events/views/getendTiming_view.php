<?php
$open_time=array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 PM","13:00 PM","13:30 PM","14:00 PM","14:30 PM","15:00 PM","15:30 PM","16:00 PM","16:30 PM","17:00 PM","17:30 PM","18:00 PM","18:30 PM","19:00 PM","19:30 PM","20:00 PM");
$closed_time=array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 PM","13:00 PM","13:30 PM","14:00 PM","14:30 PM","15:00 PM","15:30 PM","16:00 PM","16:30 PM","17:00 PM","17:30 PM","18:00 PM","18:30 PM","19:00 PM","19:30 PM","20:00 PM");

$arr=explode("-",$_GET['starttime']);
$num=$arr[1]+1;
?>
<select style="width:120px;display: inline;" name="end_time" id="end_time" class="form-control">                            
                                     <?php for($j=$num;$j<count($closed_time);$j++){?>
             <option value="<?php echo $closed_time[$j]?>"><?php echo $closed_time[$j]?></option>
             
                                     <?php }?>
                            </select>


