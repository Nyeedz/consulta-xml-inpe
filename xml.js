function __getID(){
  var cidade = removerAcentos($("#cidade").val().toLowerCase());
  loadDoc(1, cidade);
}

function removerAcentos(str){
  var accents    = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
  var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
  str = str.split('');
  var strLen = str.length;
  var i, x;
  for (i = 0; i < strLen; i++) {
    if ((x = accents.indexOf(str[i])) != -1) {
      str[i] = accentsOut[x];
    }
  }
  return str.join('');
}

function loadDoc(func, cidade, id, size_prev) {
  /* func
      1 = pegar id da cidade
      2 = pegar dados da cidade
  */
  if(func == 1){
    var url = "https://cptec-nyeedz.c9users.io/busca.php?cidade="+encodeURIComponent(cidade.trim())+"&req="+func;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        id = __findID(xhttp);
        loadDoc(2, 'placeholder', id, $('input[value=7]').val());
        loadDoc(3, 'placeholder', id, $('input[value=4]').val());
        loadDoc(4, 'placeholder', id, $('input[value=estendida]').val());
      }
    };
  }else{
    var url = "https://cptec-nyeedz.c9users.io/busca.php?cidade="+encodeURIComponent(cidade.trim())+"&req="+func+"&size_prev="+size_prev+"&id="+id;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        __preencherTabela(xhttp);
      }
    };
  }
  xhttp.open("GET", url, true);
  xhttp.send();
}

function __findID(xml){
  var nomecidade = $('#cidade').val();
  var uf = $("#uf").val();
  var xmlDoc = xml.responseXML;
  var x = xmlDoc.getElementsByTagName("cidade");
  for (i = 0; i <x.length; i++) {
    if(x[i].getElementsByTagName("nome")[0].childNodes[0].nodeValue == nomecidade && x[i].getElementsByTagName("uf")[0].childNodes[0].nodeValue == uf ){
      return x[i].getElementsByTagName("id")[0].childNodes[0].nodeValue;
    }
  }
}

function __preencherTabela(xml){
  var xmlDoc = xml.responseXML;
  var nome = xmlDoc.getElementsByTagName("nome")[0].childNodes[0].nodeValue;
  var uf = xmlDoc.getElementsByTagName("uf")[0].childNodes[0].nodeValue;
  var atualizacao = xmlDoc.getElementsByTagName("atualizacao")[0].childNodes[0].nodeValue;
  var previsoes = xmlDoc.getElementsByTagName("previsao");
  var table = "<thead><tr><br><th>Dia</th><th>Tempo</th><th>Máxima</th><th>Mínima</th><th>IUV</th></tr></thead><tbody>";
  for (i = 0; i <previsoes.length; i++) {
    table += "<tr><td>" +
      previsoes[i].getElementsByTagName("dia")[0].childNodes[0].nodeValue +
      "</td><td>" +
      previsoes[i].getElementsByTagName("tempo")[0].childNodes[0].nodeValue +
      "</td><td>" +
      previsoes[i].getElementsByTagName("maxima")[0].childNodes[0].nodeValue +
      "</td><td>" +
      previsoes[i].getElementsByTagName("minima")[0].childNodes[0].nodeValue +
      "</td><td>" +
      previsoes[i].getElementsByTagName("iuv")[0].childNodes[0].nodeValue +
      "</td></tr>";
  }
  table = table+"</tbody>";
  document.getElementById("movie-table-custom").innerHTML=table;
}
