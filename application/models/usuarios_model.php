<?php 
class usuarios_model extends CI_model{

    protected $pk="usuario_id";
    protected $table="usuarios";
    protected $usuario="usuario";
    protected $password="password"
    protected $email="email";
    protected $roll="roll_id";
    protected $estado="estado";
    protected $ultlogin="ultlogin";

    public function defaul_select(){
        $this->db->select($this->table.".*");
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


    public function eliminar_usuario ($id=""){
        $this->db->where($this->pk,$id);
        $this->db->limit(1);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    
    public function listar_usuario (){
        $this->db->order_by($this->pk, "ASCE");
        return $this->db->get($this->table)->result_array();
    }

    public function actualiza_login ($id=""){
        $this->db->set($this->ultlogin,"now()",false);
        $this->db->where($this->pk,$id);
        $this->db->limit(1);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    function obtener_por_id($id=false){
        $this->default_select();
        $this->db->where($this->pk,$id);
        return $this->db->get($this->table)->row_array();
    }


    function check_usuario($usuario=""){
        $this->db->select($this->pk);
        $this->db->where($this->usuario,$usuario);
        $this->db->limit(1);
        $res=$this->db->get($this->table);
        if($res->num_rows()){
            return true;
        }else{
            return false;
        }
    }

    public function check_rol ($usuario_id=""){
        $this->db->select($this->roll);
        $this->db->where($this->pk,$usuario_id);
        $this->db->limit(1);
        $temp=$this->db->get($this->table)->row_array();
        return $temp["roll_id"];
    }

    public function change_password($usuario="",$passwordnew=""){
        $this->db->set($this->password,$passwordnew);
        $this->db->where($this->usuario,$usuario);
        $this->db->limit(1);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function actualiza_pass ($usuario_id="",$nueva_pass=""){
        $this->db->where($this->pk, $usuario_id );
        $this->db->limit(1);
        $this->db->set($this->password, $nueva_pass);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function return_password($usuario=""){
        $this->db->select($this->password);
        $this->db->where($this->usuario,$usuario);
        $this->db->limit(1);
        $res=$this->db->get($this->table);
        $array=$res->row_array();
        return $array["password"];
    }

    public function change_roll($id="",$roll=""){
        $this->db->where($this->pk,$id);
        $this->db->limit(1);
        $this->db->set($this->roll,$roll);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function change_estado ($id="",$estado=""){
        $this->db->where($this->pk,$id);
        $this->db->limit(1);
        $this->db->set($this->estado,$estado);
        $this->db->update($this->table);
        return $this->db->affected_rows();
        }
}

?>