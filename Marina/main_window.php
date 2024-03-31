<?php include 'get_inf.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Биллинговая система</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="background_color">
        <div class="wrapper" id="header_div">
            <nav class="exit-nav">
                <li><a class="cd-exit" id="cd-exit-id" href="exit.php" >Выход</a></li>
            </nav>
        </div>
    </header>

    <main>
    <div class="wrapper">
        <h2>Добавление клиента</h2>
        <form id="addClientForm" action="send_bd.php" method="POST">
            <p><input type="text" id="clientOrganisation" name="clientOrganisation" placeholder="Название организации"></p>

            <input type="text" id="clientName" name="clientName" placeholder="Имя клиента">

            <input type="text" id="clientSurname" name="clientSurname" placeholder="Фамилия клиента">

            <input type="text" id="clientPatronymic" name="clientPatronymic" placeholder="Отчество клиента">

            <p><input type="tel" id="clientTelephon" name="clientTelephon" placeholder="Номер телефона">

            <input type="email" id="clientEmail" name="clientEmail" placeholder="Email">

            <input type="date" id="clientDateOfBirth" name="clientDateOfBirth" placeholder="Дата рождения"></p>

            <p><input type="text" id="clientAddress" name="clientAddress" placeholder="Адрес подключения"></p>

            <p><button type="submit" class="submit">Добавить клиента</button></p>
        </form>
        
        <h2>Изменение информации о клиенте</h2>
        <form id="updateClientForm" action="change-add.php" method="POST">
            <input type="text" id="clientEmail" name="clientEmail" placeholder="Email клиента">

            <p>
                <select name="clientBalance" id="clientBalance">
                    <option value="">-- Баланс --</option>
                    <option value="Положительный баланс">Положительный баланс</option>
                    <option value="Отрицательный баланс">Отрицательный баланс</option>
                </select>
            </p>

            <p>
                <select name="clientCorrection" id="clientCorrection">
                    <option value="">-- Корректировка --</option>
                    <option value="Увеличение баланса">Увеличение баланса</option>
                    <option value="Уменьшение баланса">Уменьшение баланса</option>
                </select>
            </p>

            <p>
                <input type="number" min="-1000" id="clientLimit" name="clientLimit" placeholder="Лимит">
            </p>

            <p>
                <select name="clientStatus" id="clientStatus">
                    <option value="">-- Статус --</option>
                    <option value="Подключение">Подключение</option>
                    <option value="Активен">Активен</option>
                    <option value="Блокировка">Блокировка</option>
                    <option value="Расторгнут">Расторгнут</option>
                </select>
            </p>

            <p>
                <select name="clientType" id="clientType">
                    <option value="">-- Тип --</option>
                    <option value="Физическое лицо">Физическое лицо</option>
                    <option value="Юридическое лицо">Юридическое лицо</option>
                </select>
            </p>

            <p>
                <select name="clientPayment" id="clientPayment">
                    <option value="">-- Поступивший платеж --</option>
                    <option value="QR-код">QR-код</option>
                    <option value="Автоплатеж">Автоплатеж</option>
                    <option value="Банковский платеж">Банковский платеж</option>
                    <option value="Наличный платеж">Наличный платеж</option>
                    <option value="Оплата картой">Оплата картой</option>
                    <option value="Платеж «Почта России»">Платеж «Почта России»</option>
                    <option value="Сбер-онлайн">Сбер-онлайн</option>
                    <option value="СБП">СБП</option>
                </select>
            </p>

            <p>
                <input type="number" min="0" id="clientOutgoes" name="clientOutgoes" placeholder="Расходы денежных средств">
            </p>

            <p>
                <select name="clientService" id="clientService">
                    <option value="">-- Услуги с периодом списания денежных средств --</option>
                    <option value="Видеонаблюдение">Услуга – Видеонаблюдение</option>
                    <option value="Домофония">Услуга – Домофония</option>
                    <option value="Интернет">Услуга – Интернет</option>
                    <option value="Оборудование">Услуга – Оборудование</option>
                    <option value="Подписка на программное обеспечение">Услуга – Подписка на программное обеспечение</option>
                    <option value="Телевидение">Услуга – Телевидение</option>
                    <option value="Телефонная связь">Услуга – Телефонная связь</option>
                    <option value="Хостинг веб-ресурсов">Услуга – Хостинг веб-ресурсов</option>
                </select>
            </p>

            <button type="submit">Добавить информацию</button>
        </form>
        
        <h2>Удаление клиента</h2>
        <form id="deleteClientForm" action="delete.php" method="POST">
            <input type="text" id="clientEmail" name="clientEmail" placeholder="Email клиента для удаления">
            <p><button type="submit">Удалить клиента</button></p>
        </form>
        
        <h2>Управление платежами и расходами</h2>
        <form id="managePaymentsForm" action="deletepayment.php" method="POST">
            <input type="text" id="clientEmail" name="clientEmail" placeholder="Email клиента">
            <p>
                <button type="submit" name="deletePayment">Удалить последний платеж</button>
            
                <button type="submit" name = "deleteExpense">Удалить последний расход</button>
            </p>
            <p>
                <select name="clientPaymentNew" id="clientPaymentNew" >
                    <option value="Поступивший платеж">-- Поступивший платеж --</option>
                    <option value="QR-код">QR-код</option>
                    <option value="Автоплатеж">Автоплатеж</option>ъъ
                    <option value="Банковский платеж">Банковский платеж</option>
                    <option value="Наличный платеж">Наличный платеж</option>
                    <option value="Оплата картой">Оплата картой</option>
                    <option value="Платеж «Почта России»">Платеж «Почта России»</option>
                    <option value="Сбер-онлайн">Сбер-онлайн</option>
                    <option value="СБП">СБП</option>
                </select>
                <input type="number" min="0" id="addIngo" name="addIngo" placeholder="Сумма платежа">
                <p><button type="submit" name ="addPayment">Добавить платеж</button></p>
            </p>
            <p>
                <select name="clientServiceNew" id="clientServiceNew" >
                    <option value="Услуги с периодом списания денежных средств">-- Услуги с периодом списания денежных средств --</option>
                    <option value="Видеонаблюдение">Услуга – Видеонаблюдение</option>
                    <option value="Домофония">Услуга – Домофония</option>
                    <option value="Интернет">Услуга – Интернет</option>
                    <option value="Оборудование">Услуга – Оборудование</option>
                    <option value="Подписка на программное обеспечение">Услуга – Подписка на программное обеспечение</option>
                    <option value="Телевидение">Услуга – Телевидение</option>
                    <option value="Телефонная связь">Услуга – Телефонная связь</option>
                    <option value="Хостинг веб-ресурсов">Услуга – Хостинг веб-ресурсов</option>
                </select>
                <input type="number" min="0" id="addOutgo" name="addOutgo" placeholder="Сумма расхода">
                <p><button type="submit" name="AddExpense">Добавить расход</button></p>
            </p>
        </form>
        
        <h2>Корректировка баланса счета клиента</h2>
        <form id="adjustBalanceForm" action="adjust_balance.php" method="POST">
            <input type="text" id="clientIdBalance" name="clientIdBalance" placeholder="Email клиента">
            <p><input type="number" min="0" id="addCorrection" name="addCorrection" placeholder="Сумма корректировки">
            <select name="clientCorrectionNew" id="clientCorrectionNew" >
                    <option value="clientCorrectionNew0">-- Корректировка --</option>
                    <option value="Увеличение баланса">Увеличение баланса</option>
                    <option value="Уменьшение баланса">Уменьшение баланса</option>
            </select></p>
            <p><button type="submit">Корректировать баланс</button></p>
        </form>
        
        <h2>Получение информации о текущем статусе клиента</h2>
        <form id="getClientStatusForm" action="receive_inf.php" onsubmit="return getClientInfo()">
            <input type="email" id="email" name="email" placeholder="Email клиента">
            <button type="submit">Получить статус клиента</button>
            <p><textarea id="infoClientStatus" name="newInfo" readonly></textarea></p>
        </form>


        <script>
        function getClientInfo() {
            // Получаем email клиента из поля ввода
            var email = document.getElementById("email").value;

            // Создаем объект XMLHttpRequest для выполнения запроса к серверу
            var xhr = new XMLHttpRequest();

            // Устанавливаем обработчик события загрузки
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Если запрос выполнен успешно, обновляем содержимое textarea
                    document.getElementById("infoClientStatus").value = xhr.responseText;
                } else {
                    // Если возникла ошибка, выводим сообщение об ошибке
                    alert('Request failed. Status: ' + xhr.status);
                }
            };

            // Формируем URL для запроса к серверу, добавляем параметр email
            var url = 'get_inf.php?email=' + encodeURIComponent(email);

            // Открываем соединение и отправляем запрос к серверу
            xhr.open('GET', url, true);
            xhr.send();

            // Возвращаем false, чтобы предотвратить отправку формы
            return false;
        }

        </script>
        
        <h2>Получение информации о балансе клиента</h2>
        <form id="getClientBalanceForm" onsubmit="return getClientBalance()">
            <input type="email" id="balanceClientEmail" name="balanceClientEmail" placeholder="Email клиента">
            <button type="submit">Получить баланс клиента</button>
            <p><textarea id="infoClientBalance" name="infoClientBalance" readonly></textarea></p>
        </form>


        <script>
        function getClientBalance() {
            // Получаем email клиента из поля ввода
            var email = document.getElementById("balanceClientEmail").value;

            // Создаем объект XMLHttpRequest для выполнения запроса к серверу
            var xhr = new XMLHttpRequest();

            // Устанавливаем обработчик события загрузки
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Если запрос выполнен успешно, обновляем содержимое textarea
                    document.getElementById("infoClientBalance").value = xhr.responseText;
                } else {
                    // Если возникла ошибка, выводим сообщение об ошибке
                    alert('Request failed. Status: ' + xhr.status);
                }
            };

            // Формируем URL для запроса к серверу, добавляем параметр email
            var url = 'get_balance.php?email=' + encodeURIComponent(email);

            // Открываем соединение и отправляем запрос к серверу
            xhr.open('GET', url, true);
            xhr.send();

            // Возвращаем false, чтобы предотвратить отправку формы
            return false;
        }

        </script>
        
        <h2>Автоматическое списание денежных средств</h2>
        <form id="autoDebitForm" action="debit.php" method="post">
            <input type="text" id="autoDebitClientId" name="autoDebitClientId" placeholder="Email клиента">
            <button type="submit">Списать деньги у должников</button>
        </form> 
    </div>
    </main>

    <footer class="background_color">
        <div class = "footer_inf"></div>
    </footer>
</body>
</html>
