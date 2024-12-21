<?php
require_once 'core/init.php'; // Инициализация, включая сессию

// Обработка логина пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? ''); // Получение логина из формы
    $password = $_POST['password'] ?? ''; // Получение пароля из формы

    if (!empty($username) && !empty($password)) {
        // Проверка логина и пароля
        if (Eshop::userCheck($username, $password)) {
            $_SESSION['admin'] = $username; // Сохраняем пользователя в сессии
            header('Location: /bookstore-php/eshop/app/admin/orders.php'); // Перенаправляем в админку
            exit;
        } else {
            echo "<p style='color: red;'>Неправильный логин или пароль.</p>";
        }
    } else {
        echo "<p style='color: red;'>Пожалуйста, заполните все поля.</p>";
    }
}
?>

<!-- HTML форма для входа -->
<form method="post">
    <label>Логин: <input type="text" name="username" required></label><br>
    <label>Пароль: <input type="password" name="password" required></label><br>
    <button type="submit">Войти</button>
</form>
