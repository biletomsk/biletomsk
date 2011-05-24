<div id="dashboard">
<h2 class="ico_mug">Редактирование позициии <?php echo $this->uri->segment(3);?></h2>
<div class="clearfix">

<div id="tabs">
<ul>
	<li><a href="#tabs-1">Основное</a></li>

</ul>
 <div id="tabs-1">
            	<form action="<?php echo base_url();?>discounts/update_index/<?php echo $this->uri->segment(3);?>" method="post">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                 
                    <tr>
                        <td>
                            <label for="category">
                               Выбор скидки
                            </label>
                        </td>
                        <td colspan="2">
                        <select name="pcategory" id="category"/>
		<?php 
			if($pcategory)
			{
				foreach($pcategory as $item)
				{
					if($item->dc_cat_id == $dposition->dis_parentcat_id)
					{
						echo '<option value="'.$item->dc_cat_id.'" selected="selected">'.stripslashes($item->dc_cat_name).'</option>';
					}
					else
					{
						echo '<option value="'.$item->dc_cat_id.'">'.stripslashes($item->dc_cat_name).'</option>';
					}
				}
			}
			
			
			?>
                        </select>
						
                        &raquo;
						<select name="scategory" id="subcategory"/>
			<?php 
			if($category)
			{
				foreach($category as $item)
				{
					if($item->dc_cat_id == $dposition->dis_cat_id)
					{
						echo '<option value="'.$item->dc_cat_id.'" selected="selected">'.stripslashes($item->dc_cat_name).'</option>';
					}
					else
					{
						echo '<option value="'.$item->dc_cat_id.'">'.stripslashes($item->dc_cat_name).'</option>';
					}
				}
			}
			else
			{
				echo '<option value="">Выберите категорию</option>';
			}
			
			
			?>
                    </select>

                     &raquo;
                     <select name="discount" id="discount" />
			<?php 
			if($dislist)
			{
				foreach($dislist as $item)
				{
					if($item->dis_id == $dposition->dis_id)
					{
						echo '<option value="'.$item->dis_id.'" selected="selected">'.stripslashes($item->obj_nam).stripslashes($item->dis_org).' ['.stripslashes($item->dis_name).' '.$item->dis_amount.'%]</option>';
					}
					else
					{
						echo '<option value="'.$item->dis_id.'">'.stripslashes($item->obj_nam).stripslashes($item->dis_org).' ['.stripslashes($item->dis_name).' '.$item->dis_amount.'%]</option>';
					}
				}
			}
			else
			{
				echo '<option value="">Выберите подкатегорию</option>';
			}
			
			?>	
                    </select>
                    </td>
                  </tr>
                <tr>
                    <td>
                        <label for="">
                            Продолжительность индекса
                        </label>
                    </td>
                    <td>
                   от <input type="text" name="di_dis_start" id="datepicker" value="<?php echo (ymd_decode($dposition->di_dis_start) !=0) ? ymd_decode($dposition->di_dis_start) : '';?>"/> 
                   до <input name="di_dis_end" type="text" id="datepicker2"  value="<?php echo (ymd_decode($dposition->di_dis_end)!=0) ? ymd_decode($dposition->di_dis_end) :'';?>"/>
                </td>
                <td>
                </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td align="right"><input type="submit" name="do" value="обновить"/></td>
                  <td></td>
                </tr>
				
				

				
            </table>
            </form>
        </div>
</div>
</div>
</div>
