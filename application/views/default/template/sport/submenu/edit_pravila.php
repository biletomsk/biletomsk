<div id="dashboard2">
    <h2 class="ico_mug">Редактирование правил спорта</h2>
    <?php echo @$message; ?>
    <br/>
    <form action="<?php echo base_url();?>submenu/update_pravila/<?php echo $this->uri->segment(3); ?>" enctype="multipart/form-data" method="post">
        <textarea name="html_content" id="html_content" style="width:100%; height:auto;">
            <?php echo $pravila->sp_pravila; ?>
        </textarea>
        <input type="submit" value="Обновить" name="do"/>
    </form>
</div><!-- end #dashboard -->
<script type="text/javascript">
    
    tinyMCE.init({
    
        mode: "textareas",
        
        theme: "simple"
    
    });
</script>