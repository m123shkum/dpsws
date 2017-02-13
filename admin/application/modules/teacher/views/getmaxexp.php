<?php
$minid=$_GET['minid'];
?>
<select name="expmonth" id="expmonth" class="form-control" style="width:100px;">                            
                                     <?php for($i=$minid;$i<=50;$i++){?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php }?>
                            </select>


