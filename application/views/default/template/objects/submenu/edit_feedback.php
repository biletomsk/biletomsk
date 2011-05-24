


<div id="dashboard">
				<h2 class="ico_mug">Редактирование отзывов</h2>
		
					
					<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Дата</th>
				<th>Имя</th>
				<th>Отзыв</th>
				<th>Действия</th>
				<th>Статус</th>
			</tr>
			</thead>
			<tbody>

			<?php 
			if($feedback)
			{
				foreach($feedback as $row)
				{
					echo '
					<tr>
						<td class="table_check"><input type="checkbox" class="noborder" /></td>
						<td class="table_date">'.$row->feed_time.'</td>
						<td class="table_title">'.$row->feed_fio.'</td>
						<td class="table_title" id="'.$row->feed_ids.'">'.$row->feed_txt .'</td>
						<td>
						
						<a href="#" id=""><img src="'.base_url().'img/cancel.jpg" alt="cancel" title="'.$row->feed_ids.'"/></a>
						
						<a href="#" id=""><img src="'.base_url().'img/edit.jpg" alt="edit" title="'.$row->feed_ids.'"/></a></td>
						<td><span class="approved">отображается</span></td>
					</tr>';	
				}
			}
			else
			{
				echo '<tr>
				<td colspan="6"><div id="warning" class="info_div"><span class="ico_error">Отзывы отсутствуют</span></div></td>
				
				</tr>';
			
            
			}


			
			?>


			</tbody>
		</table>
			
			<input type="button" onClick="window.close();" class="button" value="Закрыть"/>
					
			</div><!-- end #dashboard -->
			
				 <div id="dialog" class="dialog" title="Редактировать отзыв">
				<div id="block">
					
					
					
				</div>
			</div><!-- end #dialog [if you don't want this, delete whole div and 6th line i custom.js -->
