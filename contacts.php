<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: auth/login.php");
    exit;
}

require 'database/connextion.php';

$user_id = $_SESSION['user']['id'];

$sql = $pdo->prepare("SELECT * FROM contacts WHERE user_id = ? ORDER BY id DESC");
$sql->execute([$user_id]);
$contacts = $sql->fetchAll(PDO::FETCH_ASSOC);

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php require 'includes/nav.php'; ?>

<div class="container mt-4">
    <h3>Mes contacts</h3>
    <?= $message ?>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addContact">
        Ajouter un contact
    </button>

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
                <td colspan="5" class="text-center">Aucun contact</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($contacts as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td><?= htmlspecialchars($c['phone']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['address']) ?></td>
                <td>
                    <button class="btn btn-warning btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editContact"
                        data-id="<?= $c['id'] ?>"
                        data-name="<?= htmlspecialchars($c['name']) ?>"
                        data-phone="<?= htmlspecialchars($c['phone']) ?>"
                        data-email="<?= htmlspecialchars($c['email']) ?>"
                        data-address="<?= htmlspecialchars($c['address']) ?>">
                        Modifier
                    </button>

                    <a href="auth/crud.php?delete=<?= $c['id'] ?>"
                       onclick="return confirm('Supprimer ce contact ?')"
                       class="btn btn-danger btn-sm">
                       Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<div class="modal fade" id="addContact" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="auth/crud.php" class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Ajouter un contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="text" name="name" class="form-control mb-2" placeholder="Nom" required>
        <input type="text" name="phone" class="form-control mb-2" placeholder="Téléphone" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <textarea name="address" class="form-control" placeholder="Adresse" required></textarea>
      </div>

      <div class="modal-footer">
        <button type="submit" name="add" class="btn btn-primary">Ajouter</button>
      </div>

    </form>
  </div>
</div>

<div class="modal fade" id="editContact" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="auth/crud.php" class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Modifier contact</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="id" id="edit-id">

        <input type="text" name="name" id="edit-name" class="form-control mb-2" required>
        <input type="text" name="phone" id="edit-phone" class="form-control mb-2" required>
        <input type="email" name="email" id="edit-email" class="form-control mb-2" required>
        <textarea name="address" id="edit-address" class="form-control" required></textarea>
      </div>

      <div class="modal-footer">
        <button type="submit" name="update" class="btn btn-success">Modifier</button>
      </div>

    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
const editModal = document.getElementById('editContact');
editModal.addEventListener('show.bs.modal', function (event) {
    const btn = event.relatedTarget;

    document.getElementById('edit-id').value = btn.getAttribute('data-id');
    document.getElementById('edit-name').value = btn.getAttribute('data-name');
    document.getElementById('edit-phone').value = btn.getAttribute('data-phone');
    document.getElementById('edit-email').value = btn.getAttribute('data-email');
    document.getElementById('edit-address').value = btn.getAttribute('data-address');
});
</script>

</body>
</html>
