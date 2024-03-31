<?php
$host = 'localhost';
$dbname = 'billing_db';
$username = 'root';
$password = '';
$servername = 'localhost';

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

try {
    // Проверка, существуют ли необходимые переменные, определенные в config.php
    if (!isset($host, $dbname, $username, $password)) {
        throw new Exception('Необходимые переменные для подключения к базе данных не определены.');
    }

    // Создаем PDO объект для подключения к базе данных
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clientIdBalance'], $_POST['addCorrection'], $_POST['clientCorrectionNew'])) {
        // Считываем данные из формы
        $clientEmail = $_POST['clientIdBalance'];
        $amount = (float)$_POST['addCorrection'];
        $correctionType = $_POST['clientCorrectionNew'];

        // Подготовка SQL запроса на основе типа корректировки
        if ($correctionType == "Увеличение баланса") {
            $sql = "UPDATE clients SET balance = balance + :amount WHERE email = :clientEmail";
        } elseif ($correctionType == "Уменьшение баланса") {
            $sql = "UPDATE clients SET balance = balance - :amount WHERE email = :clientEmail";
        } else {
            throw new Exception("Неверный тип корректировки.");
        }

        // Начинаем транзакцию
        $pdo->beginTransaction();

        // Подготовка и выполнение SQL запроса
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':clientEmail', $clientEmail, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_INT); // Используем PDO::PARAM_INT для числового значения
        $stmt->execute();

        // Подтверждение транзакции
        $pdo->commit();

        // Проверка, обновлен ли баланс клиента
        if ($stmt->rowCount() > 0) {
            echo "Баланс успешно скорректирован.";
            header("Location: main_window.php");
        } else {
            throw new Exception("Клиент с таким email не найден или баланс не был изменен.");
        }
    } else {
        throw new Exception("Некорректный запрос.");
    }
} catch (PDOException $e) {
    // Откатываем транзакцию, если ошибка базы данных и транзакция активна
    if ($pdo !== null && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Ошибка базы данных: " . $e->getMessage();
} catch (Exception $e) {
    // Откатываем транзакцию, если общая ошибка и транзакция активна
    if ($pdo !== null && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Ошибка: " . $e->getMessage();
}
?>
