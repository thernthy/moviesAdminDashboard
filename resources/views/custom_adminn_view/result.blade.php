@for ($j = 0; $j < count($arronepage); $j++)      
	<tr>
		<td>
		<input type="checkbox" name="checkbox[]"  value ="<?php echo $j; ?>" id=""><textarea name="<?php echo 'title'.$j; ?>" id="" cols="30" rows="2" readonly >{{$arronepage[$j][0]}}</textarea>
		</td>
		<td>
		<img src="{{$arronepage[$j][1]}}" width =100px>
		<input type="hidden" name="<?php echo 'img'.$j; ?>" value ="{{$arronepage[$j][1]}}">
		</td>
		<td><textarea name="<?php echo 'dec'.$j; ?>" id="" cols="30" rows="5">{{$arronepage[$j][2]}}</textarea>
		
		</td>
		<td>
		<?php
	$links = (json_decode($arronepage[$j][3], true));
	foreach($links as $key =>$value){
		echo "<a target='_blank' href=".$value."><button>".$key."</button><a>";
	}
	?>
		</td>
		<input type="hidden" name="<?php echo 'link'.$j; ?>" value= "{{$arronepage[$j][3]}}">
	</tr>
	@endfor  