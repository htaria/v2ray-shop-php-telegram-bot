<?php

if ($text == "/start" || $text == "🏷 ○ برگشت به منوی اصلی") {
    $startText = "درود.\nبه ربات خرید سرویس خوش آمدید.";
    SendMessage($chat_id, $startText, "HTML", $message_id, $userPanel);
    if (!$user) {
        $conn->query("INSERT INTO `{$table}` (`id`,`step`) VALUES ('{$from_id}','none')");
    } else {
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    }
}

//----------
if ($text == "🛍 خرید سرویس" && $step == "none") {
    $theText = "📍 لطفا یکی از سرورهای زیر را انتخاب کنید👇";
    SendMessage($chat_id, $theText, "HTML", $message_id, $serverLocationPanel);
    $conn->query("UPDATE `{$table}` SET `step`='buy-server-1' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "buy-server-1" && $stop == "No" && $data) {
    $serverLocationKeyboard = serverLocationKeyboard($data, $franceServers, $germanyServers, $englandServers, $netherlandsServers);
    $theText = "🔰 حالا یکی از سرویس های زیر را انتخاب کنید تا جزییات پلن برای شما نمایش داده شود👈";
    EditMessageText($chatId, $messageId, $theText, "HTML", $serverLocationKeyboard);
    $conn->query("UPDATE `{$table}` SET `step`='buy-server-2' , `server location`='{$data}' WHERE `id`='{$from_id}' LIMIT 1");
} else if ($step == "buy-server-2" && $stop == "No" && $data) {
    $theText = "$serverDescription[0]\n💰 قیمت : $serverDescription[1] تومان \n🗺 لوکیشن سرور : $serverDescription[2]\n📃 توضیحات : سرور های کشور $serverLocation به صورت تک سروره ارائه می شوند. این سرور، تا $serverDescription[4] روز دسترسی شمارا به تمام سایت ها و برنامه هایی که به دلیل فیلترینگ قادر به دسترسی به آن ها نیستید فراهم می کند.";
    EditMessageText($chatId, $messageId, $theText, "HTML", $paymentMethods);
    $conn->query("UPDATE `{$table}` SET `step`='buy-server-3' , `selected server`='{$data}' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "buy-server-3" && $stop == "No" && $data) {
    $serverDescription = serversDescription($selectedServer);
    if ($data == "wallet") {
        if ($walletBalance >= $serverDescription[1]) {
            $theText = "خرید سرور شما با موفقیت انجام شد.✅\n🧑‍💻 سرور شما به زودی توسط همکاران ما ساخته می شود. این فرایند ممکن است بین نیم تا 12 ساعت به طول انجامد.";
            EditMessageText($chatId, $messageId, $theText, "HTML");
            $theText = "#خرید_سرور\nکاربر <code>$from_id</code> سفارش یک سرور فیلترشکن به شرح زیر داده است :\n$serverDescription[0]\n💰 قیمت : $serverDescription[1] تومان \n🗺 لوکیشن سرور : $serverDescription[2]\nپرداخت از طریق کیف پول انجام شده است✅";
            SendMessage($chanel, $theText, "HTML");
            $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
        } else {
            $theText = "❌ موجودی کیف پول شما کافی نیست.\n لطفا از دیگر روش های پرداخت استفاده کنید.👇";
            EditMessageText($chatId, $messageId, $theText, "HTML", $cardByCard);
        }
    } else if ($data == "Card by card") {
        $theText = "لطفا تصویر فیش واریزی یا شماره پیگیری -  ساعت پرداخت - نام پرداخت کننده را در یک پیام ارسال کنید\n💳<code>$card</code>  $cardName";
        SendMessage($chat_id, $theText, "HTML", $message_id, $cancel);
        $conn->query("UPDATE `{$table}` SET `step`='buy-server-4' WHERE `id`='{$from_id}'LIMIT 1");
    }
} else if ($step == "buy-server-4" && $stop == "No") {
    $serverDescription = serversDescription($selectedServer);

    $theText = "✅✅درخواست شما با موفقیت ارسال شد\nبعد از بررسی و تایید فیش, اطلاعات اکانت از طریق ربات برای شما ارسال می شود.";
    SendMessage($chat_id, $theText, "HTML", $message_id, $back);
    if ($text) {
        $theText = "🧑‍💻 درخواست #خرید_سرور\n👤 کاربر <code>$from_id</code> سفارش یک سرویس به شرح زیر را داده است :\n$serverDescription[0]\n💰 قیمت : $serverDescription[1] تومان \n🗺 لوکیشن سرور : $serverDescription[2]\nپرداخت از طریق کارت به کارت انجام شده است✅\n🧾 مشخصات رسید :\n$text";
        SendMessage($chanel, $theText, "HTML");
    }
    $theCaption = "🧑‍💻 درخواست #خرید_سرور\n👤 کاربر <code>$from_id</code> سفارش یک سرویس به شرح زیر را داده است :\n$serverDescription[0]\n💰 قیمت : $serverDescription[1] تومان \n🗺 لوکیشن سرور : $serverDescription[2]\nپرداخت از طریق کارت به کارت انجام شده است✅\n🧾 مشخصات رسید : در تصویر درج شده.";
    sendphoto($chanel, $photo0_id, $theCaption, "HTML");
    $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
}
