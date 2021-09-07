<?php
//2021.09.07.00
//Protocol Corporation Ltda.
//https://github.com/SantuarioMisericordiaRJ/ApiCatolica

//Ferramenta para visualizar de forma fácil as leituras de cada dia
//Para pular para uma determinada data, use o parâmetro dia na url, no formato internacional, com leading 0
//Exemplo: visualizador.php?dia=2021-09-07

require('D:/GitHub/ApiCatolica/tools/anoliturgico.php');
$_GET['dia'] ??= date('Y-m-d');
$Ts = strtotime($_GET['dia']);
$AnoLiturgico = new AnoLiturgico($Ts);

$index = file_get_contents('D:/GitHub/ApiCatolica/src/index.json');
$index = json_decode($index, true);
$especiais = file_get_contents('D:/GitHub/ApiCatolica/src/especiais.json');
$especiais = json_decode($especiais, true);

list($tempo, $semana) = $AnoLiturgico->TempoGet($Ts);
$Tempos = [
  AnoLiturgico::TempoComum => 'tc'
];

echo '<h2>' . $_GET['dia'] . '</h2>';

echo '<b>Antífona 1</b><br>';
$temp = $especiais[$_GET['dia']]['ant1'] ?? $index[$Tempos[$tempo]][$semana]['ant1'];
$temp = file_get_contents('D:/GitHub/ApiCatolica/src/antifonas/' . $temp . '.txt');
echo $temp . '<br><br>';

echo '<b>Oração do dia</b><br>';
$temp = $especiais[$_GET['dia']]['odd'] ?? $index[$Tempos[$tempo]][$semana]['odd'];
$temp = file_get_contents('D:/GitHub/ApiCatolica/src/oracoes/dodia/' . $temp . '.txt');
echo $temp . '<br><br>';

$DiaSemana = date('N', $Ts);
if($DiaSemana === '7'):
  $ano = AnoLetra();
elseif(date('Y') % 2 === 0):
  $ano = 'p';
else:
  $ano = 'i';
endif;

echo '<b>1ª leitura</b><br>';
$temp = $especiais[$_GET['dia']][1] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana][$ano][1];
echo $temp . '<br><br>';

$temp = $especiais[$_GET['dia']]['r'] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana][$ano]['r'] ?? null;
if($temp !== null):
  echo '<b>Responsório:</b><br>';
  echo $temp . '<br><br>';
endif;

$temp = $especiais[$_GET['dia']][2] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana][$ano][2] ?? null;
if($temp !== null):
  echo '<b>2ª leitura:</b><br>';
  echo $temp . '<br><br>';
endif;

$temp = $especiais[$_GET['dia']]['acl'] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana][$ano]['acl'] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana]['acl'] ?? null;
if($temp !== null):
  echo '<b>Aclamação:</b><br>';
  $temp = file_get_contents('D:/GitHub/ApiCatolica/src/aclamacoes/' . $temp . '.txt');
  echo $temp . '<br><br>';
endif;

echo '<b>Evangelho:</b><br>';
$temp = $especiais[$_GET['dia']]['e'] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana][$ano]['e'] ?? $index[$Tempos[$tempo]][$semana][$DiaSemana]['e'];
echo $temp . '<br><br>';

$temp = $especiais[$_GET['dia']]['ofe'] ?? $index[$Tempos[$tempo]][$semana]['ofe'] ?? null;
if($temp !== null):
  echo '<b>Sobre as oferendas:</b><br>';
  $temp = file_get_contents('D:/GitHub/ApiCatolica/src/oracoes/oferendas/' . $temp . '.txt');
  echo $temp . '<br><br>';
endif;

echo '<b>Antífona 2:</b><br>';
$temp = $especiais[$_GET['dia']]['ant2'] ?? $index[$Tempos[$tempo]][$semana]['ant2'];
$temp = file_get_contents('D:/GitHub/ApiCatolica/src/antifonas/' . $temp . '.txt');
echo $temp . '<br><br>';

echo '<b>Depois da comunhão:</b><br>';
$temp = $especiais[$_GET['dia']]['dep'] ?? $index[$Tempos[$tempo]][$semana]['dep'];
$temp = file_get_contents('D:/GitHub/ApiCatolica/src/oracoes/depois/' . $temp . '.txt');
echo $temp . '<br><br>';