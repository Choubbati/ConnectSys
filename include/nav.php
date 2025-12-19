
<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white " href="index.php">ConnectSys</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profil.php">Profil : <?= htmlspecialchars($_SESSION['user']['username']) ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="auth/logout.php">Se déconnecter</a>
                    </li>
                <?php else: ?>
        <li class="nav-item me-2">
          <a href="auth/login.php" class="btn btn-outline-light">Login</a>
        </li>

     
        <li class="nav-item">
          <a href="register.php" class="btn btn-danger">register</a>
        </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
