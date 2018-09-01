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
//MARKETCAP
$marketcap = $result_spero_market['market_cap'];
$mktcap = $marketcap['brl'];
//24 HOUR TRADING VOL
$vol = $result_spero_market['total_volume'];
$vol_trading = $vol ['brl'];

//PERCENTUAL DE VENDA
$perc_venda = 0.05;
//PERCENTUAL DE COMPRA
$perc_compra = 0.10;

//PREÇO DE VENDA
$preco_venda_reais = $latest_price_spero - ($latest_price_spero / 100 * $perc_venda);
$preco_venda_btc = $latest_price_spero_btc - ($latest_price_spero_btc / 100 * $perc_venda);
$preco_venda_eth = $latest_price_spero_eth - ($latest_price_spero_eth / 100 * $perc_venda);
$preco_venda_doge = $latest_price_spero_doge - ($latest_price_spero_doge / 100 * $perc_venda);

//PREÇO DE COMPRA
$preco_compra_reais = $latest_price_spero + ($latest_price_spero / 100 * $perc_compra);
$preco_compra_btc = $latest_price_spero_btc + ($latest_price_spero_btc / 100 * $perc_compra);
$preco_compra_eth = $latest_price_spero_eth + ($latest_price_spero_eth / 100 * $perc_compra);
$preco_compra_doge = $latest_price_spero_doge + ($latest_price_spero_doge / 100 * $perc_compra);

//ENDEREÇO BTC
$address_btc = "https://blockchain.info/q/addressbalance/1EgizD93DWefuMi3JdXg5Rk4CM9acB8Uac";
$address_btc_api = json_decode(file_get_contents($address_btc), true);
$btc_balance = $address_btc_api;

//ENDEREÇO ETH
$address_eth = "http://api.ethplorer.io/getAddressInfo/0x2782128fdd8c61005c6abad2925abe68f1325707?apiKey=freekey";
$address_eth_api = json_decode(file_get_contents($address_eth), true);
$eth_api = $address_eth_api['ETH'];
$eth_balance = $eth_api['balance'];

//ENDEREÇO DOGE
$address_doge = "https://chain.so/api/v2/get_address_balance/DOGE/DNEfNPU771yMzBFQrortJQB1Wyi33S2inm/50";
$address_doge_api = json_decode(file_get_contents($address_doge), true);
$doge_api = $address_doge_api['data'];
$doge_balance = $doge_api['confirmed_balance'];

//ENDEREÇO SPERO
$address_spero = "http://35.198.22.94:3001/ext/getbalance/SX2czsni9LUY8574eXQhsQnnz46ZU8r4sf";
$address_spero_api = json_decode(file_get_contents($address_spero), true);
$spero_balance = $address_spero_api;

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
    /p2pbuy - Buy ​​SperoCoin in P2P mode in a group on the Telegram
    /p2psell - Sell SperoCoin ​​in P2P mode in a group on the Telegram
    /p2pbalance - Return all balances
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
    /p2pbuy - Buy ​​SperoCoin in P2P mode in a group on the Telegram
    /p2psell - Sell SperoCoin ​​in P2P mode in a group on the Telegram
    /p2pbalance - Return all balances
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
Cotação/Price: Altilly
    BRL: ".number_format($latest_price_spero, 3, ',', '.')."
    ETH: ".number_format($latest_price_spero_eth, 9, ',', '.')."
    DOGE: ".number_format($latest_price_spero_doge, 9, ',', '.')."
    BTC: ".number_format($latest_price_spero_btc, 9, ',', '.')."

https://altilly.com

Market Cap: BRL: ".number_format($mktcap, 2, ',', '.')."
24 Hour Trading Volume: BRL: ".number_format($vol_trading, 2, ',', '.')."
Fonte: https://www.coingecko.com/en/coins/sperocoin
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
Download External Link: https://drive.google.com/open?id=1MqVX9DgHTyK9bMKZZLCvM2fspUr8dHf0
Download From Channel in Telegram: https://t.me/sperocoin_channel/204
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
    git clone https://github.com/DigitalCoin1/SperoCoin

Compile the daemon in the SperoCoin/src directory:
    cd SperoCoin/src
    make -f makefile.unix USE_UPNP=- USE_IPV6=1

Run daemon in the SperoCoin/src directory:
    ./SperoCoind
      "
                ]);
    }
    else if($update->message->text == '/p2pbuy'|| $update->message->text == '/p2pbuy@sperocoinbot') //Comando "/p2pbuy" que retorna um texto explicativo de como comprar no grupo P2P no Telegram
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
[PT] A SperoCoin pode ser comprada no modo P2P oficialmente pelos seguintes preços:
[EN] SperoCoin can be purchased in P2P mode officially for the following prices:
[ES] SperoCoin se puede comprar en el modo P2P oficialmente por los siguientes precios:
[CH] SperoCoin可以以P2P模式正式購買，價格如下：
[RU] SperoCoin можно приобрести в режиме P2P официально по следующим ценам:

    REAIS(BRL): R$ ".number_format($preco_venda_reais, 2, ',', '.')."
    BTC: ".number_format($preco_venda_btc, 8, ',', '.')."
    ETH: ".number_format($preco_venda_eth, 8, ',', '.')."
    DOGE: ".number_format($preco_venda_doge, 8, ',', '.')."

[PT] Para comprar entre no grupo e participe da comercialização livre:https://t.me/sperocoinexchange
[EN] To buy in the group and participate in the free marketing: https://t.me/sperocoinexchange
[ES] Para comprar entre en el grupo y participar en la comercialización libre: https://t.me/sperocoinexchange
[CH] 在團體中購買並參與免費營銷： https://t.me/sperocoinexchange
[RU] Чтобы купить в группе и принять участие в свободном маркетинге: https://t.me/sperocoinexchange
      "
                ]);
    }
    else if($update->message->text == '/p2psell'|| $update->message->text == '/p2psell@sperocoinbot') //Comando "/p2psell" que retorna um texto explicativo de como vender no grupo P2P no Telegram
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
[PT] A SperoCoin pode ser vendida no modo P2P oficialmente pelos seguintes preços:
[EN] SperoCoin can be sold in P2P mode officially for the following prices:
[ES] SperoCoin puede venderse en el modo P2P oficialmente por los siguientes precios:
[CH] SperoCoin可以以P2P模式正式銷售，價格如下：
[RU] SperoCoin может быть продан в режиме P2P официально по следующим ценам:

    REAIS(BRL): R$ ".number_format($preco_compra_reais, 2, ',', '.')."
    BTC: ".number_format($preco_compra_btc, 8, ',', '.')."
    ETH: ".number_format($preco_compra_eth, 8, ',', '.')."
    DOGE: ".number_format($preco_compra_doge, 8, ',', '.')."

[PT] Para comprar entre no grupo e participe da comercialização livre:https://t.me/sperocoinexchange
[EN] To buy in the group and participate in the free marketing: https://t.me/sperocoinexchange
[ES] Para comprar entre en el grupo y participar en la comercialización libre: https://t.me/sperocoinexchange
[CH] 在團體中購買並參與免費營銷： https://t.me/sperocoinexchange
[RU] Чтобы купить в группе и принять участие в свободном маркетинге: https://t.me/sperocoinexchange
      "
                ]);
    }
    else if($update->message->text == '/p2pbalance'|| $update->message->text == '/p2pbalance@sperocoinbot') //Comando "/p2pbalance" que retorna o saldo atual das wallets da Exchange P2P
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
SPERO: ".number_format($spero_balance, 9, ',', '.')."

REAIS(BRL): R$: 0,00
BTC: ".number_format($btc_balance, 9, ',', '.')."
ETH: ".number_format($eth_balance, 9, ',', '.')."
DOGE: ".number_format($doge_balance, 9, ',', '.')."

ADDRESS
BTC: 1EgizD93DWefuMi3JdXg5Rk4CM9acB8Uac
ETH: 0x2782128fdd8c61005c6abad2925abe68f1325707
DOGE: DNEfNPU771yMzBFQrortJQB1Wyi33S2inm
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
