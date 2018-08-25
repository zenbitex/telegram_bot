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

$client = new Zelenin\Telegram\Bot\Api('503037693:AAHwo5O_meCj-5Q68KeQ0lKQIDAL90dF6CM');

//BLOCK EXPLORER
$be_blockcount = 'http://35.198.22.94:3001/api/getblockcount'; // BLOCK COUNT
$be_blockcount_api = json_decode(file_get_contents($be_blockcount), true);
$api_blockcount = $be_blockcount_api;

$be_info = 'http://35.198.22.94:3001/api/getinfo'; // GETINFO
$be_info_api = json_decode(file_get_contents($be_info), true);
$api_info = $be_info_api['version'];
$api_info2 = $be_info_api['protocolversion'];
$api_info3 = $be_info_api['walletversion'];

$be_getdifficulty = 'http://35.198.22.94:3001/api/getdifficulty'; // GET DIFFICULTY POW
$be_getdifficulty_api = json_decode(file_get_contents($be_getdifficulty), true);
$api_getdifficulty = $be_getdifficulty_api['proof-of-work'];

$be_getdifficulty2 = 'http://35.198.22.94:3001/api/getdifficulty'; // GET DIFFICULTY POS
$be_getdifficulty_api2 = json_decode(file_get_contents($be_getdifficulty2), true);
$api_getdifficulty2 = $be_getdifficulty_api2['proof-of-stake'];

$be_getmoneysupply = 'http://35.198.22.94:3001/ext/getmoneysupply'; //MONEY SUPPLY
$be_getmoneysupply_api = json_decode(file_get_contents($be_getmoneysupply), true);
$api_getmoneysupply = $be_getmoneysupply_api;

$be_getmininginfo = 'http://35.198.22.94:3001/api/getmininginfo'; //NETWORK INFO
$be_getmininginfo_api = json_decode(file_get_contents($be_getmininginfo), true);
$api_getmininginfo = $be_getmininginfo_api['netmhashps'];

$be_getmininginfo_pos = 'http://35.198.22.94:3001/api/getmininginfo'; //WEIGHT NETWORK POS INFO
$be_getmininginfo_pos_api = json_decode(file_get_contents($be_getmininginfo_pos), true);
$api_be_getmininginfo_pos = $be_getmininginfo_pos_api['netstakeweight'];

//FUNCTION BITCOIN
$api_bitcoin = "https://api.coingecko.com/api/v3/coins/bitcoin";
$union_api_bitcoin = json_decode(file_get_contents($api_bitcoin), true);

//BITCOIN_DOLAR
$result_bitcoin_dolar = $union_api_bitcoin['market_data'];
$result_bitcoin_dolar2 = $result_bitcoin_dolar['current_price'];

//LAST PRICE BRL
$latest_pricebtc = $result_bitcoin_dolar2['brl'];


//FUNCTION DOGE
$api_doge = "https://api.coingecko.com/api/v3/coins/dogecoin";
$union_api_doge = json_decode(file_get_contents($api_doge), true);
//DOGE_USD
$result_doge_dolar = $union_api_doge['market_data'];
$result_doge_dolar2 = $result_doge_dolar['current_price'];
//LAST PRICE BRL
$latest_pricedoge = $result_doge_dolar2['brl'];

//FUNCTION SPERO
$api_spero = "https://api.coingecko.com/api/v3/coins/sperocoin";
$union_api_spero = json_decode(file_get_contents($api_spero), true);
//DOGE_USD
$result_spero_market = $union_api_spero['market_data'];
$result_spero_current = $result_spero_market['current_price'];
//LAST PRICE BRL
$latest_price_spero = $result_spero_current['brl'];
$latest_price_spero_eth = $result_spero_current['eth'];
$latest_price_spero_btc = $result_spero_current['btc'];
$latest_price_spero_doge = $latest_price_spero / $latest_pricedoge;
//FASES
$fase01 = 0.03; // R$0,03
$fase02 = 0.05; // R$0,05
$fase03 = 0.12; // R$0,12
$fase04 = 0.25; // R$0,25
$fase05 = 0.60; // R$0,60

//FASE ATUAL
$faseatual = $fase03;

//CALULO DAS FASES
//FASE 01
$calc_fase01_btc = $fase01 / $latest_pricebtc;
$calc_fase01_doge = $fase01 / $latest_pricedoge;
//FASE 02
$calc_fase02_btc = $fase02 / $latest_pricebtc;
$calc_fase02_doge = $fase02 / $latest_pricedoge;
//FASE 03
$calc_fase03_btc = $fase03 / $latest_pricebtc;
$calc_fase03_doge = $fase03 / $latest_pricedoge;
//FASE 04
$calc_fase04_btc = $fase04 / $latest_pricebtc;
$calc_fase04_doge = $fase04 / $latest_pricedoge;
//FASE 05
$calc_fase05_btc = $fase05 / $latest_pricebtc;
$calc_fase05_doge = $fase05 / $latest_pricedoge;

$update = json_decode(file_get_contents('php://input'));

//your app
try {
    if($update->message->text == '/start') //Comando "/start" que retorna os todos os comando do bot ao iniciá-lo pela primeira vez
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => "
📖 List of commands:
    /status -> Get latest status
    /price -> Get price in BTC, USD, BRL
    /info -> Technical information
    /social -> Shows the social networks of Spero
    /email -> Get email address of the owner
    /commands -> Shows list of available commands
    /apk -> Download Apk Android(WebWallet Based)
    /walletwindowsqt -> Download the latest version of QT wallet for Windows
    /walletwindowsdaemon -> Download the latest version of daemon wallet for Windows
    /compilelinux -> Compile Yourself Spero Code
 "
            ]);

    }
    else if($update->message->text == '/email'|| $update->message->text == '/email@sperocoinbot') //Comando "/email" que retorna o(s) e-mail('s) da Foundation SperoCoin
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => "
    📝 You can send email to : sperocoin@gmail.com
  "
        ]);
    }
    else if($update->message->text == '/commands'|| $update->message->text == '/commands@sperocoinbot') //Comando "/commands" que retorna todos os comandos do bot
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => "
📖 List of commands:
    /status -> Get latest status
    /price -> Get price in BTC, USD, BRL
    /info -> Technical information
    /social -> Shows the social networks of Spero
    /email -> Get email address of the owner
    /commands -> Shows list of available commands
    /apk -> Download Apk Android(WebWallet Based)
    /walletwindowsqt -> Download the latest version of QT wallet for Windows
    /walletwindowsdaemon -> Download the latest version of daemon wallet for Windows
    /compilelinux -> Compile Yourself Spero Code
  "
            ]);

    }
    else if($update->message->text == '/status'|| $update->message->text == '/status@sperocoinbot') //Comando "/status" que retorna o status atual da rede SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
📊 Here are the status of the Spero network:
    👝 Version: ".$api_info."
    👝 Protocol:".$api_info2."
    👝 Wallet Version: ".$api_info3."
🔰 We are on the block: ".$api_blockcount."
🔨 Mining Difficulty
    PoW: ".$api_getdifficulty."
    PoS: ".$api_getdifficulty2."
💰 Total coins distributed: ".$api_getmoneysupply." SPERO's
🔀 Network (MH/s): ".$api_getmininginfo."
🔄 Pos Weight: ".$api_be_getmininginfo_pos
                ]);

    }
    else if($update->message->text == '/price'|| $update->message->text == '/price@sperocoinbot') //Comando "/price" que retorna os valores em diversas moedas de acordo com as exchanges que negociam a SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
💵 Price:
Cotação/Price: Exchange Official:
    BRL: ".number_format($fase03, 3, ',', '.')."
    BTC: ".number_format($calc_fase03_btc, 9, '.', ',')."
    DOGE: ".number_format($calc_fase03_doge, 9, '.', ',')."

https://sperocoin.ddns.net/exchange

Cotação/Price: Altilly
    BRL: ".number_format($latest_price_spero, 3, ',', '.')."
    ETH: ".number_format($latest_price_spero_eth, 9, ',', '.')."
    DOGE: ".number_format($latest_price_spero_doge, 9, ',', '.')."
    BTC: ".number_format($latest_price_spero_btc, 9, ',', '.')."

https://altilly.com
      "
                ]);

    }
    else if($update->message->text == '/info'|| $update->message->text == '/info@sperocoinbot') //Comando "/info" que retorna as informações gerais e técnicas da SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
General information:
Algorithm: X13
Total currencies: 7 million
Block Time: 60 seconds
PoS Return: 25% per year
Difficulty reset to each block
100000 pre-mined coins

Mining Phases:
    Proof of Work + Proof of Stake: 0 - 33331
    Proof of Stake: 33332 - 263250
    Proof of Work + Proof of Stake: up to 263251
🔰 We are on the block: ".$api_blockcount."
        "
                ]);

    }
    else if($update->message->text == '/social'|| $update->message->text == '/social@sperocoinbot') //Comando "/social" que retorna todas as redes sociais da SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Spero social networks
    Facebook: https://www.facebook.com/sperocoinofficial/
    Slack: http://sperocoin.slack.com/
    Telegram: https://t.me/sperocoin_official
    Discord: https://discord.gg/zAMNCZj
    Trello: https://trello.com/b/jYZvXKDs/sperocoin
    Channel in Telegram: https://t.me/sperocoin_channel/
      "
            ]);

    }
    else if($update->message->text == '/apk'|| $update->message->text == '/apk@sperocoinbot') //Comando "/apk" que retorna o link para download da Wallet SperoCoin para dispositivos móveis
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Download External Link: https://sperocoin.ddns.net/files/SperoCoin-v1.1BETA.apk
Download From Channel in Telegram: https://t.me/sperocoin_channel/8
      "
                ]);

    }
    else if($update->message->text == '/walletwindowsqt'|| $update->message->text == '/walletwindowsqt@sperocoinbot') //Comando "/walletwindowsqt" que retorna o link para download da QT Wallet SperoCoin para Windows
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Download External Link: https://drive.google.com/open?id=19iKufDG64tKhjLiLtL6CIJ9t4Q2JEJ9f
Download From Channel in Telegram: https://t.me/sperocoin_official/2745
      "
                ]);

    }
    else if($update->message->text == '/walletwindowsdaemon'|| $update->message->text == '/walletwindowsdaemon@sperocoinbot') //Comando "/walletwindowsdaemon" que retorna o link para download da Wallet daemon SperoCoin para Windows
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Download External Link: https://drive.google.com/open?id=1C1NWAABujE0KHHt3JJigm7ol9IaTva7J
Download From Channel in Telegram: https://t.me/sperocoin_official/2743
      "
                ]);

    }
    else if($update->message->text == '/compilelinux'|| $update->message->text == '/compilelinux@sperocoinbot') //Comando "/compilelinux" que retorna um texto explicativo de como instalar a Wallet em sistemas baseados em Linux
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Download and install the dependencies:
    sudo apt-get install build-essential libboost-all-dev libcurl4-openssl-dev libdb5.3-dev libdb5.3++-dev qt-sdk libminiupnpc-dev qrencode libqrencode-dev git libtool automake autotools-dev autoconf pkg-config libssl-dev libgmp3-dev libevent-dev bsdmainutils

Clone the github source code for the local machine:
    git clone https://github.com/DigitalCoin1/DigitalCoinBRL

Compile the daemon in the DigitalCoinBRL/src directory:
    cd DigitalCoinBRL/src
    make -f makefile.unix USE_UPNP=- USE_IPV6=1

Run daemon in the DigitalCoinBRL/src directory:
    ./SperoCoind
      "
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

} catch (\Zelenin\Telegram\BototOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
