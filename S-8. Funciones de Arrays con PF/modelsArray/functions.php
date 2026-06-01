<?php
function showDepure($array){
    print_r($array);
}

function showFormat($array){
    echo implode("<br>", $array);
}

function show($array){
    print("<pre>");
    print_r($array);
    print("</pre>");
}
