<?php

if (in_array($from_id, $admins)) {
    if ($text == "پنل" || $text == "🔙") {
        $panelText = "به پنل ادمین خوش آمدید.";
        SendMessage($chat_id, $panelText, "HTML", $message_id, $adminPanel);
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    }
}
//---------- User Servers ----------
if ($text == "🧑‍💻 مشاهده سرور های کاربر" && $step == "none") {
    $theText = "👤 لطفا آیدی عددی کاربر مورد نظر را وارد کنید :";
    SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    $conn->query("UPDATE `{$table}` SET `step`='user-servers-1' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "user-servers-1" && $stop == "No") {
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$table}` WHERE `id` = '{$text}' LIMIT 1"));
    if ($user) {
        $userServers = $user['servers'];
        $userServers = explode('@', $userServers);
        $theServers = "";
        foreach ($userServers as $server) {
            $theServers .= "📌 <code>$server</code>\n\n";
        }
        $theText = ($theServers != "") ? "🗂 لیست سرور های خریداری شده این کاربر به شرح زیر می باشد :\n$myServers" : "⚠️ این کاربر هنوز هیچ سروری خریداری نکرده است!";
        SendMessage($chat_id, $theText, "HTML", $message_id);
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    } else {
        $theText = "⚠️ خطا : هیچ کاربری با این شناسه عددی در ربات وجود ندارد. لطفا صحت شناسه عددی را برسی کرده و مجددا ارسال کنید یا برای بازگشت به پنل، بر روی دکمه زیر کلیک کنید.";
        SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    }
}
//---------- Send Server ----------
if ($text == "👤 ارسال سرور به کاربر" && $step == "none") {
    $theText = "👤 لطفا آیدی عددی کاربر مورد نظر را وارد کنید :";
    SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    $conn->query("UPDATE `{$table}` SET `step`='send-server-1' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "send-server-1" && $stop == "No") {
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$table}` WHERE `id` = '{$text}' LIMIT 1"));
    if ($user) {
        $theText = "🔹 سروری که می خواهید برای کاربر ارسال شود را وارد کنید";
        SendMessage($chat_id, $theText, "HTML", $message_id);
        $conn->query("UPDATE `{$table}` SET `step`='send-server-2-$text' WHERE `id`='{$from_id}'LIMIT 1");
    } else {
        $theText = "⚠️ خطا : هیچ کاربری با این شناسه عددی در ربات وجود ندارد. لطفا صحت شناسه عددی را برسی کرده و مجددا ارسال کنید یا برای بازگشت به پنل، بر روی دکمه زیر کلیک کنید.";
        SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    }
} else if (strpos($step, "send-server-2-") !== false && $stop == "No") {
    $idm = str_replace("send-server-2-", '', $step);
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$table}` WHERE `id` = '{$idm}' LIMIT 1"));
    $userServers = $user['servers'];
    $addNew = "$userServers***$text";
    $theText = "✅✅ این سرور با موفقیت برای کاربر مورد نظر ارسال شد.\n";
    SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    $theText = "✅✅ سرور شما با موفقیت ساخته شد\n <code>$text</code>\nبرای کپی کردن روی لینک کلیک کنید.";
    SendMessage($idm, $theText, "HTML");
    $conn->query("UPDATE `{$table}` SET `servers`='{$addNew}' WHERE `id`='{$idm}'LIMIT 1");
    $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
}
//---------- Give Mony ----------
if ($text == "💰 افزایش موجودی کیف پول کاربر" && $step == "none") {
    $theText = "👤 لطفا آیدی عددی کاربر مورد نظر را وارد کنید :";
    SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    $conn->query("UPDATE `{$table}` SET `step`='give-mony-1' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "give-mony-1" && $stop == "No") {
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$table}` WHERE `id` = '{$text}' LIMIT 1"));
    if ($user) {
        $theText = "💸 مقدار وجهی را که می خواهید به کیف پول این کاربر واریز کنید به تومان وارد کنید.\n📍 مثال : 20000";
        SendMessage($chat_id, $theText, "HTML", $message_id);
        $conn->query("UPDATE `{$table}` SET `step`='give-mony-2-$text' WHERE `id`='{$from_id}'LIMIT 1");
    } else {
        $theText = "⚠️ خطا : هیچ کاربری با این شناسه عددی در ربات وجود ندارد. لطفا صحت شناسه عددی را برسی کرده و مجددا ارسال کنید یا برای بازگشت به پنل، بر روی دکمه زیر کلیک کنید.";
        SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    }
} else if (strpos($step, "give-mony-2-") !== false && $stop == "No") {
    $isNumber = preg_replace("/[^0-9]/", '', $text);
    if ($isNumber) {
        $idm = str_replace("give-mony-2-", '', $step);
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `{$table}` WHERE `id` = '{$idm}' LIMIT 1"));
        $userWalletBalance = $user['wallet balance'];
        $newBalance = (int)$userWalletBalance + (int)$text;
        $text = number_format((int)$text);
        $theText = "💸 مبلغ $text تومان با موفقیت به کیف پول کاربر $idm واریز شد.";
        SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
        $theText = "💵 مبلغ $text تومان به حساب کیف پول شما واریز شد!";
        SendMessage($idm, $theText, "HTML");
        $conn->query("UPDATE `{$table}` SET `wallet balance`='{$newBalance}' WHERE `id`='{$idm}'LIMIT 1");
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    } else {
        $theText = "⚠️ خطا : لطفا عدد را به صورت لاتین وارد کنید.\n📍 مثال : 50000";
        SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    }
}
//---------- Set The Test Server ----------
if ($text == "⚙️ تنظیم سرور تست" && $step == "none") {
    $testServer = ($testServer != "") ? "\n$testServer": "نداریم" ;
    $theText = "⚙️ سرور مورد نظر را وارد کنید\n📌 سرور فعلی : $testServer";
    SendMessage($chat_id, $theText, "HTML", $message_id, $adminBack);
    $conn->query("UPDATE `{$table}` SET `step`='set-the-test-server-1' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "set-the-test-server-1" && $stop == "No") {
    $theText ="✅✅ سرور تست با موفقیت تنظیم شد!";
    SendMessage($chat_id, $theText, "HTML", $message_id);
    $conn->query("UPDATE `{$botTable}` SET `test server`='{$text}' WHERE `bot`='mybot'LIMIT 1");
    $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
}
