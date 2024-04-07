<?php
//---------- User Panel ----------
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

$serverLocationPanel = json_encode([
    'inline_keyboard' => [
        [['text' => "🇫🇷 فرانسه", 'callback_data' => "🇫🇷 فرانسه"]],
        [['text' => "🇩🇪 آلمان", 'callback_data' => "🇩🇪 آلمان"]],
        [['text' => "🇬🇧 انگلستان", 'callback_data' => "🇬🇧 انگلستان"]],
        [['text' => "🇳🇱 هلند", 'callback_data' => "🇳🇱 هلند"]],
    ]
]);

$paymentMethods = json_encode([
    'inline_keyboard' => [
        [['text' => "💳 کارت به کارت - $serverDescriptionKeyboard_1[1] تومان", 'callback_data' => "Card by card"]],
        [['text' => "🏅 پرداخت با کیف پول + جایزه", 'callback_data' => "wallet"]],
        [['text' => "🔙", 'callback_data' => "back"]],
    ]
]);

$cardByCard = json_encode([
    'inline_keyboard' => [
        [['text' => "💳 کارت به کارت - $serverDescriptionKeyboard_2[1] تومان", 'callback_data' => "Card by card"]],
        [['text' => "🔙", 'callback_data' => "back"]],
    ]
]);

$rechargeWallet = json_encode([
    'inline_keyboard' => [
        [['text' => "شارژ کیف پول", 'callback_data' => "rechargeWallet"]],
    ]
]);

$rechargeWalletByCard = json_encode([
    'inline_keyboard' => [
        [['text' => "💳 کارت به کارت", 'callback_data' => "Card by card"]],
        [['text' => "🔙", 'callback_data' => "back"]],
    ]
]);

$franceServers = json_encode([
    'inline_keyboard' => [
        [['text' => "🚀10 گیگ یک ماهه 2 کاربره /30.000تومان🚀", 'callback_data' => "france-1"]],
        [['text' => "🚀20 گیگ یک ماهه 2 کاربره /50.000تومان🚀", 'callback_data' => "france-2"]],
        [['text' => "🚀30 گیگ یک ماهه 2 کاربره /70.000تومان🚀", 'callback_data' => "france-3"]],
        [['text' => "🚀50 گیگ یک ماهه 2 کاربره /90.000تومان🚀", 'callback_data' => "france-4"]],
        [['text' => "🚀70 گیگ دو ماهه 2 کاربره /135.000تومان🚀", 'callback_data' => "france-5"]],
        [['text' => "🚀100 گیگ دو ماهه 2 کاربره /170.000تومان🚀", 'callback_data' => "france-6"]],
    ]
]);

$germanyServers = json_encode([
    'inline_keyboard' => [
        [['text' => "🚀20 گیگ یک ماهه 2 کاربره /50.000تومان🚀", 'callback_data' => "germany-1"]],
        [['text' => "🚀50 گیگ یک ماهه 2 کاربره /90.000تومان🚀", 'callback_data' => "germany-2"]],
        [['text' => "🚀100 گیگ یک ماهه 2 کاربره /170.000تومان🚀", 'callback_data' => "germany-3"]],
        [['text' => "🚀50 گیگ دو ماهه 2 کاربره /110.000تومان🚀", 'callback_data' => "germany-4"]],
        [['text' => "🚀100 گیگ دو ماهه 2 کاربره /210.000تومان🚀", 'callback_data' => "germany-5"]],
    ]
]);

$englandServers = json_encode([
    'inline_keyboard' => [
        [['text' => "🚀20 گیگ یک ماهه 2 کاربره /50.000تومان🚀", 'callback_data' => "england-1"]],
        [['text' => "🚀50 گیگ یک ماهه 2 کاربره /90.000تومان🚀", 'callback_data' => "england-2"]],
        [['text' => "🚀100 گیگ یک ماهه 2 کاربره /170.000تومان🚀", 'callback_data' => "england-3"]],
        [['text' => "🚀50 گیگ دو ماهه 2 کاربره /110.000تومان🚀", 'callback_data' => "england-4"]],
        [['text' => "🚀100 گیگ دو ماهه 2 کاربره /210.000تومان🚀", 'callback_data' => "england-5"]],
    ]
]);

$netherlandsServers = json_encode([
    'inline_keyboard' => [
        [['text' => "🚀20 گیگ یک ماهه 2 کاربره /50.000تومان🚀", 'callback_data' => "netherlands-1"]],
        [['text' => "🚀50 گیگ یک ماهه 2 کاربره /90.000تومان🚀", 'callback_data' => "netherlands-2"]],
        [['text' => "🚀100 گیگ یک ماهه 2 کاربره /170.000تومان🚀", 'callback_data' => "netherlands-3"]],
        [['text' => "🚀50 گیگ دو ماهه 2 کاربره /110.000تومان🚀", 'callback_data' => "netherlands-4"]],
        [['text' => "🚀100 گیگ دو ماهه 2 کاربره /210.000تومان🚀", 'callback_data' => "netherlands-5"]],
    ]
]);

$cancel = json_encode([
    'keyboard' => [
        [['text' => "❌ انصراف از خرید"]],
    ],
    'resize_keyboard' => true,
]);

$back = json_encode([
    'keyboard' => [
        [['text' => "🏷 ○ برگشت به منوی اصلی"]],
    ],
    'resize_keyboard' => true,
]);

//---------- Admin Panel ----------

$adminPanel = json_encode([
    'keyboard' => [
        [['text' => "🧑‍💻 مشاهده سرور های کاربر"], ['text' => "👤 ارسال سرور به کاربر"]],
        [['text' => "💰 افزایش موجودی کیف پول کاربر"],['text' => "⚙️ تنظیم سرور تست"]],
        [['text' => "🏷 ○ برگشت به منوی اصلی"]],
    ],
    'resize_keyboard' => true,
    'remove_keyboard' => true
]);

$adminBack = json_encode([
    'keyboard' => [
        [['text' => "🔙"]],
    ],
    'resize_keyboard' => true,
]);