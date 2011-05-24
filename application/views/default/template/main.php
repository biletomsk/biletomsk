<div id="content" >
	<div id="top_menu" class="clearfix">
	<!--	<ul class="sf-menu"> <!-- DROPDOWN MENU
			<li class="current">
				<a href="#a">Настройки</a><!-- First level MENU
				<ul>
					<li>
						<a href="#aa">Database options</a>
					</li>
					<li class="current">
						<a href="#ab">Blog settings</a> <!-- Second level MENU 
						<ul>
							<li class="current"><a href="#">Settings</a></li>
							<li><a href="#aba">menu item</a></li>
							<li><a href="#abb">menu item</a></li>
							<li><a href="#abc">menu item</a></li>
							<li><a href="#abd">menu item</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Menu Options</a> <!-- Third level MENU
						<ul>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Editor</a>
						<ul>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
							<li><a href="#">menu item</a></li>
						</ul>
					</li>
				</ul>
			</li>


	

		</ul>
		-->
			<a href="#" id="visit" class="right">Перейти на сайт</a>
	    </div>
		<div id="content_main" class="clearfix">
			<div id="main_panel_container" class="left">
            
            <?php 
            
            $this->load->view('default/template/'.$dash_tpl, @$dash_content);
            
            ?>
            
			
			
			
			
			<div id="shortcuts" class="clearfix">
				<h2 class="ico_mug"><?php echo $data;?></h2>
				<ul>
					<li class="first_li"><a href=""><img src="<?php echo base_url();?>img/theme.jpg" alt="themes" /><span>Объекты</span></a></li>
					<li><a href=""><img src="<?php echo base_url();?>img/statistic.jpg" alt="statistics" /><span>Статистика</span></a></li>
					<li><a href=""><img src="<?php echo base_url();?>img/ftp.jpg" alt="FTP" /><span>Файлы</span></a></li>
					<li><a href=""><img src="<?php echo base_url();?>img/users.jpg" alt="Users" /><span>Пользователи</span></a></li>
					<li><a href=""><img src="<?php echo base_url();?>img/comments.jpg" alt="Comments" /><span>Комментарии</span></a></li>
					<li><a href=""><img src="<?php echo base_url();?>img/gallery.jpg" alt="Gallery" /><span>Фотоотчеты</span></a></li>
					<li><a href=""><img src="<?php echo base_url();?>img/security.jpg" alt="Security" /><span>Безопасность</span></a></li>
					
				</ul>
			</div><!-- end #shortcuts -->
			
			</div>
			<div id="sidebar" class="right">
							<h2>Меню</h2>
			<ul id="menu">
				<li>
					<a href="#" class="ico_posts">Новости</a>
					<ul>
						<li><a href="<?php echo base_url();?>news/add">Добавить новость</a></li>
						<li><a href="<?php echo base_url();?>news">Обзор новостей</a></li>
						<li><a href="<?php echo base_url();?>news/category">Категории</a></li>
						<li><a href="<?php echo base_url();?>news/archive">Архив</a></li>
					</ul>
					<a href="#" class="ico_page">Объекты</a>
					<ul>
						<li><a href="<?php echo base_url();?>object/add">Добавить объект</a></li> 
						<?php 
						
						if($main_category)
						{
							foreach ($main_category AS $item)
							{
								echo '<li><a href="'.base_url().'object/show_category/'.$item->categ_alter2.'">'.stripslashes($item->categ_nam).'</a></li> ';
							} 
						}
						
						?>
						
						
		
					</ul>
					<!--
					<a href="#" class="ico_user">Афиша</a>
					<ul>
						<li><a href="#">Добавить</a></li>
						<li><a href="#">Обзор</a></li>
						<li><a href="#">Manage users</a></li>
					</ul>-->
					<a href="#" class="ico_settings">Статьи</a>
					<ul>
						<li><a href="<?php echo base_url();?>articles/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>articles/">Обзор статей</a></li>
						<li><a href="<?php echo base_url();?>articles/category">Категории</a></li>
					</ul>
					<a href="#" class="ico_settings">Спорт</a>
					<ul>
						<li><a href="<?php echo base_url();?>sport/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>sport">Обзор видов спорта</a></li>
						<li><a href="<?php echo base_url();?>sport/competition">Соревнования</a></li>
						<li><a href="<?php echo base_url();?>sport/add_competition">Добавить соревнования</a></li>
					</ul>
					<a href="#" class="ico_settings">Фотоотчеты</a>
					<ul>
						<li><a href="<?php echo base_url();?>photoarchive/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>photoarchive/">Обзор</a></li>
						<li><a href="<?php echo base_url();?>photoarchive/category">Категории</a></li>
					</ul>
                    
                    <a href="#" class="ico_settings">Консультации</a>
					<ul>
						<li><a href="<?php echo base_url();?>consultation/add">Добавить консультанта</a></li>
						<li><a href="<?php echo base_url();?>consultation/">Обзор</a></li>
						<li><a href="<?php echo base_url();?>consultation/new_questions">Новые вопросы</a></li>
						<li><a href="<?php echo base_url();?>consultation/answer_question">Обзор "вопрос-ответ"</a></li>
						<li><a href="<?php echo base_url();?>consultation/category">Категории консультантов</a></li>
					</ul>
					<!--
					<a href="#" class="ico_settings">Конкурсы</a>
					<ul>
						<li><a href="<?php echo base_url();?>contests/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>contests/present">Обзор текущих</a></li>
						<li><a href="<?php echo base_url();?>contests/past">Обзор прошедших</a></li>
					</ul>
					<a href="#" class="ico_settings">ТВ</a>
					<ul>
						<li><a href="#">Database</a></li>
						<li><a href="#">Themes</a></li>
						<li><a href="#">Options</a></li>
					</ul> 
                    
                    <a href="#" class="ico_settings">События</a>
					<ul>
						<li><a href="#">Database</a></li>
						<li><a href="#">Themes</a></li>
						<li><a href="#">Options</a></li>
					</ul> --> 
					<a href="#" class="ico_settings">Скидки</a>
					<ul>
						<li><a href="<?php echo base_url();?>discounts/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>discounts">Обзор текущих акций</a></li>
						<li><a href="<?php echo base_url();?>discounts/category">Обзор категорий</a></li>
						<li><a href="<?php echo base_url();?>discounts/category_add">Добавить категорию</a></li>
						<li><a href="<?php echo base_url();?>discounts/scategory">Обзор подкатегорий</a></li>
						<li><a href="<?php echo base_url();?>discounts/show_index">Обзор индексов</a></li>
					</ul>
					<!--
					<a href="#" class="ico_settings">Пользователи</a>
					<ul>
						<li><a href="<?php echo base_url();?>users">Обзор</a></li>
						<li><a href="<?php echo base_url();?>users/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>group">Группы</a></li>
					</ul>
                    
					<a href="#" class="ico_settings">Банеры</a>
					<ul>
						<li><a href="<?php echo base_url();?>banners/add">Добавить</a></li>
						<li><a href="<?php echo base_url();?>banners/">Обзор</a></li>
						<li><a href="#">Options</a></li>
					</ul>-->
                                                         
				</li>
		
				
			</ul>


			</div><!-- end #sidebar -->
		</div><!-- end #content_main -->