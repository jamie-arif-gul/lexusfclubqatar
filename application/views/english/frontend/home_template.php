<?php if($this->session->userdata('site_lang'))
    $lang = $this->session->userdata('site_lang');
else
    $lang = 'english';
$this->session->set_userdata('lang_key', 1);
    ?>
<?php $this->load->view($lang.'/frontend/includes/header'); ?>

<?php $this->load->view($lang."/".$main_content); ?>

<?php $this->load->view($lang.'/frontend/includes/footer'); ?>