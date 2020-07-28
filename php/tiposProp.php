<?php
   
   //Busca los tipos de propiedas dentro del archivo JSON sin repetirse
   function retTipos(){
        $data = file_get_contents('../data-1.json');
        $regs = json_decode($data, true);
        
        foreach ($regs as $rows){
            $Tipos[] = $rows["Tipo"];
        }
        
        $e = 0;      
        for ($i=0; $i < count($Tipos);$i++){
        $nTipo = $Tipos[$i];
            if ($i == 0){
                $cfTipos[] = $nTipo;
            }
            else
            {
                if (in_array($nTipo,$cfTipos,true)){
                    $e ++;
                }
                else{
                    $cfTipos[] = $nTipo;
                }
            }
        }

        //print($NC);
        return $cfTipos;
    }

    
    
     //Regresa las opciones para llenar el select
    function llenarTipos()
    {
        $Cid = retTipos();
        $html = '<option value ="-1">'.'Elige una Tipo</option>';
        for ($i=0; $i< count($Cid);$i++)
        {
          $html .=  '<option value= "'.$Cid[$i].'">'.$Cid[$i].'</option>';
        }
        return $html;
    }
    
    echo llenarTipos();
?>