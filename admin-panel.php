<?php

if (in_array($from_id, $admins)) {
    if ($text == "پنل" || $text == "🔙") {
        $panelText = "به پنل ادمین خوش آمدید.";
        SendMessage($chat_id, $panelText, "HTML", $message_id, $adminPanel);
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    }
}
