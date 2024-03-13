<?php

namespace Utils\Templates;


function loadTemplate($template){
    global $title, $message, $type, $carrera_id, $carrera_nombre;
    $viewFile = 'views/templates/' . $template;
    include $viewFile;
}
