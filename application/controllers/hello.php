<?php

class hello extends CI_Controller {

    Public function index()
    {
        $data['nama'] = "Triono";
        $this->load->view('hello_view', $data);
    }
}