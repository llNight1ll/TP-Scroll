<?php
$host = 'localhost';
$db = 'projet';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $limit = 3;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $stmt = $pdo->prepare("SELECT * FROM produits LIMIT :offset, :limit");
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
        <div class='card'>
            <h2>" . htmlspecialchars($row['name']) . "</h2>
            <p>" . htmlspecialchars($row['description']) . "</p>
            <p><strong>Prix :</strong> " . htmlspecialchars($row['price']) . " €</p>
            <img src='" . htmlspecialchars($row['image_url']) . "' alt='Image du produit' style='max-width: 100%; height: auto;'>
        </div>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
