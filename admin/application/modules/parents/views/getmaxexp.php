<?php
$minid=$_GET['minid'];
?>
<select style="width:120px;" name="maximum-experience" id="maximum-experience" class="form-control">                            
                                     <?php for($i=$minid;$i<=50;$i++){?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php }?>
                            </select>


