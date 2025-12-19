<?php
session_start();


include_once __DIR__ . '/config/database.php';
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}



    $user_id=$_SESSION['user']['id'];
    $message= "";



if (isset($_POST['submit'])) {
    $name    = trim($_POST['name']);
    $phone   = trim($_POST['tele']);
    $email   = trim($_POST['email']);
    $address = trim($_POST['address']);

    if (!empty($name) && !empty($phone) && !empty($email) && !empty($address)) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $sql = $pdo->prepare(
                "INSERT INTO contacts (user_id, name, phone, email, address)
                 VALUES (?, ?, ?, ?, ?)"
            );
            $sql->execute([$user_id, $name, $phone, $email, $address]);

            $message = "<div class='alert alert-success'>Contact ajouté avec succès</div>";

        } else {
            $message = "<div class='alert alert-danger'>Email invalide</div>";
        }

    } else {
        $message = "<div class='alert alert-danger'>Tous les champs sont obligatoires</div>";
    }
}


$sql = $pdo->prepare('SELECT * FROM contacts WHERE user_id = ? ORDER BY id DESC');
$sql->execute([$user_id]);
$contacts =$sql->fetchAll();

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




<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajouter un Contact</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
            <div class="col-md-12 " >
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Ajouter / Modifier contact
                    </div>

                    <div class="card-body">
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

      </div>

    </div>
  </div>
</div>




    

    <div class="container mt-6 ">

        <h3 class="mb-3">Mes contacts</h3>
                                <?= $message ?>


        <button type="button" class="btn btn-primary mx-auto m-2 " data-bs-toggle="modal"  data-bs-target="#staticBackdrop"> Ajouter Un Contact</button>
        <div class="row">

            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
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
                            <td><?= htmlspecialchars($c['name']) ?></td>
                            <td><?= htmlspecialchars($c['phone']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['address']) ?></td>
                            <td>

                                <a href="modifier.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning" data-bs-toggle="modal"  data-bs-target="#staticBackdrop1">Modifier</a>
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

            
            




<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modifier un Contact</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
            <div class="col-md-12 " >
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Modifier contact
                    </div>

                    <div class="card-body">

                    <php 
                            var_dump($_)
                    ?>
                        
                        <form method="GET">
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

                            <button type="submit" name="modifier" class="btn btn-success w-100">
                                Modifier
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

      </div>

    </div>
  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>