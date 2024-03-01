<?php
require 'banco.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nomeErro = null;
    $enderecoErro = null;
    $telefoneErro = null;
    $emailErro = null;
    $sexoErro = null;
    if (!empty($_POST)){
        $validacao = true;
        $novaUsuario = false;
        if (!empty($_POST['nome'])){
            $nome = $_POST['nome'];
        }else{
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(!empty($_POST['endereco'])){
            $endereco = $_POST['endereco'];
        }else{
            $enderecoErro = 'Por favor digite o seu endereço';
            $validacao = false;
        }
        if(!empty($_POST['telefone'])){
            $telefone = $_POST['telefone'];
        }else{
            $telefoneErro = 'por favor dogite o número de telefone';
            $validacao = false;
        }
        if(!empty($_POST['email'])){
            $email = $_POST['email'];
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $emailErro = 'Por favor digite um endereço de email válido';
                $validacao = false;
            }
        }else{
            $emailErro = 'Por favor digite um endereço de email';
            $validacao = false;
        }
        if (!empty($_POST['sexo'])){
            $sexo = $_POST['sexo'];
        }else{
            $sexoErro = 'Por favor selecione um campo!';
            $validacao = false;
        }
        
    }
    if($validacao){
        $pdp = Banco::conectar();
        $pdo->setAttribute(PDO::ATT_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO tb_aluno (nome, endereco, telefone, email, sexo) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $sexo));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Contato</title>
</head>
<body>
    <div class="conatiner">
        <div class="span10 offset1">
            <div class="card">
                <div class="card-hearder">
                    <h3 class="well">Adicionar Contato</h3>
                </div>
                <div class="card-body">
                    <form action="create.php" method="post" class="form-horizontal">
                        <div class="control-group <?php echo !empty($nomeErro) ?'error' : ''; ?>">
                             <label class="control-label">Nome</label>
                            <div class="controls">
                                <input type="text" name="nome" placeholder="Nome" size="50" class="form-control"
                                       value="<?php echo !empty($nome) ? $nome : '' ; ?>">
                                <?php if (!empty($nomeErro)):?>
                                    <span class="text-danger"><?php echo $nomeErro; ?></span>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="control-group <?php echo !empty($enderecoErro) ? 'error' :'';?>">
                             <label class="control-label">Endereço</label>
                            <div class="controls">
                                <input type="text" size="80" class="form-control" placeholder="Endereço"
                                       value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                                <?php if (!empty($emailErro)):?>
                                    <span class="text-danger"><?php echo $enderecoErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group <?php echo !empty($telefoneErro) ? 'error':''; ?>">
                            <label class="control-label">Telefone</label>
                            <div class="controls">
                                <input size="35" class="form-control" name="telefone" type="text" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone: ''; ?>">
                                <?php if (!empty($telefoneErro)): ?>
                                     <span class="text-danger"><?php echo $telefoneErro; ?></span>
                                 <?php endif; ?>
                             </div>
                        </div>

                        <div class="control-group <?php echo !empty($emailErro) ? '$emailErro':''; ?>">
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <input size="40" class="form-control" name="email" type="text" placeholder="Email" value="<?php echo !empty($email) ? $email: ''; ?>">
                                <?php if (!empty($emailErro)): ?>
                                    <span class="text-danger"><?php echo $emailErro; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="control-group <?php !empty($sexoErro) ? 'echo($sexoErro)': ''; ?>">
                            <div class="controls">
                                <label class="control-label">Sexo</label>
                                <div class="form-check">
                                    <p class="form-check-label">
                                       <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "M" ? "checked": null; ?>/>
                                        Masculino
                                    </p>
                                </div>
                                <div class="form-check">
                                    <p class="form-check-label">
                                        <input class="form-check-input" id="sexo" name="sexo" type="radio" value="F" <?php isset($_POST["sexo"]) && $_POST["sexo"] == "F" ? "checked": null; ?>/>
                                        Feminino
                                    </p>
                                </div>
                            </div>
                            </div>
                            <?php if (!empty($sexoErro)): ?>
                                <span class="help-inline text-danger"><?php echo $sexoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/18WvCWPIPm49" 
        crossorigin="anonymous"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>