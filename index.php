<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
*
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('503037693:AAHS_bA1Gobu93DktuW6zKoQ_1ymq8LYsmM'); // Set your access token

//BLOCK EXPLORER
$be_blockcount = 'http://sperocoin.ddns.net:3001/api/getblockcount'; // BLOCK COUNT
$be_blockcount_api = json_decode(file_get_contents($be_blockcount), true);
$api_blockcount = $be_blockcount_api;


$be_getdifficulty = 'http://sperocoin.ddns.net:3001/api/getdifficulty'; // GET DIFFICULTY
$be_getdifficulty_api = json_decode(file_get_contents($be_getdifficulty), true);
$api_getdifficulty = $be_getdifficulty_api['proof-of-work'];

$be_getdifficulty2 = 'http://sperocoin.ddns.net:3001/api/getdifficulty'; // GET DIFFICULTY
$be_getdifficulty_api2 = json_decode(file_get_contents($be_getdifficulty2), true);
$api_getdifficulty2 = $be_getdifficulty_api2['proof-of-stake'];

$be_getmoneysupply = 'http://sperocoin.ddns.net:3001/ext/getmoneysupply'; //MONEY SUPPLY
$be_getmoneysupply_api = json_decode(file_get_contents($be_getmoneysupply), true);
$api_getmoneysupply = $be_getmoneysupply_api;

$be_getmininginfo = 'http://sperocoin.ddns.net:3001/api/getmininginfo'; //NETWORK INFO
$be_getmininginfo_api = json_decode(file_get_contents($be_getmininginfo), true);
$api_getmininginfo = $be_getmininginfo_api['netmhashps'];

$be_getmininginfo_pos = 'http://sperocoin.ddns.net:3001/api/getmininginfo'; //MINING POS INFO
$be_getmininginfo_pos_api = json_decode(file_get_contents($be_getmininginfo_pos), true);
$api_be_getmininginfo_pos = $be_getmininginfo_pos_api['netstakeweight'];

//FUNCTION BRAZILIEX
$api_braziliex = "https://braziliex.com/api/v1/public/ticker";
$union_api_braziliex = json_decode(file_get_contents($api_braziliex), true);
//BITCOIN_BRL
$result_braziliex = $union_api_braziliex['btc_brl'];
//LAST PRICE BRL
$latest_pricebr = $result_braziliex['last'];
//24h tradeBRL
$day_pricebr = $result_braziliex['baseVolume24'];
//FUNCTION BRAZILIEX

//FUNCTION BITCOIN_USD
$api_bitcoin = "https://blockchain.info/pt/ticker";
$union_api_bitcoin = json_decode(file_get_contents($api_bitcoin), true);
//BITCOIN_DOLAR
$result_bitcoin_dolar = $union_api_bitcoin['USD'];

//LAST PRICE USD
$latest_priceusd = $result_bitcoin_dolar['last'];
//24h trade USD
$day_priceusd = $result_bitcoin_dolar['15m'];

//DÓLAR
$api_dolar = "http://data.fixer.io/api/latest?access_key=6690e94877140dd5738a2befffe31b84&format=1";
$juncao_api_dolar = json_decode(file_get_contents($api_dolar), true);
$array_dolar = array_reverse($juncao_api_dolar['rates']);
$resultado_dolar = $array_dolar['BRL'];

//FUNCTION DOGE
$api_doge = "https://api.cryptonator.com/api/ticker/doge-usd";
$union_api_doge = json_decode(file_get_contents($api_doge), true);
//DOGE_USD
$result_doge_dolar = $union_api_doge['price'];
//DOGE_USD_TO_BRL
$result_doge_brl = $result_doge_dolar / resultado_dolar;



//FASES
$fase01 = 0.03;
$fase02 = 0.05;
$fase03 = 0.12;
$fase04 = 0.25;
$fase05 = 0.60;

//FASE ATUAL
$faseatual = $fase03;

//CALULO DAS FASES
//FASE 01
$calc_fase01_brl = $fase01 / $latest_pricebr;
$calc_fase01_usd = $fase01 / $resultado_dolar;
$calc_fase01_doge = $fase01 / $result_doge_brl;
//FASE 02
$calc_fase02_brl = $fase02 / $latest_pricebr;
$calc_fase02_usd = $fase02 / $resultado_dolar;
$calc_fase02_doge = $fase02 / $result_doge_brl;
//FASE 03
$calc_fase03_brl = $fase03 / $latest_pricebr;
$calc_fase03_usd = $fase03 / $resultado_dolar;
$calc_fase03_doge = $fase03 / $result_doge_brl;
//FASE 04
$calc_fase04_brl = $fase04 / $latest_pricebr;
$calc_fase04_usd = $fase04 / $resultado_dolar;
$calc_fase04_doge = $fase04 / $result_doge_brl;
//FASE 05
$calc_fase05_brl = $fase05 / $latest_pricebr;
$calc_fase05_usd = $fase05 / $resultado_dolar;
$calc_fase05_doge = $fase05 / $result_doge_brl;

$update = json_decode(file_get_contents('php://input'));

//your app
try {
    if($update->message->text == '/start')
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => "📖 List of commands:\n /status -> Get latest status \n /price -> Get price in BTC, USD, BRL \n /info -> Technical information \n /social -> Shows the social networks of Spero  \n /email -> Get email address of the owner \n /commands -> Shows list of available commands"
            ]);

    }
    else if($update->message->text == '/email')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "📝 You can send email to : sperocoin@gmail.com"
     	]);
    }
    else if($update->message->text == '/commands')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "📖 List of commands:\n /status -> Get latest status \n /price -> Get price in BTC, USD, BRL \n /info -> Technical information \n /social -> Shows the social networks of Spero  \n /email -> Get email address of the owner \n /commands -> Shows list of available commands \n /apk -> Download Apk Android(WebWallet Based)"
    		]);

    }
    else if($update->message->text == '/status')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "📊 Here are the status of the Spero network: \n🔰 We are on the block: ".$api_blockcount." \n🔨 Mining Difficulty\n PoW: ".$api_getdifficulty."\n PoS: ".$api_getdifficulty2."\n💰 Total coins distributed: ".$api_getmoneysupply." SPERO's \n🔀 Network (MH/s): ".$api_getmininginfo."\n🔄 Pos Weight: ".$api_be_getmininginfo_pos
				]);

    }
    else if($update->message->text == '/price')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "💵 Price: \n BRL: ".number_format($fase03, 3, ',', '.')." \n USD: ".number_format($calc_fase03_usd, 3, ',', '.')." \n BTC: ".number_format($calc_fase03_brl, 9, '.', ',')." \n DOGE: ".number_format($result_doge_dolar, 9, '.', ',')."\n \n Cotação/Price: Exchange Official - https://sperocoin.ddns.net/exchange "
                ]);

    }
    else if($update->message->text == '/info')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "General information: \n Algorithm: X13\n Total currencies: 7 million\n Block Time: 60 seconds\n PoS Return: 25% per year\n Difficulty reset to each block\n 100000 pre-mined coins\n \n Mining Phases:\n Proof of Work + Proof of Stake: 0 - 33331\n Proof of Stake: 33332 - 263250\n Proof of Work + Proof of Stake: up to 263251\n🔰 We are on the block: ".$api_blockcount.""
                ]);

    }
    else if($update->message->text == '/social')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "Spero social networks\n Facebook: https://www.facebook.com/sperocoinofficial/\n Slack: http://sperocoin.slack.com/\n Telegram: https://t.me/sperocoin_official\n Discord: https://discord.gg/zAMNCZj\n Trello: https://trello.com/b/jYZvXKDs/sperocoin\n Channel in Telegram: https://t.me/sperocoin_channel/"
                ]);

    }
    else if($update->message->text == '/apk')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "Download External Link: https://sperocoin.ddns.net/files/SperoCoin-v1.1BETA.apk \n Download From Channel in Telegram: https://t.me/sperocoin_channel/8"
                ]);

    }
    else
    {
    	/*$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Invalid command, please use /commands to get list of available commands"
    		]);*/
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
