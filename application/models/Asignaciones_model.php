<?php


class Asignaciones_model extends CI_Model {
/*
        CREATE VIEW v_registro_maquinas AS
        SELECT  mr.id_maquinaria_reserva, mr.fecha,r.id_reserva, m.nombre as maquina, m.estado, r.nombre as proyecto
        FROM maquinaria_reserva mr, maquinaria m, reserva r 
        WHERE mr.id_maquinaria=m.id_maquinaria
        AND mr.id_reserva=r.id_reserva
*/


    var $table = 'maquinaria_reserva';
    var $column = array('id_maquinaria_reserva','id_maquinaria','id_reserva');
    var $order = array('id_maquinaria_reserva' => 'desc'); // default order

    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_reserva($id_reserva)
    {
        $this->db->select('*');
        $this->db->from('reserva');
        $this->db->where('id_reserva',$id_reserva);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_registros_maquinarias($id_reserva)
    {   
        $this->db->from('v_registro_maquinas');
        $this->db->where('id_reserva',$id_reserva);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_maquinas()
    {
        $this->db->select('*');
        $this->db->from('maquinaria');
        $this->db->where('estado','1');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_proyecto_tarea($id_reserva)
    {
        $this->db->select('*');
        $this->db->from('maquinaria_reserva');
        $this->db->where('id_reserva',$id_reserva);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_detalle_by_id_tarea($id_tarea,$fecha)
    {
        $this->db->select('*');
        $this->db->from('detalle_tarea');
        $this->db->where('id_tarea',$id_tarea);
        $this->db->where('fecha',$fecha);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function save($data)
    {
        $this->db->insert('detalle_tarea', $data);
        return $this->db->insert_id();
    }

    public function get_detalle_tarea_by_id($id_tarea,$fecha)
    {
        $this->db->from('detalle_tarea');
        $this->db->where('id_tarea',$id_tarea);
        $this->db->where('fecha',$fecha);
        $query = $this->db->get();

        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update('detalle_tarea', $data, $where);
        return $this->db->affected_rows();
    }

    public function get_proyecto()
    {
        $this->db->select('*');
        $this->db->from('proyecto');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_registro_proyecto($id_proyecto)
    {
        $this->db->select('*');
        $this->db->from('proyecto');
        $this->db->where('id_proyecto',$id_proyecto);
        $query = $this->db->get();
        return $query->result();
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

    function count_filtered()
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

    public function save_tarea($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id_maquina($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_maquinaria_reserva',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function update_tarea($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id_maquina($id)
    {
        $this->db->where('id_maquinaria_reserva', $id);
        $this->db->delete($this->table);
    }

}