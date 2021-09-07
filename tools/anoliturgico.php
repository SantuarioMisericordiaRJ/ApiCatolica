<?php
//2021.09.07.00
//Protocol Corporation Ltda.
//https://github.com/SantuarioMisericordiaRJ/ApiCatolica

class AnoLiturgico{
  private array $Cache = [];

  public const Datas = 0;
  public const TempoAdvento = 1;
  public const TempoNatal = 2;
  public const TempoEpifania = 3;
  public const TempoComum = 4;
  public const TempoCinzas = 5;
  public const TempoQuaresma = 6;
  public const TempoRamos = 7;
  public const TempoPascoa = 8;
  public const TempoPentecostes = 9;
  public const TempoTrindade = 10;

  private function CalculaAno(int $Timestamp){
    //Cria o timestamp do natal do ano anterior
    $this->Cache[self::TempoNatal][0] = mktime(0, 0, 0, 12, 25, date('Y', $Timestamp) - 1);
    //Subtrai 3 semanas e pega o dia da semana
    $this->Cache[self::TempoAdvento][1] = strtotime('-3 weeks', $this->Cache[self::TempoNatal][0]);
    $DiaSemana = date('N', $this->Cache[self::TempoAdvento][1]);
    //Se não for domingo, acha o domingo anterior
    if($DiaSemana < 7):
      $this->Cache[self::TempoAdvento][1] = strtotime('-' . $DiaSemana . ' day', $this->Cache[self::TempoAdvento][1]);
    endif;
    $this->Cache[self::TempoAdvento][2] = strtotime('+1 week', $this->Cache[self::TempoAdvento][1]);
    $this->Cache[self::TempoAdvento][3] = strtotime('+1 week', $this->Cache[self::TempoAdvento][2]);
    $this->Cache[self::TempoAdvento][4] = strtotime('+1 week', $this->Cache[self::TempoAdvento][3]);

    $DiaSemana = date('N', $this->Cache[self::TempoNatal][0]);
    $this->Cache[self::TempoNatal][1] = strtotime('+' . (7 - $DiaSemana) . 'days', $this->Cache[self::TempoNatal][0]);
    $this->Cache[self::TempoNatal][2] = strtotime('+1 week', $this->Cache[self::TempoNatal][1]);

    $this->Cache[self::TempoEpifania] = strtotime('+12 day', $this->Cache[self::TempoNatal][0]);
    $DiaSemana = date('N', $this->Cache[self::TempoEpifania]);
    $this->Cache[self::TempoComum][1] = strtotime('+' . (7 - $DiaSemana) . ' day', $this->Cache[self::TempoEpifania]);
    $this->Cache[self::TempoComum][2] = strtotime('+1 week', $this->Cache[self::TempoComum][1]);
    $this->Cache[self::TempoComum][3] = strtotime('+1 week', $this->Cache[self::TempoComum][2]);
    $this->Cache[self::TempoComum][4] = strtotime('+1 week', $this->Cache[self::TempoComum][3]);
    $this->Cache[self::TempoComum][5] = strtotime('+1 week', $this->Cache[self::TempoComum][4]);
    $this->Cache[self::TempoComum][6] = strtotime('+1 week', $this->Cache[self::TempoComum][5]);

    $this->Cache[self::TempoPascoa][1] = easter_date(date('Y', $Timestamp));
    $this->Cache[self::TempoCinzas] = strtotime('-46 day', $this->Cache[self::TempoPascoa][1]);
    $this->Cache[self::TempoPascoa][2] = strtotime('+1 week', $this->Cache[self::TempoPascoa][1]);
    $this->Cache[self::TempoPascoa][3] = strtotime('+1 week', $this->Cache[self::TempoPascoa][2]);
    $this->Cache[self::TempoPascoa][4] = strtotime('+1 week', $this->Cache[self::TempoPascoa][3]);
    $this->Cache[self::TempoPascoa][5] = strtotime('+1 week', $this->Cache[self::TempoPascoa][4]);
    $this->Cache[self::TempoPascoa][6] = strtotime('+1 week', $this->Cache[self::TempoPascoa][5]);
    $this->Cache[self::TempoPascoa][7] = strtotime('+1 week', $this->Cache[self::TempoPascoa][6]);

    $temp = strtotime('+1 week', $this->Cache[self::TempoComum][6]);
    if($temp < $this->Cache[self::TempoCinzas]):
      $this->Cache[self::TempoComum][6] = $temp;
    endif;

    $this->Cache[self::TempoQuaresma][1] = strtotime('+4 day', $this->Cache[self::TempoCinzas]);
    $this->Cache[self::TempoQuaresma][2] = strtotime('+1 week', $this->Cache[self::TempoQuaresma][1]);
    $this->Cache[self::TempoQuaresma][3] = strtotime('+1 week', $this->Cache[self::TempoQuaresma][2]);
    $this->Cache[self::TempoQuaresma][4] = strtotime('+1 week', $this->Cache[self::TempoQuaresma][3]);
    $this->Cache[self::TempoQuaresma][5] = strtotime('+1 week', $this->Cache[self::TempoQuaresma][4]);
    $this->Cache[self::TempoRamos] = strtotime('+1 week', $this->Cache[self::TempoQuaresma][5]);
    
    $this->Cache[self::TempoPentecostes] = strtotime('+50 days', $this->Cache[self::TempoPascoa][1]);
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
    $this->Cache[self::TempoComum][34] = strtotime('-1 week', $ProximoAdvento1);
    $this->Cache[self::TempoComum][33] = strtotime('-1 week', $this->Cache[self::TempoComum][34]);
    $this->Cache[self::TempoComum][32] = strtotime('-1 week', $this->Cache[self::TempoComum][33]);
    $this->Cache[self::TempoComum][31] = strtotime('-1 week', $this->Cache[self::TempoComum][32]);
    $this->Cache[self::TempoComum][30] = strtotime('-1 week', $this->Cache[self::TempoComum][31]);
    $this->Cache[self::TempoComum][29] = strtotime('-1 week', $this->Cache[self::TempoComum][30]);
    $this->Cache[self::TempoComum][28] = strtotime('-1 week', $this->Cache[self::TempoComum][29]);
    $this->Cache[self::TempoComum][27] = strtotime('-1 week', $this->Cache[self::TempoComum][28]);
    $this->Cache[self::TempoComum][26] = strtotime('-1 week', $this->Cache[self::TempoComum][27]);
    $this->Cache[self::TempoComum][25] = strtotime('-1 week', $this->Cache[self::TempoComum][26]);
    $this->Cache[self::TempoComum][24] = strtotime('-1 week', $this->Cache[self::TempoComum][25]);
    $this->Cache[self::TempoComum][23] = strtotime('-1 week', $this->Cache[self::TempoComum][24]);
    $this->Cache[self::TempoComum][22] = strtotime('-1 week', $this->Cache[self::TempoComum][23]);
    $this->Cache[self::TempoComum][21] = strtotime('-1 week', $this->Cache[self::TempoComum][22]);
    $this->Cache[self::TempoComum][20] = strtotime('-1 week', $this->Cache[self::TempoComum][21]);
    $this->Cache[self::TempoComum][19] = strtotime('-1 week', $this->Cache[self::TempoComum][20]);
    $this->Cache[self::TempoComum][18] = strtotime('-1 week', $this->Cache[self::TempoComum][19]);
    $this->Cache[self::TempoComum][17] = strtotime('-1 week', $this->Cache[self::TempoComum][18]);
    $this->Cache[self::TempoComum][16] = strtotime('-1 week', $this->Cache[self::TempoComum][17]);
    $this->Cache[self::TempoComum][15] = strtotime('-1 week', $this->Cache[self::TempoComum][16]);
    $this->Cache[self::TempoComum][14] = strtotime('-1 week', $this->Cache[self::TempoComum][15]);
    $this->Cache[self::TempoComum][13] = strtotime('-1 week', $this->Cache[self::TempoComum][14]);
    $this->Cache[self::TempoComum][12] = strtotime('-1 week', $this->Cache[self::TempoComum][13]);
    $this->Cache[self::TempoComum][11] = strtotime('-1 week', $this->Cache[self::TempoComum][12]);
    $temp = strtotime('-1 week', $this->Cache[self::TempoComum][11]);
    if($temp > $this->Cache[self::TempoTrindade]):
      $this->Cache[self::TempoComum][10] = $temp;
      $temp = strtotime('-1 week', $this->Cache[self::TempoComum][10]);
      if($temp > $this->Cache[self::TempoTrindade]):
        $this->Cache[self::TempoComum][9] = $temp;
      endif;
    endif;

    ksort($this->Cache);
  }

  private function CalculaDatas():void{
    foreach($this->Cache as $tempo => $semanas):
      if(is_array($semanas)):
        foreach($semanas as $semana => $data):
          $this->Cache[self::Datas][date('Y-m-d', $data)] = [$tempo, $semana];
        endforeach;
      else:
        $this->Cache[self::Datas][date('Y-m-d', $semanas)] = $tempo;
      endif;
    endforeach;
    ksort($this->Cache);
  }

  public function __construct(int $Timestamp = null){
    if($Timestamp === null):
      $Timestamp = time();
    endif;
    $this->CalculaAno($Timestamp);
    $this->CalculaDatas($Timestamp);
  }

  public function DatasGet(){
    return $this->Cache[self::Datas];
  }

  /**
   * @return int|array
   */
  public function TempoGet(int $Timestamp){
    $DiaSemana = date('N', $Timestamp);
    if($DiaSemana < 7):
      $Timestamp = strtotime('-' . $DiaSemana . ' day', $Timestamp);
    endif;
    $datas = $this->DatasGet();
    return $datas[date('Y-m-d', $Timestamp)];
  }
}