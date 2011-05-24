<div id="dashboard">
				<h2 class="ico_mug">Обзор консультантов</h2>
				<div class="clearfix">
					<?php echo @$message;?>
					<br/>
					<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				
				<th>Название</th>
				<th>Категория</th>
				<th>Действия</th>
				<th>Ответы/Новые</th>
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
					
					<td class="table_title"><a href="'.base_url().'consultation/edit/'.$row->id.'">'.stripslashes($row->organization).'</a></td>
					<td><a href="'.base_url().'consultation/show_category/'.$row->type_id.'">'.$row->type_name.'</a></td>
					<td>
					<a id="delete" href="'.base_url().'consultation/delete/'.$row->id.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>
					<a href="'.base_url().'consultation/edit/'.$row->id.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
					';
			
	
				
				echo '<td>0/3</td></tr>';
				}
			}
			else
			{
				echo alert_warning('Страницы');
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
			
			
			<?php
			
			echo $pages;
			?>
				</div>
			</div><!-- end #dashboard -->
			