<?php
require_once('./LINEBotTiny.php');

$channelAccessToken = 'wuiiyhKFDa3mg0ZjiqfuychtvyO3QGFddGUxafxT8k1t+8KHWi+geKDW0em8YwksBNHuA+P4TTGtuoSWi/fKqtTZ64vdQRNHAf5Hx75h8FIa9QSJbDB3I6OLHNOnAvqnoCT1fvkfeC5lu3VMPyMRBgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '5774f7a3997f3c6e5b4c6be941ffc289';

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => implode(",",$event)
                            ]
                        ]
                    ]);
                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};