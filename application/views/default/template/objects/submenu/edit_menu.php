
<div id="dashboard2">
    <h2 class="ico_mug">Редактирование меню объекта</h2>

    <?php echo @$message;?>
					<br/>
    	<form action="<?php echo base_url();?>submenu/update_menu/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data" method="post">
    	<input type="hidden" value="<?php echo $this->uri->segment(3);?>" id="objid" />
		
        <label>
            Действие:
            <select id="setMethod" name="method">
                <option selected="selected" value="">выберите</option>
                <option value="html">HTML</option>
                <option value="graphic">JPEG</option>
            </select>
        </label>
        <div id="block">
        </div>
		
		</form>
<input type="button" onClick="window.close();" class="button" value="Закрыть"/>
</div>
<!-- end #dashboard -->
