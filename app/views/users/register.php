<?php
require APPROOT . '/views/includes/head.php';
?>

<html>
<?php
require APPROOT . '/views/includes/navigation.php';
?>


<body>

    <div class="container mt-2">
        <div class="card col-md-12 py-2 px-4">

            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none " href="<?php echo URLROOT; ?>/index">Início</a></li>
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="<?php echo URLROOT; ?>/users/list">Usuários</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                </ol>
            </nav>


        </div>

        <form class="row g-3" action="<?php echo URLROOT; ?>/users/register" method="POST">
            <div class="col-8">
                <label for="inputEmail4">Nome</label>
                <input name="name" type="name" class="form-control" placeholder="Nome Completo" required>
            </div>

            <div class="col-4">
                <label for="inputBirthday">Nascimento</label>
                <input name="nascimento" value="2000-01-01" type="date" id="birthday" class="form-control" id="inputBirthday" name="birthday" required>
            </div>



            <div class="col-6">
                <label for="inputEmail4">E-mail</label>
                <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="E-mail (opcional)">
            </div>

            <div class="col-6">
                <label for="inputEmail4">Telefone</label>
                <input name="telefone" type="number" class="form-control" id="inputEmail4" placeholder="Telefone" required>
            </div>

            <div class="col-6">
                <label for="inputAddress" class="form-label">Rua</label>
                <input name="rua" type="text" class="form-control" id="inputAddress" placeholder="Rua" required>
            </div>

            <div class="col-6">
                <label for="inputEmail4" class="form-label">Número</label>
                <input name="numero" type="number" class="form-control" placeholder="Número" required>
            </div>

            <div class="col-6">
                <label for="inputCity" class="form-label">Cidade</label>
                <input name="cidade" type="text" class="form-control" placeholder="Cidade" id="inputCity" aria-label="Cidade" required>
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Estado</label>
                <input name="estado" type="text" class="form-control" placeholder="Estado" aria-label="Estado" required>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">CEP</label>
                <input name="cep" type="text" class="form-control" placeholder="CEP" id="inputZip" aria-label="CEP" required>
            </div>

            <span class="invalidFeedback">
                <?php echo $data['erro']; ?>
            </span>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>

</body>

</html>