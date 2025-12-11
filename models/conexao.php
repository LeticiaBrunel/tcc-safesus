<?php
class Conexao {
    
    static public function conectar() {
        $id = mysqli_connect("localhost", "root", "", "triagemhospitalar");

        if (!$id) {
            die("Não foi possível estabelecer uma conexão com o MySQL: " . mysqli_connect_error());
        }

        return $id;
    }
}

