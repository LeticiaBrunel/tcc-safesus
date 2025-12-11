<?php

class FileController{
    static public function validarImagemPngJpj($diretorio, $aleatorio, $novaLargura, $novaAltura, $largura, $altura, $atributo){
        $info = getimagesize($_FILES[$atributo]["tmp_name"]);
        if ($info['mime'] == 'image/png') {
            // Processar imagem PNG
            $rota = $diretorio . "/" . $aleatorio . ".png";
            $origem = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
            $destino = imagecreatetruecolor($novaLargura, $novaAltura);
            imagealphablending($destino, false);
            imagesavealpha($destino, true);
            $transparente = imagecolorallocatealpha($destino, 0, 0, 0, 127);
            imagefill($destino, 0, 0, $transparente);
            imagecopyresampled($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            imagepng($destino, $rota);
        } elseif ($info['mime'] == 'image/jpeg') {
            // Processar imagem JPG
            $rota = $diretorio . "/" . $aleatorio . ".jpg";
            $origem = imagecreatefromjpeg($_FILES[$atributo]["tmp_name"]);
            $destino = imagecreatetruecolor($novaLargura, $novaAltura);
            imagecopyresampled($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
            imagejpeg($destino, $rota);
        } else {
            // Tipo de imagem inválido
            echo '<br><div class="alert alert-danger">"Tipo de imagem não suportado."</div>';
            exit;
        }
        return $rota;
    }
}

