<?php

function AnoLetra(int $Ano):?string{
    $temp = $Ano % 3;
    if($temp === 0):
        return 'C';
    elseif($temp === 1):
        return 'A';
    elseif($temp === 2):
        return 'B';
    else:
        return null;
    endif;
}
