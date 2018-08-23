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

$client = new Zelenin\Telegram\Bot\Api('503037693:AAGA8Jjmv4DXfQI3RVfgGgS2eLRProDqMFA');

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
    if($update->message->text == '/start'|| '/start@sperocoinbot') //Comando "/start" que retorna os todos os comando do bot ao iniciá-lo pela primeira vez
    {
        $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
        $response = $client->sendMessage([
            'chat_id' => $update->message->chat->id,
            'text' => "
                        📖 List of commands:\n
                        /status -> Get latest status \n
                        /price -> Get price in BTC, USD, BRL \n
                        /info -> Technical information \n
                        /social -> Shows the social networks of Spero \n
                        /email -> Get email address of the owner \n
                        /commands -> Shows list of available commands \n
                        /apk -> Download Apk Android(WebWallet Based) \n
                        /walletwindowsqt -> Download the latest version of QT wallet for Windows \n
                        /walletwindowsdaemon -> Download the latest version of daemon wallet for Windows \n
                        /compilelinux -> Compile Yourself Spero Code
                     "
            ]);

    }
    else if($update->message->text == '/email'|| '/email@sperocoinbot') //Comando "/email" que retorna o(s) e-mail('s) da Foundation SperoCoin
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $update->message->chat->id,
        	'text' => "
                        📝 You can send email to : sperocoin@gmail.com
                      "
     	]);
    }
    else if($update->message->text == '/commands'|| '/commands@sperocoinbot') //Comando "/commands" que retorna todos os comandos do bot
    {
    	$response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $update->message->chat->id,
    		'text' => "
                        📖 List of commands:\n
                        /status -> Get latest status \n
                        /price -> Get price in BTC, USD, BRL \n
                        /info -> Technical information \n
                        /social -> Shows the social networks of Spero \n
                        /email -> Get email address of the owner \n
                        /commands -> Shows list of available commands \n
                        /apk -> Download Apk Android(WebWallet Based) \n
                        /walletwindowsqt -> Download the latest version of QT wallet for Windows \n
                        /walletwindowsdaemon -> Download the latest version of daemon wallet for Windows \n
                        /compilelinux -> Compile Yourself Spero Code
                      "
    		]);

    }
    else if($update->message->text == '/status'|| '/status@sperocoinbot') //Comando "/status" que retorna o status atual da rede SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            📊 Here are the status of the Spero network: \n
                            👝 Version: ".$$api_info." \n
                            👝 Protocol:".$$api_info2." \n
                            👝 Wallet Version: ".$$api_info3." \n
                            🔰 We are on the block: ".$api_blockcount." \n
                            🔨 Mining Difficulty \n
                                PoW: ".$api_getdifficulty." \n
                                PoS: ".$api_getdifficulty2." \n
                            💰 Total coins distributed: ".$api_getmoneysupply." SPERO's \n
                            🔀 Network (MH/s): ".$api_getmininginfo."\n
                            🔄 Pos Weight: ".$api_be_getmininginfo_pos"
                          "
				]);

    }
    else if($update->message->text == '/price'|| '/price@sperocoinbot') //Comando "/price" que retorna os valores em diversas moedas de acordo com as exchanges que negociam a SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            💵 Price: \n
                                BRL: ".number_format($fase03, 3, ',', '.')." \n
                                BTC: ".number_format($calc_fase03_btc, 9, '.', ',')." \n
                                DOGE: ".number_format($calc_fase03_doge, 9, '.', ',')."\n
                                \n
                                Cotação/Price: Exchange Official - https://sperocoin.ddns.net/exchange
                          "
                ]);

    }
    else if($update->message->text == '/info'|| '/info@sperocoinbot') //Comando "/info" que retorna as informações gerais e técnicas da SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            General information: \n
                                Algorithm: X13 \n
                                Total currencies: 7 million \n
                                Block Time: 60 seconds \n
                                PoS Return: 25% per year \n
                                Difficulty reset to each block \n
                                100000 pre-mined coins \n
                                \n
                            Mining Phases:\n
                                Proof of Work + Proof of Stake: 0 - 33331 \n
                                Proof of Stake: 33332 - 263250 \n
                                Proof of Work + Proof of Stake: up to 263251 \n
                            🔰 We are on the block: ".$api_blockcount."
                            "
                ]);

    }
    else if($update->message->text == '/social'|| '/social@sperocoinbot') //Comando "/social" que retorna todas as redes sociais da SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            Spero social networks \n
                            Facebook: https://www.facebook.com/sperocoinofficial/ \n
                            Slack: http://sperocoin.slack.com/ \n
                            Telegram: https://t.me/sperocoin_official \n
                            Discord: https://discord.gg/zAMNCZj \n
                            Trello: https://trello.com/b/jYZvXKDs/sperocoin \n
                            Channel in Telegram: https://t.me/sperocoin_channel/
                          "
                ]);

    }
    else if($update->message->text == '/apk'|| '/apk@sperocoinbot') //Comando "/apk" que retorna o link para download da Wallet SperoCoin para dispositivos móveis
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            Download External Link: https://sperocoin.ddns.net/files/SperoCoin-v1.1BETA.apk \n
                            Download From Channel in Telegram: https://t.me/sperocoin_channel/8
                          "
                ]);

    }
    else if($update->message->text == '/walletwindowsqt'|| '/walletwindowsqt@sperocoinbot') //Comando "/walletwindowsqt" que retorna o link para download da QT Wallet SperoCoin para Windows
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            Download External Link: https://drive.google.com/open?id=19iKufDG64tKhjLiLtL6CIJ9t4Q2JEJ9f \n
                            Download From Channel in Telegram: https://t.me/sperocoin_official/2745
                          "
                ]);

    }
    else if($update->message->text == '/walletwindowsdaemon'|| '/walletwindowsdaemon@sperocoinbot') //Comando "/walletwindowsdaemon" que retorna o link para download da Wallet daemon SperoCoin para Windows
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
                            Download External Link: https://drive.google.com/open?id=1C1NWAABujE0KHHt3JJigm7ol9IaTva7J \n
                            Download From Channel in Telegram: https://t.me/sperocoin_official/2743
                          "
                ]);

    }
    else if($update->message->text == '/compilelinux'|| '/compilelinux@sperocoinbot') //Comando "/compilelinux" que retorna um texto explicativo de como instalar a Wallet em sistemas baseados em Linux
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => '
                            Download and install the dependencies:  \n
                            sudo apt-get install build-essential libboost-all-dev libcurl4-openssl-dev libdb5.3-dev libdb5.3++-dev qt-sdk libminiupnpc-dev qrencode libqrencode-dev git libtool automake autotools-dev autoconf pkg-config libssl-dev libgmp3-dev libevent-dev bsdmainutils
                             \n \n
                            Clone the github source code for the local machine: \n
                            git clone https://github.com/DigitalCoin1/DigitalCoinBRL
                             \n \n
                            Compile the daemon in the DigitalCoinBRL/src directory: \n
                            cd DigitalCoinBRL/src \n
                            make -f makefile.unix USE_UPNP=- USE_IPV6=1
                             \n \n
                            Run daemon in the DigitalCoinBRL/src directory: \n
                            ./SperoCoind
                             \n \n
                            [OPTIONAL]Compile the QT in the DigitalCoinBRL directory: \n
                            sudo apt-get install libqt5gui5 libqt5core5a libqt5dbus5 qttools5-dev qttools5-dev-tools libprotobuf-dev protobuf-compiler libqrencode-dev \n
                            qmake SperoCoin-qt.pro "USE_UPNP=-" "USE_QRCODE=1" \n
                            make -f Makefile
                          '
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
