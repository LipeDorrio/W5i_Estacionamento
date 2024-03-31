<?php require_once ("../../configuracao.php"); ?>
<?php require_once ($path_inc . "/resources/topo.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="text-center mb-5">Cadastro</h1>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Descrição" aria-label="Descrição"
                    aria-describedby="button-addon2">
            </div>
            <div class="text-center mb-3">
                <a href="<?= $caminho ?>telas/categoria/lista.php">
                    <button class="btn btn-primary" type="button" id="button-addon2">Cadastrar</button>
                </a>
            </div>
            <div class="text-center">
                <a href="<?= $caminho ?>telas/categoria/lista.php">
                    <button class="btn btn-secondary">Cancelar</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once ($path_inc . "/resources/rodape.php"); ?>

<style>
    .container {
        margin-top: 60px;
    }

    .input-group {
        margin-bottom: 20px;
    }
</style>