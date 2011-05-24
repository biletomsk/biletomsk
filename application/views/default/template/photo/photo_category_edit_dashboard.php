<div id="dashboard">
    <h2 class="ico_mug">Редактирование категории</h2>
    <div class="clearfix">
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Основное</a>
                </li>
                
            </ul>
			<form action="<?php echo base_url();?>photoarchive/category_update/<?php echo $this->uri->segment(3);?>"  method="post" enctype="multipart/form-data" >
            <div id="tabs-1">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <label for="name">
                                Название категории: 
                            </label>
                        </td>
                        <td>
                        	<?php echo form_error('name'); ?>
                            <input type="text" name="name" value="<?php echo stripslashes(htmlspecialchars($data->name));?>" id="name"/>
                        </td>
                        <td>
                        </td>
                    </tr>
             
                <tr>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                      	&nbsp;
                    </td>
                    <td>
                        <input type="submit" value="Обновить" name="do"/>
                    </td>
                </tr>
            
                </table>
            </div>

		</form>
    </div>
</div>
</div>
<!-- end #dashboard -->
