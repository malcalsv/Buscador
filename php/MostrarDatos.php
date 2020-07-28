<?php
    function MostrarTodos(){
        $data = file_get_contents('../data-1.json');
        $regs = json_decode($data, true);
        
        foreach ($regs as $rows){
           // $rows["Ciudad"];
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
           '<a clsss="valorTexto" href="#">Ver mas...</a>'.
           '</div>'.
           '</div>'.
           '</div>'.
           '</div>';

        }
        return $html;
    }

    echo MostrarTodos();
?>