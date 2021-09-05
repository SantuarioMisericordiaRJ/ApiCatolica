<?php
//2021.09.05.00
//Protocol Corporation Ltda.
//https://github.com/SantuarioMisericordiaRJ/ApiCatolica

class AnoLiturgico{
  private array $Cache = [];

  public const Datas = 0;
  public const TempoAdvento1 = 1;
  public const TempoAdvento2 = 2;
  public const TempoAdvento3 = 3;
  public const TempoAdvento4 = 4;
  public const TempoNatal = 5;
  public const TempoNatal1 = 6;
  public const TempoNatal2 = 7;
  public const TempoEpifania = 8;
  public const TempoComum1 = 9;
  public const TempoComum2 = 10;
  public const TempoComum3 = 11;
  public const TempoComum4 = 12;
  public const TempoComum5 = 13;
  public const TempoComum6 = 14;
  public const TempoCinzas = 15;
  public const TempoQuaresma1 = 16;
  public const TempoQuaresma2 = 17;
  public const TempoQuaresma3 = 18;
  public const TempoQuaresma4 = 19;
  public const TempoQuaresma5 = 20;
  public const TempoRamos = 21;
  public const TempoPascoa = 22;
  public const TempoPascoa2 = 23;
  public const TempoPascoa3 = 24;
  public const TempoPascoa4 = 25;
  public const TempoPascoa5 = 26;
  public const TempoPascoa6 = 27;
  public const TempoPascoa7 = 28;
  public const TempoPentecostes = 29;
  public const TempoTrindade = 30;
  public const TempoComum7 = 31;
  public const TempoComum8 = 32;
  public const TempoComum9 = 33;
  public const TempoComum10 = 34;
  public const TempoComum11 = 35;
  public const TempoComum12 = 36;
  public const TempoComum13 = 37;
  public const TempoComum14 = 38;
  public const TempoComum15 = 39;
  public const TempoComum16 = 40;
  public const TempoComum17 = 41;
  public const TempoComum18 = 42;
  public const TempoComum19 = 43;
  public const TempoComum20 = 44;
  public const TempoComum21 = 45;
  public const TempoComum22 = 46;
  public const TempoComum23 = 47;
  public const TempoComum24 = 48;
  public const TempoComum25 = 49;
  public const TempoComum26 = 50;
  public const TempoComum27 = 51;
  public const TempoComum28 = 52;
  public const TempoComum29 = 53;
  public const TempoComum30 = 54;
  public const TempoComum31 = 55;
  public const TempoComum32 = 56;
  public const TempoComum33 = 57;
  public const TempoComum34 = 58;
  
  private function CalculaAno(int $Timestamp){
    //Cria o timestamp do natal do ano anterior
    $this->Cache[self::TempoNatal] = mktime(0, 0, 0, 12, 25, date('Y', $Timestamp) - 1);
    //Subtrai 3 semanas e pega o dia da semana
    $this->Cache[self::TempoAdvento1] = strtotime('-3 weeks', $this->Cache[self::TempoNatal]);
    $DiaSemana = date('N', $this->Cache[self::TempoAdvento1]);
    //Se não for domingo, acha o domingo anterior
    if($DiaSemana < 7):
      $this->Cache[self::TempoAdvento1] = strtotime('-' . $DiaSemana . ' day', $this->Cache[self::TempoAdvento1]);
    endif;
    $this->Cache[self::TempoAdvento2] = strtotime('+1 week', $this->Cache[self::TempoAdvento1]);
    $this->Cache[self::TempoAdvento3] = strtotime('+1 week', $this->Cache[self::TempoAdvento2]);
    $this->Cache[self::TempoAdvento4] = strtotime('+1 week', $this->Cache[self::TempoAdvento3]);

    $DiaSemana = date('N', $this->Cache[self::TempoNatal]);
    //vdd($DiaSemana);
    $this->Cache[self::TempoNatal1] = strtotime('+' . (7 - $DiaSemana) . 'days', $this->Cache[self::TempoNatal]);
    $this->Cache[self::TempoNatal2] = strtotime('+1 week', $this->Cache[self::TempoNatal1]);

    $this->Cache[self::TempoEpifania] = strtotime('+12 day', $this->Cache[self::TempoNatal]);
    $DiaSemana = date('N', $this->Cache[self::TempoEpifania]);
    $this->Cache[self::TempoComum1] = strtotime('+' . (7 - $DiaSemana) . ' day', $this->Cache[self::TempoEpifania]);
    $this->Cache[self::TempoComum2] = strtotime('+1 week', $this->Cache[self::TempoComum1]);
    $this->Cache[self::TempoComum3] = strtotime('+1 week', $this->Cache[self::TempoComum2]);
    $this->Cache[self::TempoComum4] = strtotime('+1 week', $this->Cache[self::TempoComum3]);
    $this->Cache[self::TempoComum5] = strtotime('+1 week', $this->Cache[self::TempoComum4]);
    $this->Cache[self::TempoComum6] = strtotime('+1 week', $this->Cache[self::TempoComum5]);

    $this->Cache[self::TempoPascoa] = easter_date(date('Y', $Timestamp));
    $this->Cache[self::TempoCinzas] = strtotime('-46 day', $this->Cache[self::TempoPascoa]);
    $this->Cache[self::TempoPascoa2] = strtotime('+1 week', $this->Cache[self::TempoPascoa]);
    $this->Cache[self::TempoPascoa3] = strtotime('+1 week', $this->Cache[self::TempoPascoa2]);
    $this->Cache[self::TempoPascoa4] = strtotime('+1 week', $this->Cache[self::TempoPascoa3]);
    $this->Cache[self::TempoPascoa5] = strtotime('+1 week', $this->Cache[self::TempoPascoa4]);
    $this->Cache[self::TempoPascoa6] = strtotime('+1 week', $this->Cache[self::TempoPascoa5]);
    $this->Cache[self::TempoPascoa7] = strtotime('+1 week', $this->Cache[self::TempoPascoa6]);

    $temp = strtotime('+1 week', $this->Cache[self::TempoComum6]);
    if($temp < $this->Cache[self::TempoCinzas]):
      $this->Cache[self::TempoComum6] = $temp;
    endif;

    $this->Cache[self::TempoQuaresma1] = strtotime('+4 day', $this->Cache[self::TempoCinzas]);
    $this->Cache[self::TempoQuaresma2] = strtotime('+1 week', $this->Cache[self::TempoQuaresma1]);
    $this->Cache[self::TempoQuaresma3] = strtotime('+1 week', $this->Cache[self::TempoQuaresma2]);
    $this->Cache[self::TempoQuaresma4] = strtotime('+1 week', $this->Cache[self::TempoQuaresma3]);
    $this->Cache[self::TempoQuaresma5] = strtotime('+1 week', $this->Cache[self::TempoQuaresma4]);
    $this->Cache[self::TempoRamos] = strtotime('+1 week', $this->Cache[self::TempoQuaresma5]);
    
    $this->Cache[self::TempoPentecostes] = strtotime('+50 days', $this->Cache[self::TempoPascoa]);
    $DiaSemana = date('N', $this->Cache[self::TempoPentecostes]);
    if($DiaSemana === '1'):
      $this->Cache[self::TempoPentecostes] = strtotime('-1 day', $this->Cache[self::TempoPentecostes]);
    endif;
    $this->Cache[self::TempoTrindade] = strtotime('+1 week', $this->Cache[self::TempoPentecostes]);

    //Tempo comum
    $ProximoNatal = mktime(0, 0, 0, 12, 25, date('Y', $Timestamp));
    $ProximoAdvento1 = strtotime('-3 weeks', $ProximoNatal);
    $DiaSemana = date('N', $ProximoAdvento1);
    if($DiaSemana < 7):
      $ProximoAdvento1 = strtotime('-' . $DiaSemana . ' day', $ProximoAdvento1);
    endif;
    $this->Cache[self::TempoComum34] = strtotime('-1 week', $ProximoAdvento1);
    $this->Cache[self::TempoComum33] = strtotime('-1 week', $this->Cache[self::TempoComum34]);
    $this->Cache[self::TempoComum32] = strtotime('-1 week', $this->Cache[self::TempoComum33]);
    $this->Cache[self::TempoComum31] = strtotime('-1 week', $this->Cache[self::TempoComum32]);
    $this->Cache[self::TempoComum30] = strtotime('-1 week', $this->Cache[self::TempoComum31]);
    $this->Cache[self::TempoComum29] = strtotime('-1 week', $this->Cache[self::TempoComum30]);
    $this->Cache[self::TempoComum28] = strtotime('-1 week', $this->Cache[self::TempoComum29]);
    $this->Cache[self::TempoComum27] = strtotime('-1 week', $this->Cache[self::TempoComum28]);
    $this->Cache[self::TempoComum26] = strtotime('-1 week', $this->Cache[self::TempoComum27]);
    $this->Cache[self::TempoComum25] = strtotime('-1 week', $this->Cache[self::TempoComum26]);
    $this->Cache[self::TempoComum24] = strtotime('-1 week', $this->Cache[self::TempoComum25]);
    $this->Cache[self::TempoComum23] = strtotime('-1 week', $this->Cache[self::TempoComum24]);
    $this->Cache[self::TempoComum22] = strtotime('-1 week', $this->Cache[self::TempoComum23]);
    $this->Cache[self::TempoComum21] = strtotime('-1 week', $this->Cache[self::TempoComum22]);
    $this->Cache[self::TempoComum20] = strtotime('-1 week', $this->Cache[self::TempoComum21]);
    $this->Cache[self::TempoComum19] = strtotime('-1 week', $this->Cache[self::TempoComum20]);
    $this->Cache[self::TempoComum18] = strtotime('-1 week', $this->Cache[self::TempoComum19]);
    $this->Cache[self::TempoComum17] = strtotime('-1 week', $this->Cache[self::TempoComum18]);
    $this->Cache[self::TempoComum16] = strtotime('-1 week', $this->Cache[self::TempoComum17]);
    $this->Cache[self::TempoComum15] = strtotime('-1 week', $this->Cache[self::TempoComum16]);
    $this->Cache[self::TempoComum14] = strtotime('-1 week', $this->Cache[self::TempoComum15]);
    $this->Cache[self::TempoComum13] = strtotime('-1 week', $this->Cache[self::TempoComum14]);
    $this->Cache[self::TempoComum12] = strtotime('-1 week', $this->Cache[self::TempoComum13]);
    $this->Cache[self::TempoComum11] = strtotime('-1 week', $this->Cache[self::TempoComum12]);
    $temp = strtotime('-1 week', $this->Cache[self::TempoComum11]);
    if($temp > $this->Cache[self::TempoTrindade]):
      $this->Cache[self::TempoComum10] = $temp;
      $temp = strtotime('-1 week', $this->Cache[self::TempoComum10]);
      if($temp > $this->Cache[self::TempoTrindade]):
        $this->Cache[self::TempoComum9] = $temp;
      endif;
    endif;

    ksort($this->Cache);
  }

  private function CalculaDatas():void{
    $Constantes = new ReflectionClass('AnoLiturgico');
    $Constantes = $Constantes->getConstants();
    foreach($Constantes as $id):
      if($id > 0 and isset($this->Cache[$id])):
        $this->Cache[self::Datas][date('Y-m-d', $this->Cache[$id])] = $id;
      endif;
    endforeach;
  }

  public function __construct(int $Timestamp = null){
    if($Timestamp === null):
      $Timestamp = time();
    endif;
    $this->CalculaAno($Timestamp);
    $this->CalculaDatas($Timestamp);
  }

  public function DatasGet(){
    $Constantes = new ReflectionClass('AnoLiturgico');
    $Constantes = $Constantes->getConstants();
    $Constantes = array_flip($Constantes);
    unset($Constantes[0]);
    $Datas = $this->Cache[self::Datas];
    foreach($Datas as &$constante):
      $constante = $Constantes[$constante];
    endforeach;
    return $Datas;
  }

  public function TempoGet(int $Timestamp):?string{
    $DiaSemana = date('N', $Timestamp);
    if($DiaSemana < 7):
      $Timestamp = strtotime('-' . $DiaSemana . ' day', $Timestamp);
    endif;
    $data = date('Y-m-d', $Timestamp);
    $datas = $this->DatasGet();
    return $datas[$data];
  }
}