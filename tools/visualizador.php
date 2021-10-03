<?php
//2021.10.03.05
//Protocol Corporation Ltda.
//https://github.com/SantuarioMisericordiaRJ/ApiCatolica

//Ferramenta para visualizar de forma fácil as leituras de cada dia
//Para pular para uma determinada data, use o parâmetro dia na url, no formato internacional, com leading 0
//Exemplo: visualizador.php?dia=2021-09-07

define('Pasta', dirname(__DIR__, 1));
require(Pasta . '/tools/anoliturgico.php');
require(Pasta . '/tools/funcoes.php');

$_GET['dia'] ??= date('Y-m-d');
$Ts = strtotime($_GET['dia']);
$AnoLiturgico = new AnoLiturgico($Ts);

$index = file_get_contents(Pasta . '/src/index.json');
$index = json_decode($index, true);
$datas = file_get_contents(Pasta . '/src/datas.json');
$datas = json_decode($datas, true);
$especiais = file_get_contents(Pasta . '/src/especiais.json');
$especiais = json_decode($especiais, true);

list($tempo, $semana) = $AnoLiturgico->TempoGet($Ts);
$Tempos = [
  AnoLiturgico::TempoComum => ['tc', 'Tempo comum']
];
$Semanas = [null, 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'];

$DiaSemana = date('N', $Ts);
if($DiaSemana === '7'):
  $ano = AnoLetra();
elseif(date('Y') % 2 === 0):
  $ano = 'p';
else:
  $ano = 'i';
endif;
if(isset($datas[$_GET['dia']])):
  $especial = $especiais[$datas[$_GET['dia']]];
endif;

echo '<h2>' . $_GET['dia'] . '<br>';
echo $semana . 'ª semana do ' . $Tempos[$tempo][1] . ' - ' . $Semanas[$DiaSemana];
if(isset($especial['nome'])):
  echo '<br>' . $especial['nome'];
endif;
echo '</h2>';

echo '<b>Antífona da entrada</b><br>';
$temp = $especial['ant1'] ?? $index[$Tempos[$tempo][0]][$semana]['ant1'];
$temp = file_get_contents(Pasta . '/src/antifonas/entrada/' . $temp . '.txt');
echo $temp . '<br><br>';

echo '<b>Oração do dia</b><br>';
$temp = $especial['odd'] ?? $index[$Tempos[$tempo][0]][$semana]['odd'];
$temp = file_get_contents(Pasta . '/src/oracoes/dodia/' . $temp . '.txt');
$temp = str_replace("\n", '<br>', $temp);
echo $temp . '<br><br>';

echo '<b>1ª leitura</b><br>';
$temp = $especial[1] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana][$ano][1];
echo $temp . '<br><br>';

$temp = $especial['r'] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana][$ano]['r'] ?? null;
if($temp !== null):
  echo '<b>Responsório:</b><br>';
  echo $temp . '<br><br>';
endif;
$temp = $especial['rt'] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana][$ano]['rt'] ?? null;
if($temp !== null):
  $temp = file_get_contents(Pasta . '/src/salmos/' . $temp . '.json');
  $temp = json_decode($temp, true);
  foreach($temp as $id => $temp2):
    echo $id . ' - ' . $temp2 . '<br>';
  endforeach;
  echo '<br>';
endif;

$temp = $especial[2] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana][$ano][2] ?? null;
if($temp !== null):
  echo '<b>2ª leitura:</b><br>';
  echo $temp . '<br><br>';
endif;

$temp = $especial['acl'] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana][$ano]['acl'] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana]['acl'] ?? null;
if($temp !== null):
  echo '<b>Aclamação:</b><br>';
  $temp = file_get_contents(Pasta . '/src/aclamacoes/' . $temp . '.txt');
  $temp = str_replace("\n", '<br>', $temp);
  echo $temp . '<br><br>';
endif;

echo '<b>Evangelho:</b><br>';
$temp = $especial['e'] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana][$ano]['e'] ?? $index[$Tempos[$tempo][0]][$semana][$DiaSemana]['e'];
echo $temp . '<br><br>';

$temp = $especial['ofe'] ?? $index[$Tempos[$tempo][0]][$semana]['ofe'] ?? null;
if($temp !== null):
  echo '<b>Sobre as oferendas:</b><br>';
  $temp = file_get_contents(Pasta . '/src/oracoes/oferendas/' . $temp . '.txt');
  $temp = str_replace("\n", '<br>', $temp);
  echo $temp . '<br><br>';
endif;

echo '<b>Antífona da comunhão:</b><br>';
$temp = $especial['ant2'] ?? $index[$Tempos[$tempo][0]][$semana]['ant2'];
$temp = file_get_contents(Pasta . '/src/antifonas/depois/' . $temp . '.txt');
echo $temp . '<br><br>';

echo '<b>Depois da comunhão:</b><br>';
$temp = $especial['dep'] ?? $index[$Tempos[$tempo][0]][$semana]['dep'];
$temp = file_get_contents(Pasta . '/src/oracoes/depois/' . $temp . '.txt');
$temp = str_replace("\n", '<br>', $temp);
echo $temp . '<br><br>';