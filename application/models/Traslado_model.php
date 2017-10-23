<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Traslado_model extends CI_Model {

/*
        CREATE VIEW v_registro_traslados AS
        SELECT  r.id_reserva, r.id_persona, r.nombre as proyecto, t.id_traslado, t.origen,t.destino,t.fecha_inicio_ida, t.fecha_fin_ida,t.tipo_via,t.longitud,t.velocidad, t.fecha_inicio_vuelta,t.fecha_fin_vuelta,t.estado,t.costo_hora,t.tiempo
        FROM traslado  t, reserva r 
        WHERE t.id_reserva=r.id_reserva


        CREATE VIEW v_maquinas_asignadas AS
        SELECT  t.id_traslado,m.peso_unitario,m.nombre as maquina,tp.nombre as movilizacion
        FROM traslado  t, reserva r,maquinaria_reserva mr, maquinaria m, persona p,tipo_movilizacion tp
        WHERE t.id_reserva=r.id_reserva
        AND   p.id_persona=r.id_persona
        AND   mr.id_reserva=r.id_reserva
        AND   mr.id_maquinaria=m.id_maquinaria
        AND   m.id_tipo_movilizacion=tp.id_tipo_movilizacion
        
*/

    var $table = 'pago_traslado';
    var $column = array('id_pago_traslado','id_traslado','monto','fecha','estado');
    var $order = array('id_pago_traslado' => 'desc'); // default order


    public function __construct()
    {
        parent::__construct();
    }

    public function get_lista_traslado()
    {
        $this->db->select('*');
        $this->db->from('v_registro_traslados');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_lista_traslado_by_id($id_persona)
    {
        $this->db->select('*');
        $this->db->from('v_registro_traslados');
        $this->db->where('id_persona',$id_persona);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_traslado_by_id($id_traslado)
    {
        $this->db->select('*');
        $this->db->from('v_registro_traslados');
        $this->db->where('id_traslado',$id_traslado);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_registros_pagos($id_traslado)
    {
        $this->db->select('*');
        $this->db->from('pago_traslado');
        $this->db->where('id_traslado',$id_traslado);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_maquinas_registradas($id_traslado)
    {
        $this->db->select('*');
        $this->db->from('v_maquinas_asignadas');
        $this->db->where('id_traslado',$id_traslado);
        $query = $this->db->get();
        return $query->result();
    }


    public function count_registros_maquinas($id_traslado)
    {
        $this->db->from('v_maquinas_asignadas');
        $this->db->where('id_traslado',$id_traslado);
        $query = $this->db->get();
        return $query->num_rows();
    }


    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND. 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $column[$i] = $item; // set column array variable to order processing
            $i++;
        }
        
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id_pago($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_pago_traslado',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_pago_traslado', $id);
        $this->db->delete($this->table);
    }

}
