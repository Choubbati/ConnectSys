<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>login</title>
</head>






<body >




<nav class="navbar navbar-expand-lg navbar-light bg-success">
    <div class="container-fluid">
        <a class="navbar-brand text-white " href="index.php">ConnectSys</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

            <?php if($_SESSION['user']): ?>


                 <li class="nav-item">
                        <a class="nav-link text-white" href="profil.php">Profil : <?= htmlspecialchars($_SESSION['user']['username']) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="auth/logout.php">Se déconnecter</a>
                    </li>
                    <?php else: ?>
        <li class="nav-item me-2">
          <a href="auth/register.php" class="btn btn-danger">register</a>
        </li>
        <li class="nav-item me-2">
          <a href="auth/login.php" class="btn btn-outline-light">Login</a>
        </li>

     <?php endif ?>


            </ul>
        </div>
    </div>
</nav>












  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>