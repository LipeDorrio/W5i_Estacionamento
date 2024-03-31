<?php require_once ("../../configuracao.php"); ?>
<?php require_once ($path_inc . "/resources/topo.php"); ?>

<div class="container">
    <div>

        <div >

            <label for="formGroupExampleInput2" class="form-label">Categoria</label>
            <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Categoria">
            <label for="formGroupExampleInput2" class="form-label">Placa</label>
            <input style="width:100px" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Placa">

        </div>

    </div>

    <div class="button">

        <button type="button" class="btn btn-primary">Pesquisar</button>

    </div>

</div>

<div class="container">

    <div class="button">

        <a href="<?=$caminho?>telas/veiculo/cadastro.php"><button class="btn btn-primary">Novo Cadastro</button></a>

    </div>

</div>

<div class="container">

    <div class="table">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Placa</th>
                    <th scope="col"></th>

                </tr>
            </thead>

            <tbody>

                <tr>

                    <th scope="row">1</th>
                    <td>Carro</td>
                    <td>ABL7F25</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Editar</button>
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </td>

                </tr>

                <tr>

                    <th scope="row">2</th>
                    <td>Moto</td>
                    <td>ATG7J64</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Editar</button>
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </td>

                </tr>
                <tr>
                <th scope="row">3</th>
                    <td>Caminhão</td>
                    <td>BCD7A67</td>
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

    .button {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        align-items: right;
    }
</style>