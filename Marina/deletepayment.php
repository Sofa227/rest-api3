<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'config.php';

// Обработка удаления последнего платежа
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение значения email из формы
    $email = $_POST['clientEmail']; // Поле с идентификатором клиента

    // Проверка, какая кнопка была нажата
    if (isset($_POST['deletePayment'])) {
        // Удаление последнего платежа
        $sql = "UPDATE clients SET n_p_type = NULL WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            echo "Последний платеж успешно удален.";
            header('Location: main_window.php');

        } else {
            echo "Ошибка при удалении платежа: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['deleteExpense'])) {
        // Удаление последнего расхода
        $sql = "UPDATE clients SET n_service = NULL WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            echo "Последний расход успешно удален.";
            header('Location: main_window.php');
        } else {
            echo "Ошибка при удалении расхода: " . mysqli_error($conn);
        }

    } elseif (isset($_POST['addPayment'])) {
        // Получаем значение из формы
        $paymentType = trim($_POST['clientPaymentNew']);
        $amount = $_POST['addIngo'];
    
        // Получаем текущий баланс клиента
        $query_balance = "SELECT balance FROM clients WHERE email = '$email'";
        $result_balance = mysqli_query($conn, $query_balance);
        $row_balance = mysqli_fetch_assoc($result_balance);
        $current_balance = $row_balance['balance'];
    
        // Обновляем столбец n_p_type в таблице clients
        $sql_update = "UPDATE clients SET n_p_type = '$paymentType', balance = $current_balance + $amount WHERE email = '$email'";
        if (mysqli_query($conn, $sql_update)) {
            echo "Столбец n_p_type успешно обновлен, баланс обновлен.";
            header('Location: main_window.php');
        } else {
            echo "Ошибка при обновлении столбца n_p_type: " . mysqli_error($conn);
        }

    } 
    elseif (isset($_POST['AddExpense'])) {
        // Получаем значение из формы
        $expenseType = trim($_POST['clientServiceNew']);
        $amount = $_POST['addOutgo'];
    
        // Получаем текущий баланс клиента
        $query_expense = "SELECT expense FROM clients WHERE email = '$email'";
        $result_expense = mysqli_query($conn, $query_expense);
        $row_expense = mysqli_fetch_assoc($result_expense);
        $current_expense = $row_expense['expense'];
    
        // Обновляем столбец n_service в таблице clients
        $sql_update = "UPDATE clients SET n_service = '$expenseType', expense = $current_expense + $amount WHERE email = '$email'";
        if (mysqli_query($conn, $sql_update)) {
            echo "Столбец n_service успешно обновлен, баланс обновлен.";
            header('Location: main_window.php');
        } else {
            echo "Ошибка при обновлении столбца n_service: " . mysqli_error($conn);
        }
    } 
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>