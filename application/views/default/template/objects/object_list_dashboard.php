<div id="dashboard">
	
				<h2 class="ico_mug">Обзор категории "<?php echo $list[0]->categ_nam;?>"</h2>
				<div class="clearfix">
					<?php echo @$message;?>
					<br/>
					<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Логотип</th>
				<th>Название</th>
				<th>Категория</th>
				<th>Действия</th>
				<th>Статус</th>
			</tr>
			</thead>
			<tbody>

			<?php 
			foreach($list as $row)
			{
				echo '
				<tr>
					<td class="table_check"><input type="checkbox" class="noborder" /></td>
					<td class="table_date">';
				
				if(file_exists(SDIR.'_object/logo/'.$row->obj_ids.'/'.$row->obj_img_mini))
				{
					echo '<img src="http://biletomsk.ru/_object/logo/'.$row->obj_ids.'/'.$row->obj_img_mini.'" alt="logo" />';
					
				}
				else
				{
					echo '<img src="'.base_url().'img/no_logo_80x30.png" alt="logo" />';
				
				}
				
				echo '</td>
					<td class="table_title"><a href="'.base_url().'object/edit/'.$row->obj_ids.'">'.stripslashes($row->obj_nam).'</a></td>
					<td><a href="'.base_url().'">'.$row->categ_nam.'</a></td>
					<td>
					
					<a href="#"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>
					
					<a href="#"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
					<td><span class="approved">отображается</span></td>
				</tr>';	
			}

			
			?>


			</tbody>
		</table>
			<div id="table_options" class="clearfix">
				
				<ul>
					<li><a href="#">Выбрать все</a></li>
					<li><a href="#">Снять все</a></li>
					
				

				</ul>
				
				
			</div>
		
				</div>
			</div><!-- end #dashboard -->