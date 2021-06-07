<html>

<head>
    <link href="<?php echo URLROOT ?>/public/css/navegation/styles.css" rel="stylesheet" type="text/css">
</head>

<?php
$url = $_SERVER['REQUEST_URI'];
$cuts = explode("/", $url);


if (isset($cuts[2]) == false) {
    $nav_page = 'index';
} else {
    $nav_page = $cuts[2];
}
?>

<nav class="navbar navbar-dark bg-dark navbar-fixed-left d-flex align-items-start">
    <div class="container-fluid">
        <a class="navbar-brand border-bottom w-100 mb-4 text-center" href="#">
            <img src="http://salemadvogados.com/wp-content/uploads/2019/12/icone-principal-plano-de-saude-150x150.png" alt="" width="60" height="60" class="d-inline-block align-text-top mb-2">
        </a>

        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?php if ($nav_page == 'index') {
                                        echo 'active';
                                    } ?> h4" aria-current="page" href="<?php echo URLROOT; ?>/index">
                    <i class="material-icons">home</i> Início
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($nav_page == 'users') {
                                        echo 'active';
                                    } ?> h4" href="<?php echo URLROOT; ?>/users/list">
                    <i class="material-icons">group</i> Usuários
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if ($nav_page == 'boards') {
                                        echo 'active';
                                    } ?> h4" href="<?php echo URLROOT; ?>/index">
                    <i class="material-icons">developer_board</i> Placas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link h4" href="<?php echo URLROOT; ?>/pages/logout">
                    <i class="material-icons">logout</i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

</html>