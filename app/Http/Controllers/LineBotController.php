<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追加
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonsTemplateBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;


class LineBotController extends Controller
{
    private LINEBot $bot;

    public function __construct()
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $this->bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);
    }

    // Webhook でメッセージを受信
    public function webhook(Request $request)
    {
        $events = $request->input('events', []);
        foreach ($events as $event) {
            if ($event['type'] === 'message' && $event['message']['type'] === 'text') {
                $replyToken = $event['replyToken'];
                $userMessage = $event['message']['text'];

                // 応答メッセージを作成
                $replyMessage = new TextMessageBuilder("あなたのメッセージ: " . $userMessage);

                // 返信を送信
                $this->bot->replyMessage($replyToken, $replyMessage);
            }
        }
        return response()->json(['status' => 'ok']);
    }

    // ユーザーに直接メッセージを送る（プッシュメッセージ）
    public function pushMessage($userId, $message)
    {
        $textMessageBuilder = new TextMessageBuilder($message);
        $response = $this->bot->pushMessage($userId, $textMessageBuilder);

        return response()->json(['status' => $response->getHTTPStatus()]);
    }
}
