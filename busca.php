<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.light_blue-yellow.min.css" />
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <style>
    body{
      font-family: 'Roboto';
      background-color: #EEE;
    }
    .full-width{
      width: 100%;
    }
    </style>
  </head>
  <body>
    <?php
      function tirarAcentos($string){
          return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
      }
      $nomecidade = $_POST['nomecidade'];
      $uf = $_POST['uf'];
      $size_prev = $_POST['previsao'];
      $urlcidade = "http://servicos.cptec.inpe.br/XML/listaCidades?city=".rawurlencode(tirarAcentos($nomecidade));
      $string = file_get_contents("$urlcidade");
      $xml = simplexml_load_string($string);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      $siglas = array("ec","ci","c","in","pp","cm","cn","pt","pm","np","pc","pn","cv","ch","t","ps","e","n","cl","nv","g","ne","nd","pnt","psc","pcm","pct","pcn","npt","npn","ncn","nct","ncm","npm","npp","vn","ct","ppn","ppt","ppm");
      $significado = array(
                            "Encoberto com Chuvas Isoladas",
                            "Chuvas Isoladas",
                            "Chuva",
                            "Instável",
                            "Poss. de Pancadas de Chuva",
                            "Chuva pela Manhã",
                            "Chuva a Noite",
                            "Pancadas de Chuva a Tarde",
                            "Pancadas de Chuva pela Manhã",
                            "Nublado e Pancadas de Chuva",
                            "Pancadas de Chuva",
                            "Parcialmente Nublado",
                            "Chuvisco",
                            "Chuvoso",
                            "Tempestade",
                            "Predomínio de Sol",
                            "Encoberto",
                            "Nublado",
                            "Céu Claro",
                            "Nevoeiro",
                            "Geada",
                            "Neve",
                            "Não Definido",
                            "Pancadas de Chuva a Noite",
                            "Possibilidade de Chuva",
                            "Possibilidade de Chuva pela Manhã",
                            "Possibilidade de Chuva a Tarde",
                            "Possibilidade de Chuva a Noite",
                            "Nublado com Pancadas a Tarde",
                            "Nublado com Pancadas a Noite",
                            "Nublado com Poss. de Chuva a Noite",
                            "Nublado com Poss. de Chuva a Tarde",
                            "Nubl. c/ Poss. de Chuva pela Manhã",
                            "Nublado com Pancadas pela Manhã",
                            "Nublado com Possibilidade de Chuva",
                            "Variação de Nebulosidade",
                            "Chuva a Tarde",
                            "Poss. de Panc. de Chuva a Noite",
                            "Poss. de Panc. de Chuva a Tarde",
                            "Poss. de Panc. de Chuva pela Manhã"
                          );
      for($i=0; $i<count($array['cidade']); $i++){
        if($array['cidade'][$i]['nome']==$nomecidade && $array['cidade'][$i]['uf']==$uf){
          $id = $array['cidade'][$i]['id'];
        }
      }

      if($size_prev=='7dias'){
        $urldados = "http://servicos.cptec.inpe.br/XML/cidade/7dias/".$id."/previsao.xml";
      }else if($size_prev=='4dias'){
        $urldados = "http://servicos.cptec.inpe.br/XML/cidade/".$id."/previsao.xml";
      }else{
        $urldados = "http://servicos.cptec.inpe.br/XML/cidade/".$id."/estendida.xml";
      }

      $string = file_get_contents("$urldados");
      $xml = simplexml_load_string($string);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);

      echo "<div class='mdl-grid'>
        <div class='mdl-cell mdl-cell--4-col'></div>
        <div class='mdl-cell mdl-cell--4-col mdl-typography--text-center'>";

      echo $array['nome']." - ".$array['uf']."<br /><i>Atualizado em ".$array['atualizacao']."</i><br /><br />";
      echo "<table class='mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width'>
            <thead>
              <tr>
                <th class='mdl-data-table__cell--non-numeric'>Dia</th>
                <th>Tempo</th>
                <th>Máxima</th>
                <th>Minima</th>
                <th>IUV</th>
              </tr>
            </thead>
            <tbody>";

            for($i=0; $i<count($array['previsao']); $i++){
              echo "<tr>
              <td class='mdl-data-table__cell--non-numeric'>".$array['previsao'][$i]['dia']."</td>
              <td>";
              for($d=0; $d<count($siglas); $d++){
                if($array['previsao'][$i]['tempo']==$siglas[$d]){
                  echo $significado[$d];
                }
              }
              echo "</td>
              <td>".$array['previsao'][$i]['maxima']."</td>
              <td>".$array['previsao'][$i]['minima']."</td>
              <td>";if($size_prev=='estendida'){
                echo "n/a";
              }else{
                echo $array['previsao'][$i]['iuv'];
              }"</td>
              </tr>";
            }



        echo "</tbody>
            </table>
            <br />
            <br />
            <a href='index.php' style='color:#2196F3;'>Voltar</a>
        </div>
      </div>";
    ?>
  </body>
</html>
