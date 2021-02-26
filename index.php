<?php


$DB_NAME = 'TestPDO';
$DB_USER = 'root';
$DB_PASSWORD = 'root';
$DB_HOST = 'localhost';


// Création BDD
try{
    $dbco = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PASSWORD);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
    $dbco->exec($sql);

}

catch(PDOException $e){
    echo "Erreur : " . $e->getMessage();
  }

// Création des tables
try{
    $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE TABLE IF NOT EXISTS Telephone(
            IdTelephone INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Langues VARCHAR(30) NOT NULL,
            Marques VARCHAR(30) NOT NULL
            )";
    
    $sql2 = "CREATE TABLE IF NOT EXISTS QRCode(
        IdCode INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Nom VARCHAR(30) NOT NULL,
        Url VARCHAR(30) NOT NULL,
        IdTable INT NOT NULL
        )";
    
    $sql3 = "CREATE TABLE IF NOT EXISTS TABLES(
        IdTable INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Situation VARCHAR(30) NOT NULL,
        Emplacement VARCHAR(30) NOT NULL,
        NbrChaise INT NOT NULL
        )";

    $sql4 = "CREATE TABLE IF NOT EXISTS Flasher(
    IdTelephone INT NOT NULL,
    IdTable INT NOT NULL,
    IdCode INT NOT NULL,
    Dateflash DATE NOT NULL
    )";


    $dbco->exec($sql);
    $dbco->exec($sql2);
    $dbco->exec($sql3);
    $dbco->exec($sql4);
}

catch(PDOException $e){
  echo "Erreur : " . $e->getMessage();
}

// Requete SQL flash
$nbr_de_flash_an  = "SELECT COUNT(IdCode) FROM Flasher WHERE Dateflash BETWEEN '2021-01-01' AND '2021-12-31' ";
$nbr_de_flash_trimestre  = "SELECT COUNT(IdCode) FROM Flasher WHERE Dateflash BETWEEN '2021-01-01' AND '2021-03-01' ";
$nbr_de_flash_mois  = "SELECT COUNT(IdCode) FROM Flasher WHERE Dateflash BETWEEN '2021-02-01' AND '2021-02-28' ";
$nbr_de_flash_semaine  = "SELECT COUNT(IdCode) FROM Flasher WHERE Dateflash BETWEEN '2021-02-22' AND '2021-02-28' ";


$stmt = $nbr_de_flash_an;
$stmt2 = $nbr_de_flash_trimestre;
$stmt3 = $nbr_de_flash_mois;
$stmt4 = $nbr_de_flash_semaine;

// Requete SQL Table
$table_plus_utilisé_an = "SELECT IdTable
FROM Flasher
WHERE Dateflash BETWEEN '2021-01-01' AND '2021-12-31'
GROUP BY IdTable
ORDER BY COUNT(IdTable) DESC
LIMIT 1
";

$table_plus_utilisé_trimestre = "SELECT IdTable
FROM Flasher
WHERE Dateflash BETWEEN '2021-01-01' AND '2021-03-01'
GROUP BY IdTable
ORDER BY COUNT(IdTable) DESC
LIMIT 1
";

$table_plus_utilisé_mois = "SELECT IdTable
FROM Flasher
WHERE Dateflash BETWEEN '2021-02-01' AND '2021-02-28'
GROUP BY IdTable
ORDER BY COUNT(IdTable) DESC
LIMIT 1
";

$table_plus_utilisé_semaine = "SELECT IdTable
FROM Flasher
WHERE Dateflash BETWEEN '2021-02-22' AND '2021-02-28'
GROUP BY IdTable
ORDER BY COUNT(IdTable) DESC
LIMIT 1
";

$table_plus_utilisé_jour = "SELECT IdTable
FROM Flasher
WHERE Dateflash BETWEEN '2021-01-01' AND '2021-12-31'
GROUP BY IdTable
ORDER BY COUNT(IdTable) DESC
LIMIT 1
";

$stmt5 = $table_plus_utilisé_an;
$stmt6 = $table_plus_utilisé_trimestre;
$stmt7 = $table_plus_utilisé_mois;
$stmt8 = $table_plus_utilisé_semaine;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0c87a70838.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Données - Restaurant</title>
</head>
<body>
    <canvas id="canvas"></canvas>
    <div id="background" class="background">
        <div class="image">
            <img src="images/hamburger.svg" alt="Un hamburger et un homme" id='img'>
        </div>
        <div class="container">
            <h1>Retrouvez vos données ci-dessous</h1>
            <button  id="firstButton" class="question1">Quelle est la table la plus utilisée...</button>
            <div class="firstButtonAnswers">
            <table class="fl-table">
        <thead>
        <tr>
            <th colspan = '5'>2021</th>
        </tr>
        <tr class="second_linetr">
            <th>Année</th>
            <th>Trimestre</th>
            <th>Mois</th>
            <th>Semaine</th>
            <th>Aujourd'hui</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
            <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt5 = $dbco->query($table_plus_utilisé_an);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt5->fetch(PDO::FETCH_ASSOC)):
                        echo $row['IdTable'];
                    endwhile;
                        ?>
            </td>
            <td>
            <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt6 = $dbco->query($table_plus_utilisé_an);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt6->fetch(PDO::FETCH_ASSOC)):
                        echo $row['IdTable'];
                    endwhile;
                        ?>
            </td>
            <td>
            <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt7 = $dbco->query($table_plus_utilisé_an);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt7->fetch(PDO::FETCH_ASSOC)):
                        echo $row['IdTable'];
                    endwhile;
                        ?>
            </td>
            <td>
            <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt5 = $dbco->query($table_plus_utilisé_an);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt5->fetch(PDO::FETCH_ASSOC)):
                        echo $row['IdTable'];
                    endwhile;
                        ?>
            </td>
            <td>Content 1</td>
        </tr>
        </table>
        <table class="fl-table">
        <thead>
        <tr>
            <th colspan = '5'>2020</th>
        </tr>
        <tr class="second_linetr">
            <th>Année</th>
            <th>Trimestre</th>
            <th>Mois</th>
            <th>Semaine</th>
            <th>Aujourd'hui</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
        </tr>
    </table>
            </div>
            <button id="secondButton" class="question2">Nombre de flash...</button>
            <div class="secondButtonAnswers">
            <table class="fl-table2">
            <thead>
        <tr>
            <th colspan = '5'>2021</th>
        </tr>
        <tr class="second_linetr">
            <th>Année</th>
            <th>Trimestre</th>
            <th>Mois</th>
            <th>Semaine</th>
            <th>Aujourd'hui</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <!-- Flash Année -->
            <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $dbco->query($nbr_de_flash_an);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                        echo $row['COUNT(IdCode)'];
                    endwhile;
                        ?>
            </td>
            <td>
                <!-- Flash Trimestre -->
                <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt2 = $dbco->query($nbr_de_flash_trimestre);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt2->fetch(PDO::FETCH_ASSOC)):
                        echo $row['COUNT(IdCode)'];
                    endwhile;
                        ?></td>
            <td>
                <!-- Flash Mois -->
                <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt3 = $dbco->query($nbr_de_flash_mois);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt3->fetch(PDO::FETCH_ASSOC)):
                        echo $row['COUNT(IdCode)'];
                    endwhile;
                        ?></td>
            <td>
            <?php
                        try{
                            $dbco = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
                            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt4 = $dbco->query($table_plus_utilisé_an);
                        }
                              
                        catch(PDOException $e){
                            echo "Erreur : " . $e->getMessage();
                        }

                        while($row = $stmt4->fetch(PDO::FETCH_ASSOC)):
                        echo $row['IdTable'];
                    endwhile;
                        ?>
            </td>
            <td>Content 1</td>
        </tr>
        </table>
        <table class="fl-table2">
        <thead>
        <tr>
            <th colspan = '5'>2020</th>
        </tr>
        <tr class="second_linetr">
            <th>Année</th>
            <th>Trimestre</th>
            <th>Mois</th>
            <th>Semaine</th>
            <th>Aujourd'hui</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
            <td>Content 1</td>
        </tr>
      
            </table>
                
            </div>
        </div>
<script src="js/script.js"></script>
</body>
</html>