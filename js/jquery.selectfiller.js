(function($){
    /* Очищаем select */
    $.fn.clearSelect = function() {
        return this.each(function(){
            /* Проверяем является ли элемент select`ом */
            if(this.tagName=='SELECT') {
                this.options.length = 0;
                /* Блокируем на время заполнения */
                $(this).attr('disabled','disabled');
            }
        });
    }
 
 
    /* Заполняем select переданными данными */
    $.fn.fillSelect = function(dataArray) {
        return this.clearSelect().each(function(){
            /* Проверяем является ли элемент select`ом */
            if(this.tagName=='SELECT') {
                var currentSelect = this;

 
                $.each(dataArray,function(index,data){
                    /* Если определено 'name' */
                    if(data.name) {
                        /* Создаем новый option */
                        var option = new Option(data.name,data.id);
                        /* Добавляем новый option к select`у */
                        if($.support.cssFloat) {
                            currentSelect.add(option,null);
                        } else {
                            currentSelect.add(option);
                        }
                    }
                });
                /* Выделяем первый элемент списка */
                $(this).removeAttr('disabled').find('option:first').attr('selected', 'selected');
            }
        });
    }
})(jQuery);