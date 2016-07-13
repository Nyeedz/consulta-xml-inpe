<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue-light_green.min.css" />
  <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
  <!--getmdl-select-->
  <script src="getmdl-select.min.js"></script>
  <link rel="stylesheet" href="getmdl-select.min.css">
  <script type="text/javascript">
    function validateForm() {
      var x=document.forms["form"]["cidade"]["uf"].value; //nome do form e nome do campo são case sensitive (a <> A)
      if (x==null || x==""){
        alert("O campo nome é obrigatorio");
        return false;
      }
    }
  </script>
  <style>
  body{
    font-family: 'Roboto';
    background-color: #EEE;
  }
  .meio{
    text-align: center;
  }
  .mdl-textfield__label{
    color: rgba(33,150,243,0.7);
  }
  .nav ul{
    height:200px; width:18%;
  }
  .nav ul{
    overflow:hidden; overflow-y:scroll;
  }
  </style>
</head>
<body>
  <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col"></div>
    <div class="mdl-cell mdl-cell--4-col meio">
      <img src="http://i.imgur.com/iMorPqo.png" /><br /><br />
      <form method="POST" action="busca.php" accept-charset="UTF-8" name="form">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="cidade" name="nomecidade">
          <label class="mdl-textfield__label" for="cidade">Cidade</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
          <input class="mdl-textfield__input" type="text" id="uf" name="uf" readonly tabIndex="-1" />
          <label class="mdl-textfield__label" for="uf" name="uf">UF</label>
          <div class="nav">
            <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="uf">
              <li value="AC" class="mdl-menu__item">AC</li>
              <li value="AL" class="mdl-menu__item">AL</li>
              <li value="AM" class="mdl-menu__item">AM</li>
              <li value="AP" class="mdl-menu__item">AP</li>
              <li value="BA" class="mdl-menu__item">BA</li>
              <li value="CE" class="mdl-menu__item">CE</li>
              <li value="DF" class="mdl-menu__item">DF</li>
              <li value="ES" class="mdl-menu__item">ES</li>
              <li value="GO" class="mdl-menu__item">GO</li>
              <li value="MA" class="mdl-menu__item">MA</li>
              <li value="MG" class="mdl-menu__item">MG</li>
              <li value="MS" class="mdl-menu__item">MS</li>
              <li value="MT" class="mdl-menu__item">MT</li>
              <li value="PA" class="mdl-menu__item">PA</li>
              <li value="PB" class="mdl-menu__item">PB</li>
              <li value="PE" class="mdl-menu__item">PE</li>
              <li value="PI" class="mdl-menu__item">PI</li>
              <li value="PR" class="mdl-menu__item">PR</li>
              <li value="RJ" class="mdl-menu__item">RJ</li>
              <li value="RN" class="mdl-menu__item">RN</li>
              <li value="RS" class="mdl-menu__item">RS</li>
              <li value="RO" class="mdl-menu__item">RO</li>
              <li value="RR" class="mdl-menu__item">RR</li>
              <li value="SC" class="mdl-menu__item">SC</li>
              <li value="SE" class="mdl-menu__item">SE</li>
              <li value="SP" class="mdl-menu__item">SP</li>
              <li value="TO" class="mdl-menu__item">TO</li>
            </ul>
          </div>
        </div>
        <br />Tipo de previsão:
        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="4dias">
          <input type="radio" id="4dias" class="mdl-radio__button" name="previsao" checked value="4dias"/>
          <span class="mdl-radio__label">4 dias</span>
        </label>
        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="7dias">
          <input type="radio" id="7dias" class="mdl-radio__button" name="previsao" value="7dias"/>
          <span class="mdl-radio__label">7 dias</span>
        </label>
        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="estendida">
          <input type="radio" id="estendida" class="mdl-radio__button" name="previsao" value="estendida"/>
          <span class="mdl-radio__label">Estendida</span>
        </label>
        <br /><br />
        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" onclick="validar()" type="submit" value="enviar">
          Enviar
        </button>
      </form>
    </div>
  </div>
</body>
</html>
