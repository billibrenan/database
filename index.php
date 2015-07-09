<?php
//error_reporting(E_ALL);
require 'class.db.php';
require 'class.order.php';
error_reporting (0);

// константы для подключени к БД

define('HOST', 'localhost'); //сервер
define('USER', 'admin'); //пользователь
define('PASSWORD', '1234'); //пароль
define('NAME_BD', 'db_example');//база

DB::getInstance(); // инициализация экземпляра класса дл работы с БД
//свободное использование класса

//вывод таблицы продуктов
$result=DB::query("SELECT products_id,title FROM `product`");
echo '<h2>Products:</h2> <table border="1">';
while($obj=DB::fetch_object($result)){
    echo '<tr><td>'.$obj->id.'</td><td>'.$obj->title.'</td><tr>';
}
echo '</table>';

$order = new  Order();
echo $order->getOrderList();

//попробуем создать новый экземпляр DB
echo "<span style='color:red'>";

?>