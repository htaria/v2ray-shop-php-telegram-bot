<?php

if ($text == "/start" || $text == "🏷 ○ برگشت به منوی اصلی") {
    $startText = "درود.\nبه ربات خرید سرویس خوش آمدید.";
    SendMessage($chat_id, $startText, "HTML", $message_id, $userPanel);
    if (!$user) {
        $conn->query("INSERT INTO `{$table}` (`id`,`step`, `wallet balance`) VALUES ('{$from_id}','none',0)");
    } else {
        $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
    }
}

if ($text == "back" && $step != "none" || $text == "❌ انصراف از خرید" && $step != "none") {
    $theText = "🔙 به پنل اصلی بازگشتیم.\n لطفا گزینه مورد نظر خود را از کیبورد ربات انتخاب نمایید.";
    SendMessage($chat_id, $theText, "HTML", $message_id, $userPanel);
    $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
}

//---------- Profile ----------
if ($text == "👤 حساب کاربری" && $step == "none") {
    $walletBalance = number_format((int)$walletBalance);
    $walletCheck = ($walletBalance > 0) ? $walletBalance : "موجودی کیف پول شما صفر است.";
    $theText = "🤖 سلام $first_name به حساب کاربری خودت خوش اومدی.\n👤 شناسه کاربری : <code>$from_id</code>\n💰 موجودی کیف پول : $walletCheck";
    SendMessage($chat_id, $theText, "HTML", $message_id);
}

//---------- Buy Server Section ----------
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
    $conn->query("UPDATE `{$table}` SET `step`='buy-server-3' , `selected server`='{$data}' WHERE `id`='{$from_id}'LIMIT 1");
    $serverDescription = serversDescription($data);
    $theText = "$serverDescription[0]\n💰 قیمت : $serverDescription[1] تومان \n🗺 لوکیشن سرور : $serverDescription[2]\n📃 توضیحات : سرور های کشور $serverLocation به صورت تک سروره ارائه می شوند. این سرور، تا $serverDescription[4] روز دسترسی شمارا به تمام سایت ها و برنامه هایی که به دلیل فیلترینگ قادر به دسترسی به آن ها نیستید فراهم می کند.";
    EditMessageText($chatId, $messageId, $theText, "HTML", $paymentMethods);
} else if ($step == "buy-server-3" && $stop == "No" && $data) {
    $serverDescription = serversDescription($selectedServer);
    if ($data == "wallet") {
        if ($walletBalance >= $serverDescription[1]) {
            $price =  $serverDescription[1] - 10000;
            $newNumber = $walletBalance - $price;
            $theText = "خرید سرور شما با موفقیت انجام شد.✅\n10000 تومان از هزینه پرداخت هم به کیف پول شما برگردانده شد😆\n🧑‍💻 سرور شما به زودی توسط همکاران ما ساخته می شود. این فرایند ممکن است بین نیم تا 12 ساعت به طول انجامد.";
            EditMessageText($chatId, $messageId, $theText, "HTML");
            $theText = "#خرید_سرور\nکاربر <code>$from_id</code> سفارش یک سرور فیلترشکن به شرح زیر داده است :\n$serverDescription[0]\n💰 قیمت : $serverDescription[1] تومان \n🗺 لوکیشن سرور : $serverDescription[2]\nپرداخت از طریق کیف پول انجام شده است✅";
            SendMessage($chanel, $theText, "HTML");
            $conn->query("UPDATE `{$table}` SET `step`='none' , `wallet balance`='{$newNumber}' WHERE `id`='{$from_id}'LIMIT 1");
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
//---------- My Servers ----------
if ($text == "🧑‍💻 سرویس های من" && $step == "none") {
    $userServers = explode('***', $servers);
    $myServers = "";
    foreach ($userServers as $server) {
        $myServers .= "<code>$server</code>\n\n";
    }
    $theText = ($userServers[1]) ? "🗂 لیست سرور های خریداری شده شما به شرح زیر می باشد :\n$myServers" : "⚠️ شما هنوز هیچ سروری خریداری نکردید. اگر هزینه سرور را واریز کردید و هنوز آن را دریافت نکردید، مدتی صبر کنید. همکاران ما در سریع ترین زمان سرور شمارا ساخته و از طریق ربات برای شما ارسال می کنند.";
    SendMessage($chat_id, $theText, "HTML", $message_id);
}
//---------- Free Test ----------
if ($text == "🔥تست رایگان" && $step == "none") {
    $theText = ($testServer != "") ? "📍 سرور زیر، جهت تست کیفیت و سرعت سرویس های ما در دسترس شما کاربران عزیز قرار داده شده است :\n\n<code>$testServer</code>" : "❌ درحال حاضر هیچ سرویسی برای تست رایگان قرار نگرفته است❌";
    SendMessage($chat_id, $theText, "HTML", $message_id);
}
//---------- Support Section ----------
if ($text == "☎️ ارتباط با پشتیبانی" && $step == "none") {
    $theText = "👮🏻 همکاران ما در خدمت شما هستن !\n\n🔘 در صورت وجود نظر , ایده , گزارش مشکل , پیشنهاد , ایراد سوال , یا انتقاد میتوانید با ما در ارتباط باشید \n💬 لطفا پیام خود را به صورت فارسی و روان ارسال کنید\n\n👤 ID : @theAriaChannel";
    SendMessage($chat_id, $theText, "HTML", $message_id);
}
//---------- Wallet Balance ----------
if ($text == "💰 کیف پول" && $step == "none") {
    $walletBalance = number_format((int)$walletBalance);
    $walletCheck = ($walletBalance > 0) ? "🔻 موجودی کیف پول شما $walletBalance تومان است." : "🔻 موجودی کیف پول شما صفر است.";
    $theText = $walletCheck;
    SendMessage($chat_id, $theText, "HTML", $message_id, $rechargeWallet);
}
//---------- Recharge Wallet ----------
if ($data == "rechargeWallet" && $step == "none") {
    $theText = "💵 لطفا مبلغ مورد نظر را به تومان وارد کنید\n📍 مثال : 50000";
    EditMessageText($chatId, $messageId, $theText, "HTML");
    $conn->query("UPDATE `{$table}` SET `step`='rechargeWallet-1' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "rechargeWallet-1" && $stop == "No") {
    $isNumber = preg_replace("/[^0-9]/", '', $text);
    if ($isNumber) {
        $theText = ($isNumber >= 10000) ? "🔰 لطفا یکی از روش های پرداخت زیر را انتخا کنید👇" : "⚠️ خطا : حداقل مبلغ شارژ کیف پول 10000 تومان می باشد.";
        if ($isNumber >= 10000) {
            SendMessage($chat_id, $theText, "HTML", $message_id, $rechargeWalletByCard);
            $conn->query("UPDATE `{$table}` SET `step`='rechargeWallet-2', `recharge wallet number`='{$isNumber}' WHERE `id`='{$from_id}'LIMIT 1");
        } else {
            SendMessage($chat_id, $theText, "HTML", $message_id);
        }
    } else {
        $theText = "⚠️ خطا : لطفا عدد را به صورت لاتین وارد کنید.\n📍 مثال : 50000";
        SendMessage($chat_id, $theText, "HTML", $message_id);
    }
} else if ($step == "rechargeWallet-2" && $stop == "No" && $data) {
    $theText = "لطفا تصویر فیش واریزی یا شماره پیگیری -  ساعت پرداخت - نام پرداخت کننده را در یک پیام ارسال کنید\n💳<code>$card</code>  $cardName";
    EditMessageText($chatId, $messageId, $theText, "HTML");
    $conn->query("UPDATE `{$table}` SET `step`='rechargeWallet-3' WHERE `id`='{$from_id}'LIMIT 1");
} else if ($step == "rechargeWallet-3" && $stop == "No") {
    $theText = "✅✅درخواست شما با موفقیت ارسال شد\nبعد از بررسی و تایید فیش, شارژ کیف پول برای شما واریز می شود.";
    SendMessage($chat_id, $theText, "HTML", $message_id);
    $rechargeWalletNumber = number_format((int)$rechargeWalletNumber);
    if ($text) {
        $theText = "🧑‍💻 درخواست #شارز_کیف_پول\n👤 کاربر <code>$from_id</code> درخواست $rechargeWalletNumber تومان شارژ برای کیف پولش دارد.\n📃 مشخصات رسید : \n$text";
        SendMessage($chanel, $theText, "HTML");
    }
    $theCaption = "🧑‍💻 درخواست #شارز_کیف_پول\n👤 کاربر <code>$from_id</code> درخواست $rechargeWalletNumber تومان شارژ برای کیف پولش دارد.\n📃 مشخصات رسید : \nدر تصویر درج شده";
    sendphoto($chanel, $photo0_id, $theCaption, "HTML");
    $conn->query("UPDATE `{$table}` SET `step`='none' WHERE `id`='{$from_id}'LIMIT 1");
}

//---------- Buy The Bot ----------
if ($text == "🤖 خرید ربات" && $step == "none") {
    $PohotoLink = "https://t.me/aksamalma/705";
    $theCaption = "💎 گروه برنامه نویسی <b>هکتورتیم</b>، آماده دریافت پروژه طراحی ربات تلگرام ، طراحی وب اپ بات (اپلیکیشن تلگرامی) ، طراحی سایت و ... از شما عزیزان میباشد.\n\n🤖 اگر می خواهید صاحب رباتی مشابه این بات، و یا هر ربات تلگرامی و سایت دیگری شوید، به اکانت پشتیبانی ما پیام دهید.\n🧑‍💻 <b>ID : @HectorTMSupport</b>\n➖➖➖➖➖➖➖➖\n<b>🤖 تحقق رویای شما در تلگرام، با ربات های هکتور باتس</b>\n<b>📣 Channel : @Hector_Bots</b>";
    sendphoto($chat_id, $PohotoLink, $theCaption, "HTML");
}