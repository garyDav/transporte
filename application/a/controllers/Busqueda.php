<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }

    private function verificaLoqueo()
    {
        $this->load->model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();
    }

    //-------------------------- Modulo Busqueda --------------------------------------------
    public function salida($data)
    {
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }
    
    public function buscar(){
            $this-> verificaLoqueo();
            $data['vista'] = 'vBusquedaRegistro';
            $this->salida($data);
    }

    public function search()
    {
        $this-> verificaLoqueo();
        $this->load->model('BusquedaModel');

        $campo = $this->input->get('campo');
        $dato  = strtoupper($this->input->get('name'));

        $datos = $this->BusquedaModel->getRegistro($campo,$dato);

        if(count($datos)==0)
        {
            echo "<tr>";
            echo "<td colspan='5'>Registros no encontrados</td>";
            echo "</tr>";
        }else{
       

            echo "<thead>";
            echo "<th>FECHA</th>";
            echo "<th>NOMBRE DEL PROYECTO</th>";
            echo "<th>CLIENTE</th>";
            echo "<th>Elige</th>";
            echo "</thead>";
            foreach ($datos as $row) {
                echo "<tr >";
                echo "<td>".$row->fecha."</td>";
                echo "<td>".$row->proyecto."</td>";
                echo "<td>".$row->cliente."</td>";
                if($_SESSION['id_persona']==$row->id_persona){
                echo "<td><a class='btn btn-success' href='".base_url()."Asignaciones/registro_maquina?id_reserva=".$row->id_reserva."'>Ingresar</a></td>";
                }else{
                echo "<td><a class='btn btn-success' disabled >Ingresar</a></td>";
                }
                echo "</tr>";
            }
        }
    }



    public function buscar_ventas(){
            $this-> verificaLoqueo();
            $data['vista'] = 'v_busqueda_venta';
            $this->salida($data);
    }

    public function search_venta()
    {
        $this-> verificaLoqueo();
        $this->load->model('Busqueda_model');

        $campo = $this->input->get('campo');
        $dato  = strtoupper($this->input->get('name'));

        $datos = $this->Busqueda_model->get_registro($campo,$dato);

        if(count($datos)==0)
        {
            echo "<tr>";
            echo "<td colspan='5'>Registros no encontrados</td>";
            echo "</tr>";
        }else{
            $i=0;

            echo "<thead>";
            echo "<th>Nro</th>";
            echo "<th>MARCA</th>";
            echo "<th>TIPO</th>";
            echo "<th>CONDICIONES</th>";
            echo "<th>KILOMETROS</th>";
            echo "<th>PRECIO</th>";
            echo "<th>MODELO</th>";
            echo "<th>CILINDRAJE</th>";
            echo "<th>COLOR</th>";
            echo "<th>NUMERO STOCK</th>";
            echo "<th>IN-STOCK</th>";


            echo "<th>Elige</th>";
            echo "</thead>";
            foreach ($datos as $row) {
                
                $i++;
                echo "<tr >";
                echo "<td>$i</td>";
                echo "<td>".$row->marca."</td>";
                echo "<td>".$row->tipo."</td>";
                echo "<td>".$row->condiciones."</td>";
                echo "<td>".$row->kilometros.' Km'."</td>";
                echo "<td>".$row->precio."</td>";
                echo "<td>".$row->modelo."</td>";
                echo "<td>".$row->cilindraje. ' cc'."</td>";
                echo "<td>".$row->color."</td>";
                echo "<td>".$row->num_stock."</td>";
                echo "<td>".$row->in_stock."</td>";
                
                echo "<td><a class='btn btn-success' href='".base_url()."Vehiculo/detalle?id_vehiculo=".$row->id_vehiculo."'>Ingresar</a></td>";
                
                echo "</tr>";
            }
        }
    }

/////--------Busqueda vehiculo por agencia pasando id persona----------------
    public function buscarVehiculoAgencia($id_agencia_registro,$cantidad){
            $this-> verificaLoqueo();
            //print_r($id_agencia_registro);
            $data['id']=$id_agencia_registro;
            $data['cantidad']=$cantidad;    
            $data['vista'] = 'v_busqueda_registro_agencia';
            $this->salida($data);
    }

    public function searchRegistro()
    {
        $this-> verificaLoqueo();
        $this->load->model('BusquedaModel');

        $campo = $this->input->get('campo');
        $id = $this->input->get('id');
        $cantidad=$this->input->get('cantidad');

        $dato  = strtoupper($this->input->get('name'));

        $datos = $this->BusquedaModel->getRegistro($campo,$dato);

        if(count($datos)==0)
        {
            echo "<tr>";
            echo "<td colspan='5'>Registros no encontrados</td>";
            echo "</tr>";
        }else{
       

            echo "<thead>";
            echo "<th>NOMBRE</th>";
            echo "<th>MARCA</th>";
            echo "<th>TIPO</th>";
            echo "<th>Elige</th>";
            echo "</thead>";
            foreach ($datos as $row) {
                echo "<tr >";
                echo "<td>".$row->nombre."</td>";
                echo "<td>".$row->marca."</td>";
                echo "<td>".$row->tipo."</td>";
                //echo "<td id='id_agencia_registro'>".$id."</td>";
                echo "<td><a class='btn btn-success' href='".base_url()."Detalle/dato-registro/".$row->id_vehiculo."/".$id."/".$cantidad."'>Ingresar</a></td>";
                echo "</tr>";
            }
        }
    }


//////////////////////---------------


}