<div id="login" class="section">
	    	
	    	<form name="loginform" id="loginform" action="<?php echo base_url();?>login/check_user" method="post">
			
			<label><strong>Логин</strong></label>
            <?php echo form_error('log'); ?>
            <input type="text" name="log" id="user_login"  value="<?php echo set_value('log');?>"  size="28" class="input"/>
			<br />
			<label><strong>Пароль</strong></label>
            <?php echo form_error('pwd'); ?>
            <input type="password" name="pwd" id="user_pass" value="<?php echo set_value('pwd');?>" size="28" class="input"/>
			<br />
			<strong>запомнить меня</strong><input type="checkbox" id="remember" class="input noborder" /> 
			
			<br />
		
			<input id="save" class="loginbutton" type="submit" class="submit" value="войти" />
			
			</form>
			
			<a href="#" id="passwordrecoverylink">Забыли пароль или логин?</a>
	    </div>
	
	    
		    


</div><!-- end container -->