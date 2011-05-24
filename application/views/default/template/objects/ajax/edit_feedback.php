<label for="date">Дата отзыва</label>
<?php echo $feedback->feed_time;?>
<br/>
<input type="text" value="<?php echo $feedback->feed_fio;?>" disabled="true"/>
<br/>
<textarea id="feedback_text" cols="50" rows="8" name="feedback_text">
	<?php 
	echo trim(strip_tags(str_replace(chr(10),'',$feedback->feed_txt)));

	?>
	
</textarea>

<br/>
<label for="status">Статус</label>
<input type="radio" name="feedback_status" value="1"/>Не показывать
<br/>
<input type="radio" name="feedback_status" value="2" checked="checked"/>Показывать

<input type="hidden" value="<?php echo $feedback->feed_ids; ?>"/>

