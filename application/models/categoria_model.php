<?php 
class categorias_model extends CI_model{
    protected $table="categorias";
    protected $pk="categoria_id";
    protected $nombre="nombre";
    protected $nombrecorto="nombrecorto";
    protected $orden="orden";
    protected $estado="estado";

    public function default_select (){
        $this->db->select($this->table.".*");
    }

    public function guardar_categoria ($datos=array(),$id=null){
        if($id==null){
            $this->db->insert($this->table,$datos);
            return $this->db->insert_id();
        }else{
            $this->db->where($this->pk,$id);
            $this->db->update($this->table,$datos);
            return $this->db->affected_rows();
        }
    }

    function crear_categoria ($datos=array()){
        return $this->guardar($datos);
    }
    

public function eliminar_categoria ($id=""){
    $this->db->where($this->pk,$id);
    $this->db->limit(1);
    $this->db->delete($this->table);
    return $this->db->affected_rows();
}

public function listar_categorias (){
    $this->db->order_by($this->pk, "ASCE");
    $res=$this->db->get($this->table);
    return $res->result_array();
}

function obtener_por_id($id=false){
    $this->default_select();
    $this->db->where($this->pk,$id);
    return $this->db->get($this->table)->row_array();
}

public function change_orden($id="",$orden=""){
    $this->db->where($this->pk,$id);
    $this->db->limit(1);
    $this->db->set($this->orden,$orden);
    $this->db->update($this->table);
    return $this->db->affected_rows();
    }

    public function change_estado($id="",$estado=""){
        $this->db->where($this->pk,$id);
        $this->db->limit(1);
        $this->db->set($this->estado,$estado);
        $this->db->update($this->table);
        return $this->db->affected_rows();
        }

}
?>