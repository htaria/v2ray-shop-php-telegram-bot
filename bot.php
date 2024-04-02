<?php
$telegram_ip_ranges = [
    ['lower' => '149.154.160.0', 'upper' => '149.154.175.255'], // literally 149.154.160.0/20
    ['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],    // literally 91.108.4.0/22
];
$ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
$ok = false;
foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
    $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
    if ($ip_dec >= $lower_dec and $ip_dec <= $upper_dec) $ok = true;
}
if (!$ok) die("Sik!");
//--------------------------------------------------------------------------------------------
$serverName = "localhost";
$userName = ""; // یوزرنیم دیتابیس
$password = ""; // پسورد دیتابیس
$dbName = ""; // نام دیتابیس

$conn = mysqli_connect($serverName, $userName, $password, $dbName);

//---------------------------------------------------------------------------------------------
define('API_KEY', 'TOKEN'); // توکن ربات رو به جای عبارت TOKEN قرار بدید
$table = "table-users"; // نام جدول شما در دیتابیس - حتما انگلیسی باشه
$botTable = "table-bot"; // نام جدول دوم شما در دیتابیس - حتما انگلیسی باشه
$admins = [1, 2, 3]; // آیدی عددی ادمین های ربات رو در این آرایه قرار بدید
//----------important files-------------
include './telegram.php';
include './db.php';
include './functions.php';
include './keyboards.php';
//--------------------------------------

if ($tc == "private") {
//--------------------------------------
    if (!$botDB) {
        $defaultChanel = "https://t.me/Hector_Bots";
        $conn->query("INSERT INTO `{$botTable}` (`bot`, `test server`, `chanel`) VALUE ('mybot','','{$defaultChanel}')");
    }
//--------------------------------------
include './user-panel.php';
include './admin-panel.php';
}


