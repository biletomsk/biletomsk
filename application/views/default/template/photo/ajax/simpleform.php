<script type="text/javascript" src="<?php echo base_url();?>js/jquery.MultiFile.js"></script>
<script type="text/javascript">

    //multiFile
    $(".MultiFile").MultiFile({
        accept: 'jpg',
        max: 150,
        STRING: {
            remove: '<img style="border: 0px;" src="<?php echo base_url();?>img/bin.gif" height="16" width="16" alt="x"/>',
            file: '$file | описание фото: <textarea rows="3" cols="40" name="ftxt[]"></textarea> ',
            selected: ' Выбраны: $file ',
            denied: 'Неверный тип файла: $ext!',
            duplicate: 'Этот файл уже выбран:\n$file!'
        }
    });

</script>
<td colspan="3">
  <input name="MAX_FILE_SIZE" value="1000000" type="hidden"/>
  Выберите фотографии <span style="color:red;">*</span>:
  <input name="IMAGES[]" id="fileToUpload" class="MultiFile" type="file"/>
</td>
