<?php 
class marcas_model extends CI_model {

    protected $table="marcas";
    protected $pk= "marca_id";

    public function default_select(){
        $this->db->select($this->table.".*");
    }


    public function borrar_marca($id=false){
        $this->db->where($this->pk,$id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function listar_marca(){
        $this->db->order_by($this->pk, "ASCE");
        $res=$this->db->get($this->table);
        return $res->result_array();
    }

    public function obtener_por_id($id=false){
        $this->default_select();
        $this->db->where($this->pk,$id);
        return $this->db->get($this->table)->row_array();
        
    }

    public function guardar_marcas($datos=array(),$id=null){
        if($id==null){
            $this->db->insert($this->table,$datos);
            return $this->db->insert_id();
        }else{
            $this->db->where($this->pk,$id);
            $this->db->update($this->table,$datos);
            return $this->db->affected_rows();
        }
    }

    function crear_marcas($datos=array()){
        return $this->guardar($datos);
    }

    public function change_estado($marca_id="",$estado=""){
        $this->db->set($this->pk,$marca_id);
        $this->db->where("estado",$estado);
        $this->db->limit(1);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

}
?>