<?php 

require __DIR__ . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Подключение к базе данных
$dsn = 'pgsql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . ';user=' . $_ENV['DB_USER'] . ';password=' . $_ENV['DB_PASSWORD'];
//$dsn = 'pgsql:host=$_ENV[DB_HOST];dbname=my_first_db;user=$_ENV[DB_USER];password=$_ENV[DB_PASSWORD]';
try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Подключение прошло успешло!';
} catch (PDOException $e) {
    echo 'Ошибка подключения: ' . $e->getMessage();
    exit;
}

// class Database {
//     private $pdo;

//     public function __construct() {
//         $dsn = 'pgsql:host=localhost;port=5432;dbname=my_database';
//         $username = 'my_user';
//         $password = 'my_password';

//         try {
//             $this->pdo = new PDO($dsn, $username, $password);
//             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             die("Ошибка подключения: " . $e->getMessage());
//         }
//     }

//     public function getConnection() {
//         return $this->pdo;
//     }
// }