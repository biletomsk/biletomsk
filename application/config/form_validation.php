<?php
/*
  Файл конфигурации для указания правил проверки данных форм



*/
$config = array(
			'login/check_user'=>array(         //Создание аккаунта пользователя
											array(
											'field'=>'log',
											'label'=>'Логин',
											'rules'=>'trim|required|alpha_numeric|min_lenght[3]|max_lenght[20]'
											),
											array(
											'field'=>'pwd',
											'label'=>'Пароль',
											'rules'=>'trim|required|min_lenght[5]|max_lenght[32]'
											)
			),
			
			'dis_cat_update' => array(
											array(
											'field'=>'dc_cat_name',
											'label'=>'Название категории',
											'rules'=>'required'			
											)
										),	
			'news/save'=>array(				//Добавление новости
											array(
											'field'=>'new_name',
											'label'=>'Название новости',
											'rules'=>'trim|required|max_lenght[100]
											'),
											array(
											'filed'=>'new_type',
											'label'=>'Категория новости',
											'rules'=>'required'
											),
											array(
											'filed'=>'new_preview',
											'label'=>'привью новости',
											'rules'=>'trim|required'
											),
											array(
											'filed'=>'new_fulltext',
											'label'=>'основной текст',
											'rules'=>'trim|required'
											),
											array(
											'filed'=>'new_status',
											'label'=>'статус новости',
											'rules'=>'required'
											)
				
			),
			'update'=>array(				//Добавление новости
											array(
											'field'=>'new_name',
											'label'=>'Название новости',
											'rules'=>'trim|required|max_lenght[100]
											'),
											array(
											'filed'=>'new_type',
											'label'=>'Категория новости',
											'rules'=>'required'
											),
											array(
											'filed'=>'new_preview',
											'label'=>'привью новости',
											'rules'=>'trim|required'
											),
											array(
											'filed'=>'new_fulltext',
											'label'=>'основной текст',
											'rules'=>'trim|required'
											),
											array(
											'filed'=>'new_status',
											'label'=>'статус новости',
											'rules'=>'required'
											)
				
			),
			'news/category_save'=>array(				//Добавление новости
											array(
											'field'=>'new_category',
											'label'=>'Название категории новостей',
											'rules'=>'trim|required|max_lenght[100]
											')
										),
			'category_update'=>array(				//Добавление новости
											array(
											'field'=>'cat_name',
											'label'=>'Название категории новостей',
											'rules'=>'trim|required|max_lenght[100]
											'),
											array(
											'field'=>'cat_name2',
											'label'=>'Название категории в родит. падеже, мн. числе ',
											'rules'=>'trim|required|max_lenght[100]
											')
			),
			'articles/save'=>array(				//Добавление новости
											array(
											'field'=>'art_name',
											'label'=>'Название статьи',
											'rules'=>'trim|required|max_lenght[100]
											'),
											array(
											'filed'=>'art_type',
											'label'=>'Категория статьи',
											'rules'=>'required'
											),
											array(
											'filed'=>'art_fulltext',
											'label'=>'основной текст',
											'rules'=>'trim|required'
											)
				
			),
			'art_update'=>array(				//Добавление новости
											array(
											'field'=>'art_name',
											'label'=>'Название статьи',
											'rules'=>'trim|required|max_lenght[100]
											'),
											array(
											'filed'=>'art_type',
											'label'=>'Категория статьи',
											'rules'=>'required'
											),
											array(
											'filed'=>'art_fulltext',
											'label'=>'основной текст',
											'rules'=>'trim|required'
											),
											array(
											'filed'=>'art_status',
											'label'=>'статус статьи',
											'rules'=>'required'
											)
				
			),
			'articles/category_save'=>array(				//Добавление новости
											array(
											'field'=>'art_category',
											'label'=>'Название категории статей',
											'rules'=>'trim|required|max_lenght[100]
											')
			),
			'art_category_update'=>array(				//Добавление новости
											array(
											'field'=>'cat_name',
											'label'=>'Название категории статей',
											'rules'=>'trim|required|max_lenght[100]
											'),
											array(
											'field'=>'cat_name2',
											'label'=>'Название категории на латинице ',
											'rules'=>'trim|alpha_numeric|required|max_lenght[100]
											')
			),
			'object_update'	=>array(
											array(
											'field'=>'obj_nam',
											'label'=>'Название объекта',
											'rules'=>'trim|required'			
											),
											array(
											'field'=>'obj_categ',
											'label'=>'Категория объекта',
											'rules'=>'trim|required'			
											),
											array(
											'field'=>'obj_transl',
											'label'=>'Поддомен объекта',
											'rules'=>'trim|required|alpha_numeric'			
											)

									
			
			),
			'sport_update'	=>array(
											array(
											'field'=>'sp_name',
											'label'=>'Название вида спорта',
											'rules'=>'trim|required'			
											),
											array(
											'field'=>'sp_txt',
											'label'=>'Описание вида спорта',
											'rules'=>'trim|required'			
											)

									
			
			),
			'competition_update'=>array(
											array(
											'field'=>'sps_name',
											'label'=>'Название соревнования',
											'rules'=>'trim|required'			
											),
											array(
											'field'=>'sps_txt',
											'label'=>'Описание соревнования',
											'rules'=>'trim|required'			
											),
											array(
											'field'=>'competit_date',
											'label'=>'Дата соревнования',
											'rules'=>'trim|required'			
											),
											array(
											'field'=>'competit_type',
											'label'=>'Категория соревнования',
											'rules'=>'trim|required'			
											)
										),	
			'discounts_update' => array(
											array(
											'field'=>'dis_name',
											'label'=>'Название скидки',
											'rules'=>'required'			
											),
											array(
											'field'=>'dis_type',
											'label'=>'Тип скидки',
											'rules'=>'required'			
											),
											array(
											'field'=>'scategory',
											'label'=>'Категория скидки',
											'rules'=>'trim|required'			
											),											
											array(
											'field'=>'dis_amount',
											'label'=>'Размер скидки',
											'rules'=>'trim|required|numeric'			
											),
											
											array(
											'field'=>'dis_item_type',
											'label'=>'измеритель скидки',
											'rules'=>'required'			
											)
			
			
			
										),
			'discounts_index_update' => array(
											array(
											'field'=>'pcategory',
											'label'=>'Категория скидки',
											'rules'=>'required'
											),
											array(
											'field'=>'scategory',
											'label'=>'Подкатегория скидки',
											'rules'=>'required'										
											),
											array(
											'field'=>'discount',
											'label'=>'Скидка',
											'rules'=>'required'
											),
											array(
											'field'=>'di_dis_start',
											'label'=>'Дата появления',
											'rules'=>'required'
											),
											array(
											'field'=>'di_dis_end',
											'label'=>'Дата скрытия',
											'rules'=>'required'
											)										
										
										),							
			'photo_update'	=> array(
											array(
											'field'=>'arch_name',
											'label'=>'Название фотоотчета',
											'rules'=>'required'			
											),
											array(
											'field'=>'arch_date',
											'label'=>'Дата фотоотчета',
											'rules'=>'required'			
											),
											array(
											'field'=>'arch_categ',
											'label'=>'Категория фотоотчета',
											'rules'=>'trim|required'			
											),											
											array(
											'field'=>'arch_txt',
											'label'=>'Описание фотоотчета',
											'rules'=>'trim|required'			
											)
			
									),
			'photo_categ'	=> array(
											
											array(
											'field'=>'name',
											'label'=>'Название категории',
											'rules'=>'required'			
											)
			
									)						
			
										
				

									
			
);
			
			



?>