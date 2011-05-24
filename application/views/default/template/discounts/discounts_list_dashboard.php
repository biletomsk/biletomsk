<div id="dashboard">
				<h2 class="ico_mug">Обзор доступных скидок</h2>
				<div class="clearfix">
					<?php echo @$message;?>
					<br/>
					<table id="table" width="570">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Сроки проведения</th>
				<th>Название</th>
				<th>Категория</th>
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
				$pname = $this->discount_model->get_parent_category($row->dc_parent_id);
				
				$interval = ($row->dis_begin != 0 AND $row->dis_end !=0)? 'с '.ymd_decode($row->dis_begin).' по '.ymd_decode($row->dis_end): 'Бессрочно';
				echo '<tr>
					<td class="table_check"><input type="checkbox" class="noborder" /></td>
					<td class="table_date">'.$interval.'</td>
					<td class="table_title"><a href="'.base_url().'discounts/edit/'.$row->dis_id.'">'.stripslashes($row->dis_name).'</a></td>
					<td><a href="'.base_url().'discounts/show_category/'.$pname->dc_cat_id.'">'.$pname->dc_cat_name.'</a> / <a href="'.base_url().'discounts/show_category/'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</a></td>
					<td>
					<a id="delete" href="'.base_url().'discounts/delete/'.$row->dis_id.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>
					<a href="'.base_url().'discounts/edit/'.$row->dis_id.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
					';
				
				//Проверяем статус
				if($row->dis_status == 0)
				{
					echo'<td><span class="ico_pending">не отображается</span></td>';	
				}
				elseif($row->dis_status == 1)
				{
					echo'<td><span class="approved">отображается</span></td>';	
				}	
	
				
				echo '</tr>';
				}
			}
			else
			{
				echo '<tr><td colspan="6">'.alert_warning('Страницы').'</td></tr>';
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
			