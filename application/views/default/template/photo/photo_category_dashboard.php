<div id="dashboard">
				<h2 class="ico_mug">Обзор категорий фотоотчетов</h2>
				<div class="clearfix">
					<?php echo @$message;?>
					<br/>
					<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Название</th>
				<th>Действия</th>
				
			</tr>
			</thead>
			<tbody>
			<?php 
			
			foreach ($category as $row)
			{
			
			echo '<tr>
				<td class="table_check"><input type="checkbox" class="noborder" /></td>
				<td class="table_title"><a href="'.base_url().'photoarchive/category_edit/'.$row->id.'">'.stripslashes($row->name).'</a></td>
				<td>';
				if($row->type == 'temporary')
				{
					echo '<a id="delete" href="'.base_url().'photoarchive/category_delete/'.$row->id.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>';
				}
				 
				echo '<a href="'.base_url().'photoarchive/category_edit/'.$row->id.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
				';
		
			echo '</tr>';
			}
			?>

			
			</tbody>
		</table>
			<div id="table_options" class="clearfix">
				<form action="<?php echo base_url();?>photoarchive/category_update" method="post">
				<ul>
					<li><a href="#">Выбрать все</a></li>
					<li><a href="#">Снять все</a></li>

				
				<li>Новая: <?php echo form_error('name'); ?> <input type="text" name="name"/> <input type="submit" name="do" value="создать"/>
				</li>
				</ul>
				
				</form>
			</div>

				</div>
			</div><!-- end #dashboard -->