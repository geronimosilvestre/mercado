<?php 
class roll_model extends CI_model{
    protected $pk="roll_id";
    protected $table="roles";
    
    protected $default_order=array("campo"=>"nombre","orden"=>"ASC");//parametros para generar o filtrar el listado con ese roden en particular
    protected $order=array();

    public function default_select(){
        $this->db->select($this->table.".*");
    }

    public function set_order($campo,$orden="ASC"){
        $this->order["campo"]=$campo;
        $this->order["orden"]=$orden;
    }

    public function listar () {
        $this->default_select();
        if($this->order){
            $orden=$this->order["orden"];
            $campo=$this->order["campo"];
            
        }else{
            $campo=$this->default_order["campo"];
            $orden=$this->default_order["orden"];
        }
        $this->db->order_by($campo,$orden);
        return $this->db->get($this->table)->result_array();
    }

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