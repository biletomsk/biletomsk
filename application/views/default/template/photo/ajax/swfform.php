	<script type="text/javascript" language="javascript">
		
$(document).ready(function(){
										
					$("#upload22").uploadify({
							uploader: '<?php echo base_url();?>js/uploadify/uploadify.swf',
							script: '<?php echo base_url();?>js/uploadify/uploadify.php',
							cancelImg: '<?php echo base_url();?>js/uploadify/cancel.png',
							folder:'/var/www/biletoms/data/www/biletomsk.ru/photoarchive/tmp',
							scriptAccess: 'always',
							multi: true,
							'onError' : function (a, b, c, d) {
								 if (d.status == 404)
									alert('Could not find upload script.');
								 else if (d.type === "HTTP")
									alert('error '+d.type+": "+d.status);
								 else if (d.type ==="File Size")
									alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
								 else
									alert('error '+d.type+": "+d.text);
								},
							'onComplete'   : function (event, queueID, fileObj, response, data) {
												//Post response back to controller
												$.post('<?php echo site_url('uploader/uploadify');?>',{filearray: response},function(info){
													$("#target").append(info);  //Add response returned by controller																		  
												});								 			
							},	
							//fileExt: '.jpg,.jpeg,.png,.bmp,.gif'
					});				
		});
	</script>
    <p>
    	<label for="Filedata">Выбрать файлы</label><br/>
        <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload22'));?>
        <a href="javascript:$('#upload22').uploadifyUpload();">Начать загрузку</a>
    </p>
    
    
 
    
	<div id="target">
	
	</div>
	


