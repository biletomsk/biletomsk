<div id="dashboard">
				<h2 class="ico_mug">Категории скидок</h2>
				<div class="clearfix">
					<?php echo @$message;?>
					<br/>
					<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Категория</th>
				<th colspan="4">Подкатегории</th>
				
				
			</tr>
			</thead>
			<tbody>
			<?php 
			
			foreach ($category as $row)
			{
			
			$subcateg = $this->discount_model->get_discount_category($row->dc_cat_id);
			
			echo '<tr>
				<td class="table_check"><input type="checkbox" class="noborder" /></td>
				<td class="table_title"><a href="'.base_url().'discounts/category_edit/'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</td>
				<td colspan="4">';
				
				if($subcateg)
				{
					foreach($subcateg as $srow)
					{
						echo '<a href="'.base_url().'discounts/category_edit/'.$srow->dc_cat_id.'">['.$srow->dc_cat_name.']</a> ';
					}	
				}
				else
				{
					echo alert_warning('Подкатегорий');
				}

				
				
				
			echo '</td>';
	

			
			echo '</tr>';
			}
			?>

			
			</tbody>
		</table>
			<div id="table_options" class="clearfix">
				
				<ul>
					<li><a href="#">Выбрать все</a></li>
					<li><a href="#">Снять все</a></li>
				
				
				<li><label>	Дата:<select id="kategoria" name="kategoria">
									<option value="1">Сегодня</option> 
									<option value="2">Вчера</option> 
									<option value="3">За прошлую неделю</option> 
									<option value="4">За прошлый месяц</option> 
								</select>
				</label></li>
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