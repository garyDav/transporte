<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reserva_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_lista_reserva($id_persona)
    {
        $this->db->select('*');
        $this->db->from('reserva');
        $this->db->where('id_persona', $id_persona);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_by_id($id)
    {
        $this->db->from('reserva');
        $this->db->where('id_reserva',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('reserva', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('reserva', $data, $where);
        return $this->db->affected_rows();
    }
}
