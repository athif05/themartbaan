<?php
if($reccnt > $pagesize){
	
	$num_pages=$reccnt/$pagesize;

	$PHP_SELF=$_SERVER['PHP_SELF'];
	//$qry_str=$_SERVER['argv'][0];

	$m=$_GET;
	unset($m['start']);

	function qry_str($arr, $skip = '') {
		$s = "?";
		$i = 0;
		foreach($arr as $key => $value) {
			if ($key != $skip) {
				if(is_array($value)){
					foreach($value as $value2){
						if ($i == 0) {
							$s .= "$key%5B%5D=$value2";
						$i = 1;
						} else {
							$s .= "&$key%5B%5D=$value2";
						} 
					}		
				}else{
					if ($i == 0) {
						$s .= "$key=$value";
						$i = 1;
					} else {
						$s .= "&$key=$value";
					} 
				}
			} 
		} 
		return $s;
	} 

	$qry_str=qry_str($m);

	$j=$start/$pagesize-5;
	if($j<0) {
		$j=0;
	}
	$k=$j+10;
	if($k>$num_pages)	{
		$k=$num_pages;
	}
	$j=intval($j);
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" align="right" class="black16"> 
  <tr> 
    <td  align="left"><a href="<?php echo $PHP_SELF;?><?php echo $qry_str?>&start=0" class="txt black16" style="color:#83b53b; font-size: 24px;"> << </a>&nbsp; </td> 
    <td  align="center" height="20"> <a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start=<?php echo $start-$pagesize;?>"  class="txt grey14"> 
      <?php if($start!=0) { ?>   Previous <?php //&laquo; echo $pagesize;?> 
      </a>&nbsp; <?php } ?> </td> 
	  
    
    <td align="center" class="blueb" > <!-- &nbsp;&nbsp;&nbsp; -->
      <?php
			
			for($i=$j;$i<$k;$i++)
			{
				if($i==$j)echo "Page:";
			   if(($pagesize*($i))!=$start)
				  {
	  ?> 
      <a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start=<?php echo $pagesize*($i);?>" style="color:#333333; font-size:12px; border:1px solid #f2f2f2; ">
      	<span style="border:1px solid #83b53b; background-color: #83b53b; padding: 2px 4px 2px 4px;"><?php echo $i+1;?></span>
      </a> 
      <?php } else { ?> 
		<span style="border:1px solid #64b0f2; background-color: #64b0f2; padding: 2px 4px 2px 4px;"><?php echo $i+1;?></span>
      <?php } } ?> 
	</td> 
	 <td align="center" height="20"> <span > 
      <?php if($start+$pagesize < $reccnt){	?> 
		&nbsp;&nbsp; <a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start=<?php echo $start+$pagesize;?>" class="txt grey14">Next
      <?php //&raquo; echo $pagesize?>  </a>&nbsp; 
      <?php } ?> 
      </span>&nbsp;</td>
    <td  align="right" height="20"><?php $mod=$reccnt%$pagesize; if($mod==0){$mod=$pagesize;}?> 
		<a href="<?php echo $PHP_SELF;?><?php echo $qry_str;?>&start=<?php echo $reccnt-$mod;?>" class="txt black16" style="color:#83b53b; font-size: 24px;"> >> </a> 
	</td> 
  </tr> 
</table> 
<?php } ?> 
