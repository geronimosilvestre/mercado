<?php 
class productos_model extends CI_model {
    protected $pk="producto_id";
    protected $table="productos";
    protected $titulo="titulo";
    protected $descripcion="descripcion";
    protected $precio="precio";
    protected $marcaid="marca_id";

    public function default_select(){
        $this->db->select($this->table.".*");
    }


    public function guardar_producto($datos=array(),$id=null){
        if($id==null){
            $this->db->insert($this->table,$datos);
            return $this->db->insert_id();
        }else{
            $this->db->where($this->pk,$id);
            $this->db->update($this->table,$datos);
            return $this->db->affected_rows();
        }
    }
    function crear_producto($datos=array()){
        return $this->guardar($datos);
    }

public function eliminar_producto ($id=""){
    $this->db->where($this->pk,$id);
    $this->db->limit(1);
    $this->db->delete($this->table);
    return $this->db->affected_rows();
}

public function listar_producto (){
    $this->db->order_by($this->pk, "ASCE");
    $res=$this->db->get($this->table);
    return $res->result_array();
}

public function obtener_por_id($id=false){
    $this->default_select();
    $this->db->where($this->pk,$id);
    return $this->db->get($this->table)->row_array();
    
}

function check_producto($titulo=""){
    $this->db->select($this->pk);
    $this->db->where($this->titulo,$titulo);
    $this->db->limit(1);
    $res=$this->db->get($this->table);
    if($res->num_rows()){
        return true;
    }else{
        return false;
    }
}

public function change_titulo($id="",$titulonew=""){
    $this->db->set($this->titulo,$titulonew);
    $this->db->where($this->pk,$id);
    $this->db->limit(1);
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

function obtener_por_titulo($titulo=false){
    $this->db->where($this->titulo,$titulo);
    $this->db->limit(1);
    $res=$this->db->get($this->table);
    return $res->row_array();
}

}
?>