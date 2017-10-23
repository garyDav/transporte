<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Autenticacion_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function login($usuario, $password)
    {
        $usuario  = sha1($usuario);
        $password = sha1($password);
        $sql = "SELECT p.id_persona,p.nombre,p.paterno,p.materno,p.foto,pc.id_cargo,pc.id_persona_cargo
                  FROM persona_cargo pc,persona p
                 WHERE pc.id_persona = p.id_persona
                   AND pc.estado = 1
                   AND pc.usuario = '$usuario'
                   AND pc.password = '$password' ";

        $query = $this->db->query($sql);

        if($query->num_rows() == 1){
            $id_persona_cargo = 0;
            foreach ($query->result() as $row){
                $id_persona_cargo = $row->id_persona_cargo;
                $id_persona  = $row->id_persona;
                $id_cargo    = $row->id_cargo;
                $nombre      = $row->nombre;
                $nombre_completo = $row->nombre.' '.$row->paterno.' '.$row->materno;
                $nick = $row->nombre.' '.$row->paterno;
                $foto=$row->foto;
            }


            $data = array(
                    'id_persona'      => $id_persona,
                    'id_cargo'        => $id_cargo,
                    'nombre'          => $nombre,
                    'nombre_completo' => $nombre_completo,
                    'nick'            => $nick,
                    'foto'            => $foto,
                    
                    'logged_in'       => TRUE
            );

            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

    public function isLoggedIn(){

        $is_logged_in = $this->session->userdata('logged_in');

        if(!isset($is_logged_in) || $is_logged_in!==TRUE)
        {
            redirect('/');
            exit;
        }
    }
}
