<div id="dashboard">
				<h2 class="ico_mug">Обзор статей</h2>
				<div class="clearfix">
					<?php echo @$message;?>
					<br/>
					<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Дата</th>
				<th>Название</th>
				<th>Категория</th>
				<th>Просмотры</th>
				<th>Действия</th>				
				<th>Статус</th>
				
			</tr>
			</thead>
			<tbody>
			<?php 
			if($data)
			{
				foreach ($data as $row)
				{
				
					echo '<tr>
					<td class="table_check"><input type="checkbox" class="noborder" /></td>
					<td class="table_date">'.cp_format_date2($row->date,'1').' '.month(cp_format_date2($row->date,'2')).'</td>
					<td class="table_title"><a href="'.base_url().'articles/edit/'.$row->id.'">'.stripslashes($row->topic).'</a></td>
					<td><a title="Посмотреть статьи в рубрике '.$row->ac_name.'" href="'.base_url().'articles/show_category/'.$row->ac_type.'">'.$row->ac_name.'</a></td>
					<td>'.$row->views.'</td>
					<td>
					<a id="delete" href="'.base_url().'articles/delete/'.$row->id.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>
					<a href="'.base_url().'articles/edit/'.$row->id.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a>
					</td>';
					
					//Проверяем статус
					if($row->art_status == 1)
					{
						echo'<td><span class="ico_pending">не отображается</span></td>';	
					}
					elseif($row->art_status == 2)
					{
						echo'<td><span class="approved">отображается</span></td>';	
					}	
	
				
					echo '</tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6">'.alert_warning('Статей ').'</td></tr>';
			}
			?>

			
			</tbody>
		</table>
			<div id="table_options" class="clearfix">
				
				<ul>
					<li><a href="#">Выбрать все</a></li>
					<li><a href="#">Снять все</a></li>
					<li><label>	Категория:
								<select style="width:120px;" id="kategoria" name="kategoria">
								<?php foreach($category as $row)
								{
									echo '<option value="'.$row->ac_type.'">'.$row->ac_name.'</option> ';
								}
								?>
								</select>
				</label></li>
				<li>
					<form action="<?php echo base_url();?>articles/search/" method="post">
					<input type="text" name="search_node"/> <input type="submit" value="Искать"/>
					</form>
					
				</li>
				
								</ul>
				
				
			</div>
			<?php
	echo $pages;
	
	?>
				</div>
			</div><!-- end #dashboard -->