<?php $this->load->view('default/template/header', @$head_content); ?>
<?php $this->load->view('default/template/'.$main_content['tpl'], $main_content['dash']); ?>
<?php $this->load->view('default/template/footer'); ?>