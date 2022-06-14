<?php
require_once "./cabecalho.php";
?>
<div class="card-body">
    <form action="./validate.php" method="POST" class="form-group type-div">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
                Nome
            </span>
            <input type="text" id="name" name="name" class="form-control" placeholder="Digite o nome do produto" />
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
                Unidade
            </span>
            <input type="text" id="un" name="un" class="form-control" placeholder="Unidade do produto" />
        </div>
        <input type="submit" class="btn btn-primary" value="Enviar" />
    </form>
</div>
<script src="./validate.js"></script>
</body>

</html>