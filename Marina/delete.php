<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'config.php';

// Проверяем, был ли запрос на удаление клиента
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем email клиента, которого нужно удалить
    $clientEmail = $_POST['clientEmail'];

    // Начинаем транзакцию
    $conn->begin_transaction();

    // SQL запросы для удаления клиента из всех дочерних таблиц
    $sql_delete_birthdates = "DELETE FROM clientbirthdates WHERE email = '$clientEmail'";
    $sql_delete_contacts = "DELETE FROM clientcontacts WHERE email = '$clientEmail'";
    $sql_delete_addresses = "DELETE FROM clientaddresses WHERE email = '$clientEmail'";
    $sql_delete_phone = "DELETE FROM clientphone WHERE email = '$clientEmail'";
    $sql_delete_names = "DELETE FROM clientnames WHERE email = '$clientEmail'";
    // Дополнительные запросы на удаление из других дочерних таблиц по аналогии...

    // Выполняем запросы на удаление из дочерних таблиц
    if ($conn->query($sql_delete_birthdates) === TRUE &&
        $conn->query($sql_delete_contacts) === TRUE &&
        $conn->query($sql_delete_addresses) === TRUE &&
        $conn->query($sql_delete_phone) === TRUE &&
        $conn->query($sql_delete_names) === TRUE /*&& другие запросы на удаление из дочерних таблиц*/) {
        // Если удаление из дочерних таблиц прошло успешно, удаляем записи из основной таблицы `clients`
        $sql_delete_clients = "DELETE FROM clients WHERE email = '$clientEmail'";

        // Выполняем запрос на удаление из основной таблицы
        if ($conn->query($sql_delete_clients) === TRUE) {
            // Если удаление из основной таблицы также прошло успешно, удаляем запись из таблицы `clientemails`
            $sql_delete_emails = "DELETE FROM clientemails WHERE email = '$clientEmail'";

            if ($conn->query($sql_delete_emails) === TRUE) {
                // Если удаление из таблицы `clientemails` прошло успешно, фиксируем изменения
                $conn->commit();
                echo "Запись успешно удалена";
                header("Location: main_window.php"); // Перенаправляем пользователя обратно на главную страницу после удаления
            } else {
                // Если удаление из таблицы `clientemails` не удалось, откатываем транзакцию
                $conn->rollback();
                echo "Ошибка при удалении записи из таблицы clientemails: " . $conn->error;
            }
        } else {
            // Если удаление из основной таблицы `clients` не удалось, откатываем транзакцию
            $conn->rollback();
            echo "Ошибка при удалении записей из таблицы clients: " . $conn->error;
        }
    } else {
        // Если удаление из дочерних таблиц не удалось, откатываем транзакцию
        $conn->rollback();
        echo "Ошибка при удалении записей из дочерних таблиц: " . $conn->error;
    }
}

$conn->close();
?>
