<?php


class BusquedaModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    /*
        CREATE VIEW v_registro_reservas AS
        SELECT  r.id_reserva,r.nombre as proyecto,r.fecha, p.id_persona, CONCAT(p.nombre,' ',p.paterno,' ',p.materno) as cliente
        FROM reserva r, persona p 
        WHERE p.id_persona=r.id_persona

     */



    public function getRegistro($campo,$dato)
    {
        $this->db->select('*');
        $this->db->from('v_registro_reservas');
        $this->db->like($campo, $dato, 'both');
        $query = $this->db->get();
        return $query->result();
    }






    public function getRegistroById($id_vehiculo)
    {
        $this->db->select('*');
        $this->db->from('v_registro_vehiculo');
        $this->db->where('id_vehiculo', $id_vehiculo);
        $query = $this->db->get();
        return $query->row(0);
    }
    function getDatatables()
    {
        /*
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        */
        $this->db->from("v_registro");
        $query = $this->db->get();
        return $query->result();
    }

}