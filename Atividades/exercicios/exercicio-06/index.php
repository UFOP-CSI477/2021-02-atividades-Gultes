<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  </head>
  <title>Validação</title>
</head>

<body>
  <form action="validacao.php" method="POST">
    <div class="form-group">
      <label for="name">Nome</label>
      <input class="form-control" placeholder="Digite aqui seu nome" id="name" type="text" name="name" />
    </div>
    <div class="form-gruop">
      <label for="age">Idade</label>
      <input class="form-control" placeholder="Digite aqui sua idade" id="age" type="number" name="age" />
    </div>
    <div class="form-gruop">
      <label for="cep">Cep</label>
      <input class="form-control" placeholder="Digite aqui seu cep" id="cep" type="number" name="cep" />
    </div>
    <div class="form-gruop">
      <label for="tel">telefone</label>
      <input class="form-control" placeholder="Digite aqui seu telefone" id="tel" type="number" name="tel" />
    </div>
    <div class="form-group">
      <label>Gênero</label>
      <div class="form-group form-check">
        <input type="radio" class="form-check-input" id="masc" name="gender" value="masc" />
        <label class="form-ckeck-label" for="masc">Homem</label>
      </div>
      <div class="form-group form-check">
        <input class="form-check-input" type="radio" id="fem" name="gender" value="fem" />
        <label class="form-ckeck-label" for="fem">Mulher</label>
      </div>
      <div class="form-group form-check">
        <input class="form-check-input" type="radio" id="other" name="gender" value="other" />
        <label class="form-ckeck-label" for="other">Outro</label>
      </div>

    </div>
    <div class="form-group">
      <label for="">Áreas de interesse:</label>
      <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" id="web" name="area[0]" value="web" /><label class="form-ckeck-label" for="web">Web</label>
      </div>
      <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" id="redes" name="area[1]" value="redes" /><label class="form-ckeck-label" for="redes">Redes</label>
      </div>
      <div class="form-group form-check">
        <input class="form-check-input" type="checkbox" id="Banco" name="area[2]" value="banco" /><label class="form-ckeck-label" for="Banco">Banco</label>
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Cadastrar" />
    <input type="button" class="btn btn-secundary" value="Validar" onclick="validateForm()" />
  </form>
  <p class="resultado display-1"></p>
  <script src="./validacao-form.js"></script>
</body>

</html>