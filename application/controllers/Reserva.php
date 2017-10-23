<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    public function _viewOutPut($data) {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }
    private function verifica_logueo()
    {
        $this->load->model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();
    }

    public function index()
    {
        $this->verifica_logueo();
        $this->load->model('Reserva_model');
        
        $lista = $this->Reserva_model->get_lista_reserva($_SESSION['id_persona']);


        $i=1;
        $cad =""; 
        foreach($lista as $d){



            $cad .= "<tr>";
            $cad .= "    <td>$i</td>";
            $cad .= "    <td>".$d->fecha."</td>";
            $cad .= "    <td>".$d->nombre."</td>";
            $cad .= "    <td>".$d->destino."</td>";
            if($d->estado==1){
                $cad .= "    <td>EN PROCESO</td>";
            }else{
                $cad .= "    <td>TERMINADO</td>";
            }

            $cad .= "     <td>";
            $cad .= "        <button onclick='edit(".$d->id_reserva.")' class='btn btn-block btn-linkedin'><i class='glyphicon glyphicon-edit'></i>   Editar</button>";
            $cad .= "     </td>";
            
            
            

            $cad .= "</tr>";
            $i++;
        }
        $data['lista'] = $cad;
        $data['vista'] = 'v_lista_reserva';
        $this->_viewOutPut($data);
    }

    public function ajax_edit($id)
    {
        $this->load->model('Reserva_model');
        $data = $this->Reserva_model->get_by_id($id);
        echo json_encode($data);
    }


    public function ajax_add()
    {
        $this->load->model('Reserva_model');

            $data = array(
                'id_persona' => $_SESSION['id_persona'],
                'nombre' => $this->input->post('nombre'),
                'estado' => $this->input->post('estado'),
                'destino' => $this->input->post('destino'),
            );
            $insert = $this->Reserva_model->save($data);

            echo json_encode(array("status" => TRUE));


    }



    public function ajax_update()
    {
        $this->load->model('Reserva_model');
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'estado' => $this->input->post('estado'),
            'destino' => $this->input->post('destino'),
        );
        $this->Reserva_model->update(array('id_reserva' => $this->input->post('id_reserva')), $data);
        echo json_encode(array("status" => TRUE));
    }





    
}