<?php
print_r ($_GET);
define('PROC_1_YEARS', 9);
define('PROC_2_YEARS', 11);
define('PROC_3_YEARS', 13);
define('PROC_4_YEARS', 15);
define('PROC_5_YEARS', 17);
define('PROC_6_YEARS', 19);
define('PROC_7_YEARS', 21);
define('MIN_PROCENT', 0);
define('MAX_PROCENT', 100);
define('MIN_YEARS', 1);
define('MAX_YEARS', 7);
define('MIN_SUM', 1000);

$sum = "";
$years = "";
$procentFirst = "";

if (!empty($_GET)) {
    $sum = $_GET['sum'];
    $years = $_GET['years'];
    $procentFirst = $_GET['procent'];
    if (($sum == "" or $years == "" or $procentFirst == "")) {
        echo "<br> Заполните все поля!";
    }
}
include "index.html";
$errors = [];
if (!empty($_GET)) {
    if ($years < MIN_YEARS or $years > MAX_YEARS) {
        $errors[] = "Срок кредитования может быть от 1 до 7 лет, введите правильное значение.";
    }
    if ($procentFirst < MIN_PROCENT or $procentFirst > MAX_PROCENT) {
        $errors[] = "Процент первоначального взноса может быть от 0% до 100%";
    }
    if ($sum < MIN_SUM) {
        $errors[] = "Минимальная сумма должна быть не менее тысячи гривен!";
    }
    foreach ($errors as $item) {
        echo "<br> $item";
    }
    $month = 1;
    $procentYear = 1;
    switch ($years) {
        case 1:
            $procentYear = $sum * PROC_1_YEARS / 100 * $years;
            $month = 12;
            break;
        case 2:
            $procentYear = $sum * PROC_2_YEARS / 100 * $years;
            $month = 24;
            break;
        case 3:
            $procentYear = $sum * PROC_3_YEARS / 100 * $years;
            $month = 36;
            break;
        case 4:
            $procentYear = $sum * PROC_4_YEARS / 100 * $years;
            $month = 48;
            break;
        case 5:
            $procentYear = $sum * PROC_5_YEARS / 100 * $years;
            $month = 72;
            break;
        case 6:
            $procentYear = $sum * PROC_6_YEARS / 100 * $years;
            $month = 84;
            break;
        case 7:
            $procentYear = $sum * PROC_7_YEARS / 100 * $years;
            $month = 96;
            break;
    }


    $payoffAll = $sum + $procentYear - $procentFirst;
    $payoffMonth = round($payoffAll / $month, 2);
    $balance = $payoffAll;
    Echo "<br> К выплате всего получится: $payoffAll";

    echo "<table border='1px'>";
    if ($month >= 0) {
        for ($i = 1; $i <= $month; $i++) {
            $balance = round($balance - $payoffMonth , 2);
            echo "<tr>";
            echo "<td>Месяц $i </td>" . "<td> Ваша выплата составляет: " .  $payoffMonth . " гривен. </td> <td> Остальная сумма к выплате равная   $balance </td>";
            echo "</tr>";
        }
    }
}
echo "</table>";
