<?php
    class consulta {
        private $sql;

        function __construct() {
            $this->sql = "";
        }

        function runQuery(){
            require_once("conexion.php");
            return mysqli_query($conexion,$this->sql) or die(mysqli_error($conexion));
        }

        function setSql($peticion){
            $this->sql = $peticion;
        }

        function getSql(){
            return $this->sql;
        }

        function querySelect($field,$table,$condition){
            $this->sql = "SELECT ".$field." FROM ".$table." WHERE ".$condition;
        }
    }
?>