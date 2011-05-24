<div id="dashboard">
				<h2 class="ico_mug">Соревнования</h2>
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
			if($competit)
			{
				foreach ($competit as $row) 
				{
	            
	                echo '<tr>
	            				<td class="table_check"><input type="checkbox" class="noborder" /></td>
	            				<td class="table_date">'.substr($row->sps_date,6,2).' '.month(substr($row->sps_date,4,2)).' '.substr($row->sps_date,0,4).'</td>
	            				<td class="table_title"><a href="'.base_url().'sport/edit_competition/'.$row->sps_ids.'">'.stripslashes($row->sps_name).'</a></td>
	            				<td><a href="'.base_url().'sport/show_competition_category/'.$row->sp_ids.'">'.$row->sp_name.'</a></td>
	            				<td>
	            				<a id="delete" href="'.base_url().'sport/delete_competition/'.$row->sps_ids.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>
	            				<a href="'.base_url().'sport/edit_competition/'.$row->sps_ids.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
	            				';
	            				
	                echo '<td><span class="approved">отображается</span></td>';
	            
	                
	                echo '</tr>';
	            }
			}
			else
			{
				echo '<tr><td colspan="6">'.alert_warning('Страницы ').'</td></tr>';
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