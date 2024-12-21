<?php

require_once __DIR__ . '/../core/init.php';

// Проверяем, что корзина не пуста
if (empty(Basket::read())) {
    die("Корзина пуста. Добавьте товары в корзину перед оформлением заказа.");
}

// Обработка POST-запроса
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer = htmlspecialchars($_POST['customer'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $address = htmlspecialchars($_POST['address'] ?? '');
    $items = Basket::read();

    // Проверяем, что все поля заполнены
    if (empty($customer) || empty($email) || empty($phone) || empty($address)) {
        die("Все поля формы должны быть заполнены.");
    }

    // Создаём объект заказа
    $order = new Order($customer, $email, $phone, $address, $items);

    // Сохраняем заказ
    if (Eshop::saveOrder($order)) {
        echo "<p>Заказ успешно оформлен!</p>";
        echo "<a href='/bookstore-php/eshop/catalog'>Вернуться в каталог</a>";
        exit;
    } else {
        echo "<p>Ошибка оформления заказа. Попробуйте позже.</p>";
        exit;
    }
} else {
    echo "<p>Некорректный метод запроса.</p>";
}
