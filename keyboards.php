<?php

$userPanel = json_encode([
    'keyboard' => [
        [['text' => "🛍 خرید سرویس"]],
        [['text' => "🔥تست رایگان"], ['text' => "👤 حساب کاربری"]],
        [['text' => "🤖 خرید ربات"]],
        [['text' => "🧑‍💻 سرویس های من"], ['text' => "💰 کیف پول"]],
        [['text' => "☎️ ارتباط با پشتیبانی"]],
    ],
    'resize_keyboard' => true,
    'remove_keyboard' => true
]);

$adminPanel = json_encode([
    'keyboard' => [
        [['text' => "🧑‍💻 مشاهده سرور های کاربر"], ['text' => "👤 ارسال سرور به کاربر"]],
        [['text' => "🏷 ○ برگشت به منوی اصلی"]],
    ],
    'resize_keyboard' => true,
    'remove_keyboard' => true
]);

$yesOrno = json_encode([
    'keyboard' => [
        [['text' => "خیر"], ['text' => "بله"]],
    ],
    'resize_keyboard' => true,
    'remove_keyboard' => true
]);

$back = json_encode([
    'keyboard' => [
        [['text' => "🏷 ○ برگشت به منوی اصلی"]],
    ],
    'resize_keyboard' => true,

]);
