<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Asignaciones extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('grocery_CRUD');
       // $this->load->model('Prueba_model');
       
    }
  private function verifica_logueo()
    {
        $this->load->model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();
    }


    public function salida($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

    public function _viewSalida($vista,$data)
    {
        $this->load->Model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();

        $data['vista']   = $vista;
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }
    function registro_maquina()
    {
        $this->verifica_logueo();
        $this->load->model('Asignaciones_model');
        $id_reserva = $this->input->get('id_reserva');
        $data['reserva'] =$this->Asignaciones_model->get_reserva($id_reserva);
        $data['maquina'] =$this->Asignaciones_model->get_maquinas();
        $this->_viewSalida('v_asignaciones',$data);

    }

        //------------------------------------------------
    public function ajax_list()
    {
        $this->load->model('Asignaciones_model');
        $id_reserva = $_GET['id_reserva'];
        $list = $this->Asignaciones_model->get_registros_maquinarias($id_reserva);
        $data = array();
        $no = $_POST['start'];
        $i=0;
        foreach ($list as $p) {
            $i++;
            $no++;
            $row = array();
            $row[] = $i;
            $row[] = $p->fecha;
            $row[] = $p->maquina;
            $row[] = $p->peso_unitario.' TN';
         
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_maquina('."'".$p->id_maquinaria_reserva."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_maquina('."'".$p->id_maquinaria_reserva."'".')"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Asignaciones_model->count_all(),
                        "recordsFiltered" => $this->Asignaciones_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
        $this->load->model('Asignaciones_model');

        $data = array(
            'id_reserva' => $this->input->post('id_reserva'),
            'id_maquinaria' => $this->input->post('id_maquinaria'),
                    );
         $insert = $this->Asignaciones_model->save_tarea($data);
        echo json_encode(array("status" => TRUE));
    }


    
    public function ajax_update()
    {
        $this->load->model('Asignaciones_model');

        $data = array(
            'id_reserva' => $this->input->post('id_reserva'),
            'id_maquinaria' => $this->input->post('id_maquinaria'),
            );
        $this->Asignaciones_model->update_tarea(array('id_maquinaria_reserva' => $this->input->post('id_maquinaria_reserva')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->load->model('Asignaciones_model');

        $this->Asignaciones_model->delete_by_id_maquina($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    { 

        $this->load->model('Asignaciones_model');
        $data = $this->Asignaciones_model->get_by_id_maquina($id);
        echo json_encode($data);
    }



}