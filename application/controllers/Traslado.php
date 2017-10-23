<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Traslado extends CI_Controller {

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
        $data['controlador']= 'Traslado';
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
    function trasladar(){
        $this->verifica_logueo();
        $this->_viewOutPut('trasladarCrud');
    }
    function trasladarCrud() {
        try {
            $this->verifica_logueo();
            $crud = new grocery_CRUD();
            $crud->set_subject('Traslado');
            $crud->set_table('traslado');
            $crud->display_as('id_reserva','Reserva');
            $crud->display_as('costo_hora','Costo Hora (Bs.)');
            $crud->set_relation('id_reserva','reserva','{nombre}---DESTINO:--->>{destino}');
            $crud->unset_print();
            $crud->unset_export();
            $output = $crud->render();
            $this->__salida_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }



     public function _viewSalida($vista,$data)
    {
        $this->load->model('Autenticacion_model');
        $this->Autenticacion_model->isLoggedIn();

        $data['vista']   = $vista;
        $this->load->view('plantilla/header');
        $this->load->view($data['vista'],$data);
        $this->load->view('plantilla/footer');
    }

    public function lista_traslado()
    {
        $this->verifica_logueo();
        $this->load->model('Traslado_model');
        
        $lista = $this->Traslado_model->get_lista_traslado();
        
        $list = $this->Traslado_model->get_lista_traslado_by_id($_SESSION['id_persona']);
        $i=1;
        $id=0;
        $tiempo=0;
        $cad =""; 

        if($_SESSION['id_cargo']==1){
            foreach($lista as $d){



                $cad .= "<tr>";
                $cad .= "    <td>$i</td>";
                $cad .= "    <td>".$d->proyecto."</td>";
                $cad .= "    <td>".$d->origen."</td>";
                $cad .= "    <td>".$d->destino."</td>";
                $cad .= "    <td>".$d->fecha_inicio_ida."</td>";
                $cad .= "    <td>".$d->fecha_fin_vuelta."</td>";
                if($d->estado==1){
                    $cad .= "    <td>EN PROCESO</td>";
                }else{
                    $cad .= "    <td>TERMINADO</td>";
                }
                $cad .= "     <td>";
                $cad .= "        <button class='btn btn-block btn-linkedin' disabled><i class='glyphicon glyphicon-edit' ></i>   Pagar</button>";
                $cad .= "     </td>";
                 $cad .= "     <td>";
                $cad .= "        <a href='".base_url()."Traslado/informe?id_traslado=".$d->id_traslado."' '>";
                $cad .= "        <button class='btn btn-block btn-success'><i class='glyphicon glyphicon-edit'></i>   Ver</button>";
                $cad .= "        </a>";
                $cad .= "     </td>";
                
                $cad .= "</tr>";
                $i++;
            }
        }
        if($_SESSION['id_cargo']==2){
            foreach($lista as $d){



                $cad .= "<tr>";
                $cad .= "    <td>$i</td>";
                $cad .= "    <td>".$d->proyecto."</td>";
                $cad .= "    <td>".$d->origen."</td>";
                $cad .= "    <td>".$d->destino."</td>";
                $cad .= "    <td>".$d->fecha_inicio_ida."</td>";
                $cad .= "    <td>".$d->fecha_fin_vuelta."</td>";
                if($d->estado==1){
                    $cad .= "    <td>EN PROCESO</td>";
                }else{
                    $cad .= "    <td>TERMINADO</td>";
                }
                $id=$d->id_traslado;
                $tiempo=$d->tiempo;
                $costo_hora=$d->costo_hora;

                //print_r($tiempo);   
                $cad .= "    <td> Bs." .$this->costo_total($id,$tiempo,$costo_hora). "</td>";

                $cad .= "     <td>";
                $cad .= "        <a href='".base_url()."Traslado/pago_traslado?id_traslado=".$d->id_traslado."&costo=".$this->costo_total($id,$tiempo,$costo_hora)." ' '>";
                $cad .= "        <button class='btn btn-block btn-linkedin'><i class='glyphicon glyphicon-edit'></i>   Pagar</button>";
                $cad .= "     </td>";
                $cad .= "     <td>";
                $cad .= "        <a href='".base_url()."Traslado/informe?id_traslado=".$d->id_traslado."&tiempo=".$tiempo."&costo_hora=".$costo_hora."' ' target='_blank'>";
                $cad .= "        <button class='btn btn-block btn-success'><i class='glyphicon glyphicon-edit'></i>   Ver</button>";
                $cad .= "        </a>";
                $cad .= "     </td>";
                

                $cad .= "</tr>";
                $i++;
            }
        }
        $data['lista'] = $cad;
        $this->_viewSalida('v_lista_traslado',$data);
    }

    public function costo_total($id_traslado,$tiempo,$costo_hora)
    {
        $this->verifica_logueo();
        $this->load->model('Traslado_model');
        $list=$this->Traslado_model->get_maquinas_registradas($id_traslado);
        $num=$this->Traslado_model->count_registros_maquinas($id_traslado);
        
        $peso=0;
        foreach($list as $d){
            $peso=$peso+$d->peso_unitario;
        }
        //$total=($peso/$num*2)*$tiempo*$costo_hora;
        $total=($tiempo*2)*$costo_hora;
        
        return $total;

    }


    public function pago_traslado()
    {
        $this->verifica_logueo();
        $this->load->model('Traslado_model');
        $id_traslado = $this->input->get('id_traslado');
        $data['traslado'] =$this->Traslado_model->get_traslado_by_id($id_traslado);
        $data['costo'] =$costo = $this->input->get('costo');
        $this->_viewSalida('v_pago',$data);

    }

        //------------------------------------------------
    public function ajax_list()
    {
        $this->load->model('Traslado_model');
        $id_traslado = $_GET['id_traslado'];
        $list = $this->Traslado_model->get_registros_pagos($id_traslado);
        $data = array();
        $no = $_POST['start'];
        $i=0;
        foreach ($list as $p) {
            $i++;
            $no++;
            $row = array();
            $row[] = $i;
            $row[] = $p->fecha;
            $row[] = $p->monto;
//add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_pago('."'".$p->id_pago_traslado."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
                  ';
        
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Traslado_model->count_all(),
                        "recordsFiltered" => $this->Traslado_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

     public function ajax_add()
    {
        $this->load->model('Traslado_model');

        $data = array(
            'id_traslado' => $this->input->post('id_traslado'),
            'monto' => $this->input->post('monto'),
                    );
         $insert = $this->Traslado_model->save($data);
        echo json_encode(array("status" => TRUE));
    }


    
    public function ajax_update()
    {
        $this->load->model('Traslado_model');

        $data = array(
            'id_traslado' => $this->input->post('id_traslado'),
            'monto' => $this->input->post('monto'),
            );
        $this->Traslado_model->update(array('id_pago_traslado' => $this->input->post('id_pago_traslado')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->load->model('Traslado_model');

        $this->Traslado_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    { 

        $this->load->model('Traslado_model');
        $data = $this->Traslado_model->get_by_id_pago($id);
        echo json_encode($data);
    }



/*--------------Generar PDF detalle

        $this->verifica_logueo();
        $this->load->model('Traslado_model');
        $list=$this->Traslado_model->get_maquinas_registradas($id_traslado);
        $list=$this->Traslado_model->get_maquinas_registradas($id_traslado);
        $num=$this->Traslado_model->count_registros_maquinas($id_traslado);
        $num=$num+1;
        $peso=0;
        $costo_hora=0;
        $tiempo=0;
        foreach($list as $d){
            $peso=$peso+$d->peso_unitario;
            $costo_hora=$d->costo_hora;
            $tiempo=$d->tiempo;
        }
        $total=($peso/(2*$num))*$tiempo*$costo_hora;
        
        return $total;

------------*/
    public function informe()
    {
        $this->verifica_logueo();
        $this->load->model('Traslado_model');
        $this->load->library('Pdf_detalle_pago');

        $id_traslado= $this->input->get('id_traslado');
        $costo_hora= $this->input->get('costo_hora');

        $tiempo= $this->input->get('tiempo');

        $list=$this->Traslado_model->get_maquinas_registradas($id_traslado);
        $data=$this->Traslado_model->get_traslado_by_id($id_traslado);
        $num=$this->Traslado_model->count_registros_maquinas($id_traslado);


        //print_r($datos); 
        $fecha = date("d") . "/" . date("m") . "/" . date("Y");
        $nombre_persona='asdv';
        $hash  = $fecha;

        $datos_pie = array('fecha'=>$fecha,
                            'hash'=>$hash,
                            
        );

        $pdf = new Pdf_detalle_pago('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setDataHeader($datos_pie);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('NEXTEC');
        $pdf->SetTitle('Rendicion');
        $pdf->SetSubject('Rendicion');
        $pdf->SetKeywords('Rendicion');


        $pdf->SetMargins(10, 10, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->AddPage('L',array(215.9,279.4));
        //-------TITULO DATOS DEL GASTO
        $pdf->SetFont('helveticaB', '', 18);
        $pdf->SetTextColor(0,0,0);
        $pdf->Text(45, 20, 'ANALISIS DE MOVILIZACIÓN Y DESMOVILIZACIÓN DE EQUIPOS' );
        //-------CONTENIDO DATOS GASTO


        $pdf->Ln(11);
        $pdf->SetFillColor(100,200,255);
        $pdf->SetFont('helveticaB', '', 8);
        $pdf->SetX(25);
        $pdf->Cell(8,5,'Nro.',1,0,'C',1);
        $pdf->Cell(70,5,'DESCRIPCION DEL EQUIPO',1,0,'C',1);
        $pdf->Cell(60,5,'CANTIDAD',1,0,'L',1);
        $pdf->Cell(30,5,'PESO UNIT.(TN)',1,0,'C',1);
        $pdf->Cell(60,5,'OBSERVACIÓN',1,0,'C',1);
        $suma=0;
        $i=0;
        $n=1;
        $y=31;
        $total=0;
        foreach ($list as $row) {
            $pdf->SetFillColor(255,255,255);
            $pdf->SetFont('times', '', 9.5);


            $pdf->SetY($y+=5);
            $pdf->SetX(25);
            $pdf->Cell(8,5,$n,1,0,'C',1);
            $pdf->Cell(70,5,$row->maquina,1,0,'L',1);
            $pdf->Cell(60,5,'1',1,0,'L',1);
            $pdf->Cell(30,5,$row->peso_unitario,1,0,'L',1);
            $pdf->Cell(60,5,$row->movilizacion,1,0,'L',1);
            $suma=$suma+$row->peso_unitario;
            $i++;
            $n++;

        }//Find e foreach
        $pdf->Ln(7);
        $pdf->SetX(75);
        $pdf->SetFillColor(100,200,255);
        $pdf->Cell(88,5,'PESO TOTAL DE LA MAQUINARIA A MOVILIZAR :',1,0,'R',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(30,5,$suma ,1,1,'C',1);


        $pdf->Ln(5);
        $pdf->SetFillColor(255,20,52);
        $pdf->SetFont('helveticaB', '', 8);
        $pdf->SetX(25);
        $pdf->Cell(8,5,'Nro.',1,0,'C',1);
        $pdf->Cell(70,5,'DESCRIPCION',1,0,'C',1);
        $pdf->Cell(40,5,'TIPO VIA',1,0,'L',1);
        $pdf->Cell(30,5,'LONGITUD',1,0,'C',1);
        $pdf->Cell(30,5,'VELOCIDAD',1,0,'C',1);
        $pdf->Cell(30,5,'TIEMPO',1,0,'C',1);
        $pdf->Cell(30,5,'COSTO HORA',1,0,'C',1);


        $f=1;
        foreach ($data as $row) {
            $pdf->SetFillColor(255,255,255);
            $pdf->SetFont('times', '', 9.5);


            $pdf->SetY($y+=22);
            $pdf->SetX(25);
            $pdf->Cell(8,5,$f,1,0,'C',1);
            $pdf->Cell(70,5,$row->origen.' - '. $row->destino,1,0,'L',1);
            $pdf->Cell(40,5,$row->tipo_via,1,0,'L',1);
            $pdf->Cell(30,5,$row->longitud,1,0,'L',1);
            $pdf->Cell(30,5,$row->velocidad,1,0,'L',1);
            $pdf->Cell(30,5,$row->tiempo,1,0,'L',1);
            $pdf->Cell(30,5,$row->costo_hora,1,0,'L',1);
            
            $i++;
            $f++;

        }//Find e foreach

        $pdf->Ln(7);
        $pdf->SetX(75);
        $pdf->SetFillColor(255,20,52);
        $pdf->Cell(88,5,'COSTO TOTAL DE LA MAQUINARIA A MOVILIZAR :',1,0,'R',1);
        $pdf->SetFillColor(255,255,255);
        $pdf->Cell(30,5,($tiempo*2)*$costo_hora ,1,1,'C',1);
        

        $pdf->Text(30, 150, 'Nombre del Proyecto:' );
        $pdf->Text(62, 150, $data[0]->proyecto);



        // $fecha=strftime("%A, %d de %B de %Y - Hrs. %H:%M");
        // $pdf->Text(18, 180, $fecha );        

        $nombre_archivo = utf8_decode($tiempo.'.pdf');
        $pdf->Output($nombre_archivo, 'I');

        $style2 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
        $pdf>Line(85, 262.5, 130, 262.5, $style2);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Text(30, 110,  'firma');


    }



   

    
}