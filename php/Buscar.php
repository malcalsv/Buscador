<?php
    
    $ciudad = $_POST['CiudadS'];
    $tipo =   $_POST['TipoS'];
    $preciom = intval($_POST['PrecioMin']);
    $preciomax = intval($_POST['PrecioMax']);  
    
/*
    $ciudad = "Orlando";
    $tipo =   "Casa";
    $preciom = 200;
    $preciomax = 30000;  */

    $data = file_get_contents('../data-1.json');
    $regs = json_decode($data, true); 


    //Valida si se han pedido todas las ciudades y tipo de propiedad
    if ($ciudad !== "-1" && $tipo !=="-1"){
       $filtrados = array_filter($regs, function ($ft) use($ciudad,$tipo,$preciom,$preciomax){
            if ($ft["Ciudad"] ===$ciudad && $ft["Tipo"]===$tipo && floatval(str_replace('$','',str_replace(',','',$ft["Precio"])))> $preciom and floatval(str_replace('$','',str_replace(',','',$ft["Precio"])))<$preciomax )
                return true;
            else
               return false; 
       }); 
    }
    elseif($ciudad !== "-1" && $tipo =="-1" ){
        $filtrados = array_filter($regs, function ($ft) use($ciudad,$preciom,$preciomax){
            if ($ft["Ciudad"] ===$ciudad  && floatval(str_replace('$','',str_replace(',','',$ft["Precio"])))> $preciom and floatval(str_replace('$','',str_replace(',','',$ft["Precio"])))<$preciomax )
                return true;
            else
               return false; 
       }); 
    }
    elseif($ciudad =="-1" && $tipo !== "-1"){
        $filtrados = array_filter($regs, function ($ft) use($ciudad,$tipo,$preciom,$preciomax){
            if ($ft["Tipo"]===$tipo && floatval(str_replace('$','',str_replace(',','',$ft["Precio"])))> $preciom and floatval(str_replace('$','',str_replace(',','',$ft["Precio"])))<$preciomax )
                return true;
            else
               return false; 
       }); 
    }

    //var_dump($filtrados);
    // regresa las propiedades
     foreach ($filtrados as $rows){
        $html .= '<div class="row">'.
                 '<div class="col s12 m12">'.
                 '<div class="itemMostrado card">'.
                 '<img src="img/home.jpg" alt="">'.
                 '<div class="card-stacked" id="Items">'.
                 '<p class="black-text">Direccion: <span class="valorTexto">'.$rows["Direccion"].'</span></p>'. 
                 '<p class="black-text">Ciudad: <span class="valorTexto">'.$rows["Ciudad"].'</span></p>'. 
                 '<p class="black-text">Telefono: <span class="valorTexto">'.$rows["Telefono"].'</span></p>'. 
                 '<p class="black-text">Codigo Postal: <span class="valorTexto">'.$rows["Codigo_Postal"].'</span></p>'. 
                 '<p class="black-text">Tipo: <span class="valorTexto">'.$rows["Tipo"].'</span></p>'.
                 '<p class="black-text" >Precio: <span class="precioTexto">'.$rows["Precio"].'</span></p>'.
                 '<div class="card-action right">'.
                 '<a href="#">Ver mas...</a>'.
                 '</div>'.
                 '</div>'.
                 '</div>'.
                 '</div>';

    }
    echo $html; 
?>