<?php require_once ("../../configuracao.php"); ?>
<?php require_once ($path_inc . "/resources/topo.php"); ?>
<div class="container">
    <div>
        <div class="align">
            <label for="formGroupExampleInput2" class="form-label">Filtro</label>
            <input style="width :110px; height :40px" type="text" class="form-control" id="formGroupExampleInput2"
                placeholder="Filtro">
        </div>
    </div>
    <div class="button">
        <button type="button" class="btn btn-primary">Primary</button>
    </div>
</div>
<button style="align-itens: right" class="btn btn-primary">Teste</button>
<div class="table">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>


<?php require_once ($path_inc . "/resources/rodape.php"); ?>

<style>
    .container {
        width: 100vw;
        height: 100px;
        display: flex;
        flex-direction: row;
        justify-content: top;
        align-items: top;
        border: solid;
        border-radius: 20px;
        border-color: green;

    }
    .table{
       display: column;
       height: 100px;
       height: 100px;
    }
    .align {
        margin-top: 20px;
        display: flex;
        flex-direction: row;
        justify-content: right;
        align-items: right;
    }

    .button {
        display: flex;
        flex-direction: column;
        justify-content: right;
        align-items: ;
    }
</style>