<?php require_once ("../../configuracao.php"); ?>
<?php require_once ($path_inc . "/resources/topo.php"); ?>

<div class="container">
    <div>

        <div class="align">

            <label for="formGroupExampleInput2" class="form-label">Pesquisa</label>
            <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2"
                placeholder="Descrição">

        </div>

    </div>

    <div class="button">

        <button type="button" class="btn btn-primary">Pesquisar</button>

    </div>

</div>

<div class="container">

    <div class="">

        <button style="align-itens: right" class="btn btn-primary">Novo Cadastro</button>

    </div>


</div>

<div class="container">

    <div class="table">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Descrição</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody>

                <tr>

                    <th scope="row">1</th>
                    <td>Carro</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Editar</button>
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </td>


                </tr>

                <tr>

                    <th scope="row">2</th>
                    <td>Moto</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Editar</button>
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </td>

                </tr>
                <tr>
                <th scope="row">3</th>
                    <td>Caminhão</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Editar</button>
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>


<?php require_once ($path_inc . "/resources/rodape.php"); ?>

<style>
    .container {
        padding: 5px;
        display: column;
        flex-direction: row;
        align-items: flex-start;
    }

    .table {
        width: 100%;
        display: column;
    }

    .align {
        margin-top: 20px;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        /* Alinha à direita */
        align-items: right;
    }

    .button {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        /* Alinha à direita */
        align-items: right;
    }
</style>