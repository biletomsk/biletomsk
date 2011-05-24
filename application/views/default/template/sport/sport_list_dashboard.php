<div id="dashboard">
				<h2 class="ico_mug">Спорт</h2>
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
				<th>Статус</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			
			foreach ($data as $row)
			{
			
			echo '<tr>
				<td class="table_check"><input type="checkbox" class="noborder" /></td>
				<td class="table_title"><a href="'.base_url().'sport/edit/'.$row->sp_ids.'">'.stripslashes($row->sp_name).'</a></td>
				<td>empty</td>
				<td><a id="delete" href="'.base_url().'sport/delete/'.$row->sp_ids.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a> <a href="'.base_url().'sport/edit/'.$row->sp_ids.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
				';
			
			echo'<td><span class="approved">отображается</span></td>';	
				

			
			echo '</tr>';
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
			<div class="pagination">
				<span class="pages">Страница 1 из 3&#8201;</span>
				<span class="current">1</span>
				<a href="#" title="2">2</a>
				<a href="#" title="3">3</a>
				<a href="#" >&raquo;</a>
			</div>
				</div>
			</div><!-- end #dashboard -->