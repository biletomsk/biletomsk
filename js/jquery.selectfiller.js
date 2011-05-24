(function($){
    /* ������� select */
    $.fn.clearSelect = function() {
        return this.each(function(){
            /* ��������� �������� �� ������� select`�� */
            if(this.tagName=='SELECT') {
                this.options.length = 0;
                /* ��������� �� ����� ���������� */
                $(this).attr('disabled','disabled');
            }
        });
    }
 
 
    /* ��������� select ����������� ������� */
    $.fn.fillSelect = function(dataArray) {
        return this.clearSelect().each(function(){
            /* ��������� �������� �� ������� select`�� */
            if(this.tagName=='SELECT') {
                var currentSelect = this;

 
                $.each(dataArray,function(index,data){
                    /* ���� ���������� 'name' */
                    if(data.name) {
                        /* ������� ����� option */
                        var option = new Option(data.name,data.id);
                        /* ��������� ����� option � select`� */
                        if($.support.cssFloat) {
                            currentSelect.add(option,null);
                        } else {
                            currentSelect.add(option);
                        }
                    }
                });
                /* �������� ������ ������� ������ */
                $(this).removeAttr('disabled').find('option:first').attr('selected', 'selected');
            }
        });
    }
})(jQuery);