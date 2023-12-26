<?php 
class marcas_model extends CI_model {

    protected $table="marcas";
    protected $pk= "marca_id";
    protected $default_order=array("campo"=>"nombre","orden"=>"ASC");//parametros para generar o filtrar el listado con ese roden en particular
    protected $order=array();

    public function set_order($campo,$orden="ASC"){
        $this->order["campo"]=$campo;
        $this->order["orden"]=$orden;
    }

    public function default_select(){
        $this->db->select($this->table.".*");
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
    public function borrar_marca($id=false){
        $this->db->where($this->pk,$id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
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
        return $this->guardar_marcas($datos);
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