<?php

namespace App\Http\Controllers;

use CodeBot\WebHook;
use CodeBot\SenderRequest;
use CodeBot\CallSendApi;
use CodeBot\Message\Text;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function subscribe()
    {
        if (!$subscribe = (new WebHook)->check('asd')) {
            abort(403, 'Unauthorized action');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SenderRequest;
        $senderId = $sender->getSenderId();
        $message = $sender->getMessage();

        $text = new Text($senderId);
        $callSendApi = new CallSendApi(env('FB_PAGE_ACCESS_TOKEN'));

        $callSendApi->make($text->message('Oii, eu sou o bot'));
        $callSendApi->make($text->message('Você digitou ' . $message));
    }
}
