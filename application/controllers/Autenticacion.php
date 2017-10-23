<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {

    public function index()
    {
        $this->load->view('autenticacion_login');
    }
    public function login()
    {

        $this->load->Model('Autenticacion_model');
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');

        if($this->Autenticacion_model->login($username, $password)){
        }
        else{
            echo'error clave incorrecta';
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url().'Autenticacion' ,'refresh');
        exit;
    }

    public function inicio()
    {
        $this->load->Model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();
        $data['vista']   = 'v_inicio';
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

}
