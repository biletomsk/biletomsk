<div id="dashboard">
<h2 class="ico_mug">Скидки на главной</h2>
<div class="clearfix">
<?php echo @$message;?>
					<br/>
<div id="tabs">
<ul>
	<li><a href="#tabs-1">Основное</a></li>

</ul>
<div id="tabs-1">
<table align="center" width="570" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<?php 
	
	if($dindex)
	{
		
		foreach($dindex as $item)
		{
			
			if($item->di_dis_id ==0 AND $item->dis_id==NULL AND ($item->di_dis_start < date("Ymd") AND $item->di_dis_end < date("Ymd") ))
			{
				echo '
				<td width="110"><img src="'.base_url().'img/ni.png"/>
				
				<a href="'.base_url().'discounts/edit_index/'.$item->di_id.'">добавить</a>
				</td>';
				
			}
			else
			{
				
				echo '
				<td width="110"><img src="'.base_site_url().'_files/discount/_logo/'.$item->dis_id.'/'.$item->dis_img.'" width="100" height="100"/>
				<br/>
				<a href="'.base_url().'discounts/edit/'.$item->dis_id.'" alt="редактировать скидку">'.stripslashes($item->obj_nam).'</a><br/>
				<div  style="background-color:#666; color:#FFF; padding:2px" >На главной с <br/>'.ymd_decode($item->di_dis_start).' <br/>по '.ymd_decode($item->di_dis_end).'</div>
				<br/>
				<a href="'.base_url().'discounts/edit_index/'.$item->di_id.'">изменить</a><br/>
				<a href="'.base_url().'discounts/reset_index/'.$item->di_id.'">сброс индекса</a>
				</td>';
			}
			
		}
		
	}
	
	
	
	?>
		
	</tr>

</table>

</div>
</div>
</div>
</div>
