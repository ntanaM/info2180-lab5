<<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country']) && !empty(trim($_GET['country']))){
    $userQuery = $_GET['country'];

    if (isset($_GET['lookup']) && $_GET['lookup'] === 'city'){
        $stmt = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE :country");
        $stmt->bindValue(':country', '%'. $userQuery . '%', PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results != null){
            echo '<table class="userSearch">
            <thead>
            <tr>
            <th>City Name</th>
            <th>District</th>
            <th>Population</th>
            </tr>
            </thead>
            <tbody>';
            foreach($results as $row){
                echo '<tr>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . htmlspecialchars($row['district']) . '</td>
                <td>' . htmlspecialchars($row['population']) . '</td>
                </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "No cities found";
        }
    } else {
        # Country lookup
        $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
        $stmt->bindValue(':country', '%'. $userQuery . '%', PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results != null){
            echo '<table class="userSearch">
            <thead>
            <tr>
            <th>Country</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
            </tr>
            </thead>
            <tbody>';
            foreach($results as $row){
                echo '<tr>
                <td>' . htmlspecialchars($row['name']) . '</td>
                <td>' . htmlspecialchars($row['continent']) . '</td>
                <td>' . htmlspecialchars($row['independence_year']) . '</td>
                <td>' . htmlspecialchars($row['head_of_state']) . '</td>
                </tr>';
            }
            echo '</tbody></table>';
        } else {
            echo "Country not found";
        }
    }
} 

?>
