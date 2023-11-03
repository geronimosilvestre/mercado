<?php
class test extends CI_controller {
    public function index(){
        /*$this->load->model("marcas_model");
        $res=$this->marcas_model->obtener_por_id(1);
        print_r($res);*/

        $this->load->model("marcas_model");
        $datos=array();
        $datos["nombre"]="Coca-Cola";
        $id=$this->marcas_model->crear($datos);
        $res=$this->marcas_model->obtener_por_id($id);
        print_r($res);
        $datos["nombre"]="pepsi";
        $op=$this->marcas_model->guardar($datos,$id);    
        if($op){
            echo "actualizado coca->pepsi<br>";
        }
        $res=$this->marcas_model->obtener_por_id($id);
        print_r($res);

        $op=$this->marcas_model->borrar($id);
        if($op){
            echo "se borro";
        }

    }
}
?>