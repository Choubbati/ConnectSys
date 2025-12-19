<?php
session_start();


include_once __DIR__ . '/config/database.php';
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;

}

$id =  $_GET['id'];
$user_id = $_SESSION['user']['id'];


$sqlState = $pdo->prepare('SELECT FFROM contacts WHERE id=? AND user_id= ?');
$sqlState->execute([$id,$user_id]);
var_dump($sqlState->fetch());

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <?php include_once 'include/nav.php'; ?>


    <div class="container mt-4">

        <h3 class="mb-3">Mes contacts</h3>

        <div class="row">

            <div class="col-md-7">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (empty($contacts)): ?>

                        <tr>
                            <td colspan="4" class="text-center">Aucun contact</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach($contacts as $c): ?>
                        <tr>
                            <td></td>
                            <td>
                            <td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>

                                <a href="" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="suprimer.php?id=<?= $c['id'] ?>"
                                    onclick="return confirm('Voulez-vous vraiment supprimer le contact <?= htmlspecialchars($c['name']) ?> ?')"
                                    class="btn btn-sm btn-danger">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>
                </table>
            </div>


            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Ajouter / Modifier contact
                    </div>

                    <div class="card-body">


                        <?= $message ?>

                        <form method="POST">



                            <div class="mb-3">
                                <label class="form-label">Nom *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" name="tele" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adresse</label>
                                <textarea name="address" class="form-control"></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn btn-success w-100">
                                Enregistrer
                            </button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>