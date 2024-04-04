<?php

function stop($text)
{
    switch ($text) {
        case '/start':
            $a = "Yes";
            break;
        case '🏷 ○ برگشت به منوی اصلی':
            $a = "Yes";
            break;
        case 'پنل':
            $a = "Yes";
            break;
        case '🔙':
            $a = "Yes";
            break;

        default:
            $a = "No";
            break;
    }
    return $a;
}

$stop = stop($text);
//------------------------------
function serverLocationKeyboard($data, $franceServers, $germanyServers, $englandServers, $netherlandsServers)
{
    switch ($data) {
        case "🇫🇷 فرانسه":
            $a = $franceServers;
            break;
        case "🇩🇪 آلمان":
            $a = $germanyServers;
            break;
        case "🇬🇧 انگلستان":
            $a = $englandServers;
            break;
        case "🇳🇱 هلند":
            $a = $netherlandsServers;
            break;

        default:
            $a = "No";
            break;
    }
    return $a;
}


//------------------------------
function serversDescription($selectedServer)
{
    switch ($selectedServer) {
        case "france-1":
            $a = ["🔻دوکاربره | یک ماهه 10 گیگ", 30000, "🇫🇷 فرانسه", 10, 30];
            break;
        case "france-2":
            $a = ["🔻دوکاربره | یک ماهه 20 گیگ", 50000, "🇫🇷 فرانسه", 20, 30];
            break;
        case "france-3":
            $a = ["🔻دوکاربره | یک ماهه 30 گیگ", 70000, "🇫🇷 فرانسه", 30, 30];
            break;
        case "france-4":
            $a = ["🔻دوکاربره | یک ماهه 50 گیگ", 90000, "🇫🇷 فرانسه", 50, 30];
            break;
        case "france-5":
            $a = ["🔻دوکاربره | دو ماهه 70 گیگ", 135000, "🇫🇷 فرانسه", 70, 60];
            break;
        case "france-6":
            $a = ["🔻دوکاربره | دو ماهه 100 گیگ", 170000, "🇫🇷 فرانسه", 100, 60];
            break;
        case "germany-1":
            $a = ["🔻دوکاربره | یک ماهه 20 گیگ", 50000, "🇩🇪 آلمان", 20, 30];
            break;
        case "germany-2":
            $a = ["🔻دوکاربره | یک ماهه 50 گیگ", 90000, "🇩🇪 آلمان", 50, 30];
            break;
        case "germany-3":
            $a = ["🔻دوکاربره | یک ماهه 100 گیگ", 170000, "🇩🇪 آلمان", 100, 30];
            break;
        case "germany-4":
            $a = ["🔻دوکاربره | دو ماهه 50 گیگ", 110000, "🇩🇪 آلمان", 50, 60];
            break;
        case "germany-5":
            $a = ["🔻دوکاربره | دو ماهه 100 گیگ", 210000, "🇩🇪 آلمان", 100, 60];
            break;
        case "england-1":
            $a = ["🔻دوکاربره | یک ماهه 20 گیگ", 50000, "🇬🇧 انگلستان", 20, 30];
            break;
        case "england-2":
            $a = ["🔻دوکاربره | یک ماهه 50 گیگ", 90000, "🇬🇧 انگلستان", 50, 30];
            break;
        case "england-3":
            $a = ["🔻دوکاربره | یک ماهه 100 گیگ", 170000, "🇬🇧 انگلستان", 100, 30];
            break;
        case "england-4":
            $a = ["🔻دوکاربره | دو ماهه 50 گیگ", 110000, "🇬🇧 انگلستان", 50, 60];
            break;
        case "england-5":
            $a = ["🔻دوکاربره | دو ماهه 100 گیگ", 210000, "🇬🇧 انگلستان", 100, 60];
            break;
        case "netherlands-1":
            $a = ["🔻دوکاربره | یک ماهه 20 گیگ", 50000, "🇳🇱 هلند", 20, 30];
            break;
        case "netherlands-2":
            $a = ["🔻دوکاربره | یک ماهه 50 گیگ", 90000, "🇳🇱 هلند", 50, 30];
            break;
        case "netherlands-3":
            $a = ["🔻دوکاربره | یک ماهه 100 گیگ", 170000, "🇳🇱 هلند", 100, 30];
            break;
        case "netherlands-4":
            $a = ["🔻دوکاربره | دو ماهه 50 گیگ", 110000, "🇳🇱 هلند", 50, 60];
            break;
        case "netherlands-5":
            $a = ["🔻دوکاربره | دو ماهه 100 گیگ", 210000, "🇳🇱 هلند", 100, 60];
            break;
    }
    return $a;
}
$serverDescription = serversDescription($selectedServer);

//------------------------------
function serverLocationDescription($serverLocation)
{
    switch ($serverLocation) {
        case "🇫🇷 فرانسه":
            $a = "سرور های کشور فرانسه، به صورت تک سروره ارائه می شوند. این سرور، تا 30 روز دسترسی شمارا به تمام سایت ها و برنامه هایی که به دلیل فیلترینگ قادر به دسترسی به آن ها نیستید فراهم می کند.";
            break;
        case "🇩🇪 آلمان":
            $a = "سرور های کشور آلمان، به صورت چند سروره ارائه می شوند. این سرور، تا 30 روز دسترسی شمارا به تمام سایت ها و برنامه هایی که به دلیل فیلترینگ قادر به دسترسی به آن ها نیستید فراهم می کند.";
            break;
        case "🇬🇧 انگلستان":
            $a = "سرور های کشور انگلستان، به صورت چند سروره ارائه می شوند. این سرور، تا 30 روز دسترسی شمارا به تمام سایت ها و برنامه هایی که به دلیل فیلترینگ قادر به دسترسی به آن ها نیستید فراهم می کند.";
            break;
        case "🇳🇱 هلند":
            $a = "سرور های کشور هلند، به صورت چند سروره ارائه می شوند. این سرور، تا 30 روز دسترسی شمارا به تمام سایت ها و برنامه هایی که به دلیل فیلترینگ قادر به دسترسی به آن ها نیستید فراهم می کند.";
            break;

        default:
            $a = "No";
            break;
    }
    return $a;
}

$serverLocationDescription = serverLocationDescription($serverLocation);
