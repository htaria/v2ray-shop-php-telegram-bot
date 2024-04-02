<?php

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = isset($message->chat->id) ? $message->chat->id : $update->callback_query->message->chat->id;
$message_id = isset($message->message_id) ? $message->message_id : $update->callback_query->message->message_id;
$from_id = isset($message->from->id) ? $message->from->id : $update->callback_query->from->id;
$link = "<a href='tg://user?id=$from_id'>$from_id</a>";
$text = isset($message->text) ? $message->text : $update->callback_query->data;
$text = isset($update->message->text) ? $update->message->text : $update->callback_query->data;
$inlineBtnMessage = $update->callback_query->message->text;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$user_name = $message->from->username;
$tc = $update->message->chat->type;
$sticker_id = $message->sticker->file_id;
$video_id = $message->video->file_id;
$voice_id = $message->voice->file_id;
$file_id = $message->document->file_id;
$animation_id = $message->animation->file_id;
$music_id = $message->audio->file_id;
$photo0_id = $message->photo[0]->file_id;
$cap = $message->caption;
//--------------------
$forward = $message->forward_from_chat;
$forwardms = $message->forward_from_message_id;
//--------------------
if (isset($update->callback_query)) {
    $callback_query = $update->callback_query;
    $data = $callback_query->data;
    $callback_id = $callback_query->if;
    $chatId = $callback_query->message->chat->id;
    $fromId = $callback_query->from->id;
    $messageId = $callback_query->message->message_id;
    $firstName = $callback_query->from->first_name;
    $lastName = $callback_query->from->last_name;
    $username = $callback_query->from->username;
}
//--------------------
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

function answerCallbackQuery($callback_query_id, $text, $show_alert)
{
    return bot('answerCallbackQuery', [
        'callback_query_id' => $callback_query_id,
        'text' => $text,
        'show_alert' => $show_alert
    ]);
}

function EditKeyboard($chat_id, $message_id, $keyboard)
{
    bot('EditMessageReplyMarkup', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'reply_markup' => $keyboard
    ]);
}

function SendMessage($chat_id, $text, $mode = null, $reply = null, $keyboard = null)
{
    return bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => $mode,
        'reply_to_message_id' => $reply,
        'reply_markup' => $keyboard,
        'disable_web_page_preview' => true
    ]);
}

function sendphoto($chat_id, $photo, $caption)
{
    return bot('sendphoto', [
        'chat_id' => $chat_id,
        'photo' => $photo,
        'caption' => $caption,
    ]);
}

function EditMessageText($chat_id, $message_id, $text = null, $mode = null, $keyboard = null, $disable_web_page_preview = null)
{
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => $text,
        'parse_mode' => $mode,
        'reply_markup' => $keyboard,
        'disable_web_page_preview' => $disable_web_page_preview
    ]);
}

function ForwardMessage($chat_id, $from_chat, $message_id)
{
    return bot('ForwardMessage', [
        'chat_id' => $chat_id,
        'from_chat_id' => $from_chat,
        'message_id' => $message_id
    ]);
}
function sendAnimation($chat_id, $animation, $caption)
{
    return bot('sendAnimation', [
        'chat_id' => $chat_id,
        'animation' => $animation,
        'caption' => $caption
    ]);
}

function DeleteMessage($chat_id, $msgid){
    bot('DeleteMessage',[
      'chat_id'=>$chat_id,
      'message_id'=>$msgid
      ]);
    }
