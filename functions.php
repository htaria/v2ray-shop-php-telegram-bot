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