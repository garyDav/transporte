<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maquinaria extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
    }

    private function verifica_logueo()
    {
        $this->load->model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();
    }

    public function _viewOutPut($vista) {
        $data['vista'] = $vista;
        $data['controlador']= 'Maquinaria';
        $this->load->view('plantilla/header');
        $this->load->view('crud/contenido',$data);
        $this->load->view('plantilla/footer');
    }

    public function __salida_output($output = null) {
        $this->load->view('crud/crud.php', $output);
    }

    public function index()
    {
    }

           //------------------ Modulo Maquinaria ----------------------------------------
    function maquina(){
        $this->verifica_logueo();
        $this->_viewOutPut('maquinaCrud');
    }
    function maquinaCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            $crud->set_subject('Maquina');
            $crud->set_table('maquinaria');
            $crud->display_as('id_tipo_movilizacion','Movilizacion');
            $crud->set_relation('id_tipo_movilizacion','tipo_movilizacion','{nombre}');
            $crud->field_type('estado','dropdown',array('1'=>'ACTIVO', '0'=>'INACTIVO'));
            $crud->display_as('peso_unitario','Peso Unitario (TN)');
            $crud->display_as('nombre','Nombre de la maquina');
            $crud->set_field_upload('foto','assets/uploads/imgproductos');
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

           //------------------ Modulo Movilizacion ----------------------------------------
    function movilizacion(){
        $this->verifica_logueo();
        $this->_viewOutPut('movilizacionCrud');
    }
    function movilizacionCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            $crud->set_subject('Tipo de movilización');
            $crud->set_table('tipo_movilizacion');
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }




}