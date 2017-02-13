<?php
$minid=$_GET['minid'];
if($minid!=0)
{
 $minid=$minid/100000;
}
?>
<select style="width:120px;" name="maximum_salary" id="maximum_salary" class="form-control"> 
                               <?php for($i=$minid;$i<=50;$i++){?>                                
                                <option value="<?php echo $i*100000?>"><?php echo $i?></option>
                                <?php }?>     
                            </select>


