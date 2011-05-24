<div id="dashboard">
    <h2 class="ico_mug">Добавить категорию</h2>
    <div class="clearfix">
    	
        <div id="tabs">
            <ul>
                <li>
                    <a href="#tabs-1">Основное</a>
                </li>
  
            </ul>
            <div id="tabs-1">
            	<form action="<?php echo base_url();?>discounts/category_save" method="post" >
				 <table width="600" border="0" cellspacing="0" cellpadding="0">
     
                    <tr>
                        <td>
                    	В какую категорию входит
					   </td>
                        <td>
                        	<select style="width:200px;" name="dc_parent_id">
							<option selected="selected" value="0">Это категория верхнего уровня</option>
                        		<?php
										
										
									foreach($pcategory as $row)
									{
										echo '<option value="'.$row->dc_cat_id.'">'.$row->dc_cat_name.'</option>';
																		
									}
								
								?>
							
                        	</select>
                           
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                         Название
                        </td>
                        <td>
                       <input type="text" name="dc_cat_name" value=""/>
                      
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        Транслитерация
                    </td>
                    <td>
  					<input type="text" name="dc_cat_nick" value=""/>
                      
                </td>
                <td>
                </td>
                </tr>
				<tr>
                    <td>
                       
                    </td>
                    <td>
  					
                      
                </td>
                <td>
                	<input type="submit" class="button" value="Добавить"/>
                </td>
                </tr>
			
				

				
            </table>
			</form>
        </div>
	</div>	
	</div>
</div>	