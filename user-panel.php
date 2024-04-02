<?php

if ($text == "/start" || $text == "🏷 ○ برگشت به منوی اصلی") {
    $startText = "درود.\nبه ربات خرید سرویس خوش آمدید.";
    SendMessage($chat_id, $text, "HTML", $userPanel);
    if (!$user) {
        $conn->query("INSERT INTO `{$table}` (`id`,`step`) VALUES ('{$from_id}','none','admin')");
    } else {
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    }
}
