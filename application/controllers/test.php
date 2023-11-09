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

    public function marcas(){
        $this->load->model("marcas_model");
        $lista=$this->marcas_model->listar();
        echo "<pre>";
        print_r($lista);
        $this->marcas_model->set_order("marca_id","DESC");
        $lista=$this->marcas_model->listar();
        print_r($lista);
        echo"<pre>";
    }
}
?>