<?php
    $this->load->view('dashboard/template/header');
    $this->load->view('dashboard/template/navbar');
    $this->load->view('dashboard/template/sidebar');
    $this->load->view($view);
    $this->load->view('dashboard/template/script');
    $this->load->view('dashboard/template/footer');
?>
