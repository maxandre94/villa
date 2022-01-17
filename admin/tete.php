<!doctype html>
<html lang="fr">

<head>
    <title>Espace membre</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/css/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="home.php">Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>

        <ul class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color:white"><i class="fas fa-user fa-fw"
                        style="color: white;"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#change_password">Changer de
                            mot
                            passe</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Navigation</div>
                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fad fa-home"></i></div>
                            Home
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Vues
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="administrateur.php">
                                    <div class="sb-nav-link-icon"><i class="fas fas fa-key"></i></div>Administrateurs
                                </a>
                                <a class="nav-link" href="facture.php">
                                    <div class="sb-nav-link-icon"><i class="fas fas fa-poll-h"></i></div>Factures &
                                    details
                                </a>
                                <a class="nav-link" href="user.php">
                                    <div class="sb-nav-link-icon"><i class="fas fas fa-users"></i></div>Clients
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link" href="chambre.php">
                                    <div class="sb-nav-link-icon"><i class="fas fal fa-hotel"></i></div>Type de chambre
                                    -
                                    prix
                                </a>
                        
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Bonjour </div>
                    <?php echo mb_strtoupper($data['pseudo']); ?>
                </div>
            </nav>
        </div>

    </div>

    <div class="container">
        <div class="col-md-12">
            <?php
if (isset($_GET['err'])) {
    $err = htmlspecialchars($_GET['err']);
    switch ($err) {
        case 'current_password':
            echo "<div class='alert alert-danger'>Le mot de passe actuel est incorrect</div>";
            break;

        case 'success_password':
            echo "<div class='alert alert-success'>Le mot de passe a bien été modifié ! </div>";
            break;
    }
}
?>