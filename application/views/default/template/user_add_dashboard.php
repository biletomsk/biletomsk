           <div id="dashboard">
				<h2 class="ico_mug">Добавить пользователя</h2>
				<div class="clearfix">
             <div id="tabs">
              <ul>
                            <li><a href="#tabs-1">Кратко</a></li>
                            <li><a href="#tabs-2">Основное</a></li>
                            <li><a href="#tabs-3">Дополнительно</a></li>
                    </ul>
                        <div id="tabs-1">
                            
              <table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><label for="name">Логин: </label></td>
                <td> <input type="text" name="name" id="name"/></td>
                <td></td>
                
              </tr>
              <tr>
                <td><label for="name">Пароль: </label></td>
                <td> <input type="text" name="name" id="name"/></td>
                <td><a href="#" title="сгенерировать" id="passgen">сгенерировать</a></td>
              </tr>

              <tr>
                <td> <label for="type">Категория: </label></td>
                <td>   <select name="type" id="type">
                                <option value="">Пользователь</option>
                                <option value="">Менеджер</option>
                                <option value="">Админ</option>
                                <option value="">Редактор</option>
                                <option value="">Владелец</option>
                             </select></td>
                <td>			
             
                        </td>
              </tr>

              <tr>
                <td>  <label for="">Электронный адрес</label></td>
                <td>  <input type="text" name="where"/> 
                      </td>
                <td>
                            
                </td>
              </tr>
            </table>
            
            
                        
                        </div>
                        <div id="tabs-2">
                            <table width="600" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="146"><img src="img/111.jpg" />
                                <label for="LOGO">аватар пользователя</label></td>
                                <td width="235"><input type="file" name="LOGO"/></td>
                                <td width="219"></td>
                              </tr>
                              <tr>
                                <td>
                                <label for="user_site">Сайт пользователя</label>
                                </td>
                                   <td>
                                <input type="text" name="user_site"/>
                                </td>
                                   <td>
                                
                                </td>
                              </tr>
                              <tr>
                                <td>
                                <label for="user_site">Телефон</label>
                                </td>
                                   <td>
                                <input type="text" name="user_site"/>
                                </td>
                                   <td>
                                
                                </td>
                              </tr>
                              <tr>
                                <td>
                                <label for="user_site">Skype id</label>
                                </td>
                                   <td>
                                <input type="text" name="user_site"/>
                                </td>
                                   <td>
                                
                                </td>
                              </tr>
                                                            <tr>
                                <td>
                                <label for="user_site">Одноклассники</label>
                                </td>
                                   <td><input type="text" name="user_site"/></td>
                                   <td>
                                
                                </td>
                              </tr>
                                                            <tr>
                                <td>
                                <label for="user_site">Вконтакте</label>
                                </td>
                                   <td><input type="text" name="user_site"/></td>
                                   <td>
                                
                                </td>
                              </tr>
                                                            <tr>
                                <td>
                                <label for="user_site">Liveinternet</label>
                                </td>
                                   <td>
                                <input type="text" name="user_site"/>
                                </td>
                                   <td>
                                
                                </td>
                              </tr>
                      
                            </table>
                        </div>
                            
                        <div id="tabs-3">
                        <table width="600" border="0" cellspacing="0" cellpadding="0">
               
                                <td>Уведомить пользователя</td>
                                <td>                            <div style=" padding:10px;background-color:#FF9; border:#F90 1px solid; width:40px; text-align:center">
                                      <input type="checkbox" name="nointerval"/>
                                    </div></td>
                                <td>&nbsp;</td>
                              </tr>

              <tr>
                <td>Статус пользователя</td>
                <td colspan="2">
                <input type="radio" name="show" value="0"/>не активный 
                <input type="radio" name="show" value="1" checked="checked"/>активный 
                <input type="radio" name="show" value="2" />забанен
                </td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><input type="submit" value="Добавить" name="do"/></td>
              </tr>
            </table>
            
                        
                        </div>
                  </div>
               </div>
			</div><!-- end #dashboard -->