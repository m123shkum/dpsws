<?php
$minid=$_GET['minid']+1;
?>
<select style="width:120px;display: inline;" name="max_age" id="max_age" class="form-control">                            
                                     <?php for($i=$minid;$i<=50;$i++){?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php }?>
                            </select>


