<?php require_once ("../../configuracao.php");?>
<?php require_once($path_inc."/resources/topo.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-4">Cadastro</h2>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Descrição" aria-label="Descrição" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="button" id="button-addon2">Cadastrar</button>
            </div>
        </div>
    </div>
</div>
<?php require_once($path_inc."/resources/rodape.php"); ?>
<style>

.container {
    margin-top: 50px;
}

.input-group {
    margin-bottom: 20px;
}
</style>