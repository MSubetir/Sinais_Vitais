<?php
require APPROOT . '/views/includes/head.php';

?>

<html>
<body class="bg-primary d-flex justify-content-center align-items-center">
    <div class="card col-md-4">
        <h5 class="card-header text-center text-primary">Login</h5>
        <div class="card-body">
            <?php
            if ($data['Error']):
            ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $data['Error']; ?>
                </div>
            <?php
            endif;
            ?>

            <form class="col-md-12" action="<?php echo URLROOT; ?>/pages/login" method="POST">

                <div class="mb-3">
                    <label for="username" class="form-label ">Usuário (admin)</label>
                    <input name="username" name="text" class="form-control">

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha (123456)</label>
                    <input name="password" type="password" class="form-control" id="password">
                </div>
                
                <button type="submit" value="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>