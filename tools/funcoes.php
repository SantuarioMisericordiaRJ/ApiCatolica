<?php
//2021.11.28.00
//Protocol Corporation Ltda.
//https://github.com/SantuarioMisericordiaRJ/ApiCatolica

/**
 * @param int $Ano Timestamp
 * @param string $Tempo A identificação do tempo litúrgico, usando as constantes da classe AnoLiturgico
 */
function AnoLetra(int $Ano, int $Tempo = null):?string{
  if($Tempo === AnoLiturgico::TempoAdvento):
    $Ano = strtotime('+1 year', $Ano);
  endif;
  $temp = date('Y', $Ano) % 3;
  if($temp === 0):
    return 'c';
  elseif($temp === 1):
    return 'a';
  elseif($temp === 2):
    return 'b';
  else:
    return null;
  endif;
}