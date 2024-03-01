<?php
require 'banco.php';

$id = 0;

if(!empty($GET['id']))
{
    $id = $_REQUEST['id'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];

    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttributte(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM tb_aluno where id?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: index.php");

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Deletar Contato</title>
</head>
<body>
<div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well">Excluir Contato</h3>
            </div>
            <form class="form-horizontal" action="delete.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>" />
                <div class="alert alert-danger">Deseja excluir o contato?</div>
                <div class="form actions">
                    <button type="submit" class="btn btn-danger">Sim</button>
                    <a href="index.php" type="btn" class="btn btn-default">Não</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigos"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity=""></script>
    <!-- Latest compiled and minified Javascript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>