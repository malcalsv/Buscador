<?php
    $x = array("precio"=>"5,500");
    print_r(floatval(str_replace(',','',$x["precio"])));

    if (floatval(str_replace(',','',$x["precio"]))>500)
       echo "es mayor";
    else
       echo "es menor";
?>