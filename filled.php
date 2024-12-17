<?php
require 'vendor/autoload.php';
include 'db.php';

$faker = Faker\Factory::create();

for ($i = 0; $i < 1000; $i++) {
    $name = $faker->words(3, true);
    $description = $faker->sentence(10);
    $price = $faker->randomFloat(2, 5, 100);
    $image_url = $faker->imageUrl(200, 200, 'product');

    $query = $pdo->prepare("INSERT INTO produits (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    $query->execute([$name, $description, $price, $image_url]);
}

echo "DB filled";
?>
