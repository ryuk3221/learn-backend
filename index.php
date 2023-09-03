<?php
header('Content-type: application/json  ');
$message = array(
  "message" => 'Hello',
  "sender" => [
    "name" => "danil",
    "last_name" => "Mitrofanov",
    "id" => 666
  ]
);
$message["sender"]["orders"] = [];
$orderNames = ["Вкусно и точка", "DNS", "Nikifilini"];

foreach ($orderNames as $key => $value) {
  $message["sender"]["orders"][$key] = [];
  $message["sender"]["orders"][$key]["id"] = $key . '_ordr';
  $message["sender"]["orders"][$key]["name"] = $value;
}


$link = mysqli_connect('127.0.0.1', 'backend_demo_1', '1234', 'backend_demo_1');

if (!$link) {
  echo "Ошибка: невозможно установить соединение с MySQL" . "\n";
  echo "Код ошибки:" . mysqli_connect_errno() . "\n";
  echo "Текст ошибки: " . mysqli_connect_error() . "\n";
  exit;
}

$message = [];
$message["users"] = [];
$res = $link->query("SELECT id, name, login FROM USERS ORDER BY id ASC");



if (!$res) {
  echo "Не удалось выполнить SQL-запрос: (" . $mysqli->errno . ") " . $mysqli->error . "\n";
} else {
  while ($row = $res->fetch_assoc()) {
    $message["users"][] = [
      "id" => $row["id"],
      "name" => $row["name"],
      "login" => $row["login"],
    ];
  }
}
echo json_encode($message);
