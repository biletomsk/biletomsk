<div id="dashboard">
				<h2 class="ico_mug">Обзор фотоотчетов</h2>
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
				<th>Действия</th>
				<th>Статус</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			
			
			foreach ($data as $row)
			{
			
			echo '<tr>
				<td class="table_check"><input type="checkbox" class="noborder" /></td>
				<td class="table_date">'.$row->arch_d.' '.month($row->arch_m).' '.$row->arch_y.'</td>
				<td class="table_title"><a href="'.base_url().'photoarchive/edit/'.$row->arch_ids.'">'.stripslashes($row->arch_name).'</a></td>
				<td><a href="">'.$row->cat_name.'</a></td>
				<td>
				<a id="delete" href="'.base_url().'photoarchive/delete/'.$row->arch_ids.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a> 
				<a href="'.base_url().'photoarchive/delete/'.$row->arch_ids.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
				';
			
			//Проверяем статус
			if($row->arch_status == 0)
			{
				echo'<td><span class="ico_pending">не отображается</span></td>';	
			}
			elseif($row->arch_status == 1)
			{
				echo'<td><span class="approved">отображается</span></td>';	
			}	

			
			echo '</tr>';
			}
			?>

			
			</tbody>
		</table>
			<div id="table_options" class="clearfix">
				
				<ul>
					<li><a href="#">Выбрать все</a></li>
					<li><a href="#">Снять все</a></li>
					<li><label>	Категория:
								<select id="kategoria" name="kategoria">
								<?php foreach($category as $row)
								{
									echo '<option value="'.$row->id.'">'.$row->name.'</option> ';
								}
								?>

								</select>
				</label></li>
				
				</ul>
				
				
			</div>
			<?php
	echo $this->pagination->create_links();
	
	?>
				</div>
			</div><!-- end #dashboard -->