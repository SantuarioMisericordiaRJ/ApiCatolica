<?php
//2021.09.03.00
//Protocol Corporation Ltda.
//https://github.com/SantuarioMisericordiaRJ/ApiCatolica

function AnoLetra(int $Ano = null):?string{
  if($Ano === null):
    $Ano = time();
  endif;
  $temp = date('Y', $Ano) % 3;
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
