<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

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
        $data['controlador']= 'Registro';
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
    //------------------ Modulo Cargo ----------------------------------------
    function cargo(){
        $this->verifica_logueo();
        $this->_viewOutPut('cargoCrud');
    }
    function cargoCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            //$crud->set_theme('bootstrap');
            $crud->set_subject('Cargo');
            $crud->set_table('cargo');
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    //------------------ Modulo Funcionario ----------------------------------------
    function persona(){
        $this->verifica_logueo();
        $this->_viewOutPut('personaCrud');
    }
    function personaCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            $crud->set_subject('Registro');
            $crud->set_table('persona');
            $crud->display_as('id_empresa','Empresa');
            $crud->set_relation('id_empresa','empresa','{nombre}');
            $crud->set_field_upload('foto','assets/uploads/img');
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

        //------------------ Modulo Empresa ----------------------------------------
    function empresa(){
        $this->verifica_logueo();
        $this->_viewOutPut('empresaCrud');
    }
    function empresaCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            $crud->set_subject('Empresa');
            $crud->set_table('empresa');
            $crud->field_type('ciudad','dropdown',array('LA PAZ'=>'LA PAZ', 'CHUQUISACA'=>'CHUQUISACA', 'ORURO'=>'ORURO', 'POTOSI'=>'POTOSI','SANTA CRUZ'=>'SANTA CRUZ', 'BENI'=>'BENI', 'PANDO'=>'PANDO', 'TARIJA'=>'TARIJA', 'COCHABAMBA'=>'COCHABAMBA'));
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }



    //------------------ Modulo asignar cargo ----------------------------------------
    function asignacion(){
        $this->verifica_logueo();
        $this->_viewOutPut('asignacionCrud');
    }
    function asignacionCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            //$crud->set_theme('bootstrap');
            $crud->set_subject('Asignacion');
            $crud->set_table('persona_cargo');
            //$crud->columns('id_persona','fecha_asignacion','id_cargo','usuario','contrasena');

            $crud->display_as('id_persona','Persona');
            $crud->display_as('id_cargo','Cargo');
            $crud->display_as('contrasena','Contraseña');
            $crud->field_type('estado','dropdown',array('1'=>'ACTIVO', '0'=>'INACTIVO'));

            //relacion con la tabla 1:n set_relation(id_campo_foraneo,tabla_foranea,nombre_campo_foraneo)
            $crud->set_relation('id_cargo','cargo','{nombre}');
            $crud->set_relation('id_persona','persona','{paterno} {materno} {nombre}');

            $crud->change_field_type('password', 'password');
            $crud->change_field_type('usuario', 'password');

            $crud->callback_before_insert(array($this,'encrypt_password'));
            $crud->callback_before_update(array($this,'encrypt_password'));

            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function encrypt_password($post_array, $primary_key = null){
        $this->load->helper('security');
        $post_array['password'] = do_hash($post_array['password'], 'sha1');
        $post_array['usuario'] = do_hash($post_array['usuario'], 'sha1');
        return $post_array;
    }

    
}