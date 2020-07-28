<?php
   
   //Busca las ciudades dentro del archivo JSON sin repetirse
   function RetCiudades(){
        $data = file_get_contents('../data-1.json');
        $regs = json_decode($data, true);
        
        foreach ($regs as $rows){
            $Ciudades[] = $rows["Ciudad"];
        }
        
        //$CF[] = array("vacio");  // Ciudades Filtradas
        $e = 0;      
        for ($i=0; $i < count($Ciudades);$i++){
        $NC = $Ciudades[$i];
            if ($i == 0){
                $CF[] = $NC;
            }
            else
            {
                if (in_array($NC,$CF,true)){
                    $e ++;
                }
                else{
                    $CF[] = $NC;
                }
            }
        }

        //print($NC);
        return $CF;
    }

    
    //Regresa las opciones para llenar el select
    function LlenarCiudades()
    {
        $Cid = RetCiudades();
        $html = '<option value ="-1">'.'Todas las ciudades</option>';
        for ($i=0; $i< count($Cid);$i++)
        {
          $html .=  '<option value= "'.$Cid[$i].'">'.$Cid[$i].'</option>';
        }
        return $html;
    }
    
    echo LlenarCiudades();
?>