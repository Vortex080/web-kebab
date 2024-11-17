<?php

$dr = $_SERVER['DOCUMENT_ROOT'];
$upload_dir = $dr . '/assets/img/';

$count = count($_FILES); // Contar cuántos archivos se enviaron

// Iterar sobre los archivos enviados
for ($i = 1; $i <= $count; $i++) {
    // Verificar si el archivo tiene contenido (evitar procesar el último archivo vacío)
    if (!empty($_FILES['fichero' . $i]['name'])) {
        // Obtener el nombre enviado para cada archivo
        $nombre = $_GET['name'];

        // Obtener la extensión del archivo actual
        $extension = pathinfo($_FILES['fichero' . $i]['name'], PATHINFO_EXTENSION);

        // Crear el nombre final del archivo
        $file_name = $nombre . '.' . $extension;

        // Definir la ruta de subida
        $upload = $upload_dir . $file_name;

        // Subir el archivo al servidor
        if (move_uploaded_file($_FILES['fichero' . $i]['tmp_name'], $upload)) {
            echo "Fichero {$file_name} válido y se subió correctamente.<br>";
            header('Location: ?admin=kebab');
        } else {
            echo "Fichero {$file_name} no válido.<br>";
        }
    } else {
        echo "El archivo {$i} está vacío y no se procesará.<br>";
    }
}
