<div id="dashboard">
    <h2 class="ico_mug">Обзор категорий статей</h2>
    <div class="clearfix">
        <?php echo @$message; ?>
        <br/>
        <table id="table">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" class="noborder" />
                    </th>
                    <th>
                        Название
                    </th>
                    <th>
                        Действия
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($category as $row) {
                
                    echo '<tr>
                				<td class="table_check"><input type="checkbox" class="noborder" /></td>
                				<td class="table_title"><a href="'.base_url().'articles/category_edit/'.$row->ac_ids.'">'.stripslashes($row->ac_name).'</a></td>
                				<td>';
                    if ($row->ac_privilegue == 'temporary') 
					{
                        echo '<a id="delete" href="'.base_url().'articles/category_delete/'.$row->ac_ids.'"><img src="'.base_url().'img/cancel.jpg" alt="cancel"/></a>';
                    }
                    
                    echo '<a href="'.base_url().'articles/category_edit/'.$row->ac_ids.'"><img src="'.base_url().'img/edit.jpg" alt="edit"/></a></td>
                				';
                				
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <div id="table_options" class="clearfix">
            <form action="<?php echo base_url();?>articles/category_save" method="post">
                <ul>
                    <li>
                        <a href="#">Выбрать все</a>
                    </li>
                    <li>
                        <a href="#">Снять все</a>
                    </li>
                    <li>
                        Новая: <?php echo form_error('art_category'); ?> <input type="text" name="art_category"/><input type="submit" name="do" value="создать"/>
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div><!-- end #dashboard -->
