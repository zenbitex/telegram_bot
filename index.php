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


//MARKETS
//FUNCTION COINS MARKETS
$api_coinsmarkets = "https://coinsmarkets.com/apicoin.php";
$union_api_coinsmarkets = json_decode(file_get_contents($api_coinsmarkets), true);
//BITCOIN_SPEROCOIN
$result_coinsmarkets = $union_api_coinsmarkets['BTC_SPERO'];
//LAST PRICE
$latest_pricecm = $result_coinsmarkets['last'];
//24h trade
$day_pricecm = $result_coinsmarkets['24htrade'];
//FUNCTION COINS MARKETS

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

$multi = $result_coinsmarkets['last'] * $result_braziliex['last'];
$multiusd = $result_coinsmarkets['last'] * $result_bitcoin_dolar['last'];

$update = json_decode(file_get_contents('php://input'));

//your app
try {

    if($update->message->text == '/email')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "You can send email to : sperocoin@gmail.com"
     	]);
    }
    else if($update->message->text == '/help')
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "List of commands:\n /status -> Get latest status \n /price -> Get price in BTC, USD, BRL  \n /email -> Get email address of the owner \n /help -> Shows list of available commands"
    		]);

    }
    else if($update->message->text == '/status')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "Here are the status of the Spero network: \n We are on the block: ".$api_blockcount." \n Mining Difficulty\n PoW: ".$api_getdifficulty."\n PoS: ".$api_getdifficulty2."\n Total coins distributed: ".$api_getmoneysupply." SPERO's \n Network (MH/s): ".$api_getmininginfo."\n Pos Weight: ".$api_be_getmininginfo_pos
				]);

    }
    else if($update->message->text == '/price')
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "Price: \n BTC: ".$latest_pricecm."\n USD: ".number_format($multiusd, 2, ',', '.')."\n BRL: ".number_format($multi, 2, ',', '.')
                ]);

    }
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "Invalid command, please use /help to get list of available commands \xE2\x9C\x82"
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
