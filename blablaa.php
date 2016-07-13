<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<body>
<div id="container">
     <form class="form-horizontal" role="form" id="contatoForm" method="get" action="mailto:teste@mail.com" target="_blank">
        <input type="hidden" name="Subject" value="Meu assunto">
        <input type="hidden" name="Body" value="">
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="nome">Nome :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nome" placeholder="Nome Completo" >
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="@email.com">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="endereço">Endereço :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="endereco">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Enviar</button>
            </div>
        </div>
    </form>
</div>
</body>

<script>
$(function () {
  document.getElementById('contatoForm').addEventListener('submit', function () {
        var nome = this.querySelector('input[name=nome]'), nome = nome.value;
        var email = this.querySelector('input[name=email]'), email = email.value;
        var endereco = this.querySelector('input[name=endereco]'), endereco = endereco.value;
        var texto = 'Olá destinatário, \nMeu nome é '+ nome +'meu email é '+ email+'e meu endereco é '+endereco;
        this.querySelector('input[name=Body]').setAttribute('value', texto);
    });
  });
</script>