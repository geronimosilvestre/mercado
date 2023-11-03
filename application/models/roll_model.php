<?php 
class roll_model extends CI_model{
    protected $pk="roll_id";
    protected $table="roles"

    public function guardar_roll ($datos=array(),$id=null){
        if($id==null){
            $this->db->insert($this->table,$datos);
            return $this->db->insert_id();
        }else{
            $this->db->where($this->pk,$id);
            $this->db->update($this->table,$datos);
            return $this->db->affected_rows();
        }
    }
    function crear_roll($datos=array()){
        return $this->guardar($datos);
    }

/*  public function eliminar_roll ($id=""){
        $this->db->where($this->pk,$id);
        $this->db->limit(1);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }   */

public function listar_roll (){
    $this->db->order_by($this->pk, "ASCE");
    $res=$this->db->get($this->table);
    return $res->result_array();
}


}
?>