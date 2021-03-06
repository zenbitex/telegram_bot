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
$api_doge = "https://api.altilly.com/api/public/ticker/SPERODOGE";
$union_api_doge = json_decode(file_get_contents($api_doge), true);
//LAST PRICE BRL
$latest_pricedoge = $union_api_doge['last'];

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
$latest_price_spero_doge = $latest_pricedoge;
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
    /price -> Get price in BTC, USD, BRL and DOGE
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
    /airdrop - See here all Airdrops that SPERO is performing
    /bounties - Find here the rewards you can earn by performing tasks
    /paymentsairdrop - Listing all AIRDROP payments
    /paymentsbounties -  Listing all bounties payments
    /lottery - Lottery SperoCoin
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
    /price -> Get price in BTC, USD, BRL and DOGE
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
    /airdrop - See here all Airdrops that SPERO is performing
    /bounties - Find here the rewards you can earn by performing tasks
    /paymentsairdrop - Listing all AIRDROP payments
    /paymentsbounties -  Listing all bounties payments
    /lottery - Lottery SperoCoin
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
    ETH: ".number_format($latest_price_spero_eth, 8, '.', ',')."
    DOGE: ".number_format($latest_price_spero_doge, 8, '.', ',')."
    BTC: ".number_format($latest_price_spero_btc, 8, '.', ',')."

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
Seleção para testadores do aplicativo QT SperoCoin Android aberta!
Segue link para responder o formulário:

https://goo.gl/forms/UebNFDiihL1VmIBi1

Número de vagas: 10
Pagamento: 100 SPERO cada
Data do Comunicado da Seleção: 27/10/2018
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
    BTC: ".number_format($preco_venda_btc, 8, '.', ',')."
    ETH: ".number_format($preco_venda_eth, 8, '.', ',')."
    DOGE: ".number_format($preco_venda_doge, 8, '.', ',')."

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
    BTC: ".number_format($preco_compra_btc, 8, '.', ',')."
    ETH: ".number_format($preco_compra_eth, 8, '.', ',')."
    DOGE: ".number_format($preco_compra_doge, 8, '.', ',')."

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
MERCADOPAGO: R$ 0,00
CELLCOIN: R$ 0,00

BTC: ".number_format($btc_balance, 9, ',', '.')."
ETH: ".number_format($eth_balance, 9, ',', '.')."
DOGE: ".number_format($doge_balance, 9, ',', '.')."

ADDRESS
BTC: 1EgizD93DWefuMi3JdXg5Rk4CM9acB8Uac
ETH: 0x2782128fdd8c61005c6abad2925abe68f1325707
DOGE: DNEfNPU771yMzBFQrortJQB1Wyi33S2inm
MERCADOPAGO: sperocoin@gmail.com
      "
                ]);

    }
    else if($update->message->text == '/airdrop'|| $update->message->text == '/airdrop@sperocoinbot') //Comando "/airdrop" que retorna o todos os eventos de AIRDROP ativos
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
AIRDROP 01(CLOSED):
AIRDROP AIODEX - CLOSED
Total number of participants: 15
*******************************
AIRDROP 02(CLOSED):
Total number of participants: 20
*******************************
AIRDROP 03:
Se a Spero chegar a 90 votos até o próximo sábado, dia 20/10/2018, estaremos sorteando 5 prêmios de 100 moedas para usuários daqui deste grupo!
Link da Votação: https://smarts.exchange/vote-SPERO.html

If Spero reaches 90 votes until next Saturday, 10/20/2018, we will be raffling 5 prizes of 100 coins for users from this group!
Vote Link: https://smarts.exchange/vote-SPERO.html
*******************************
      "
                ]);

    }
    else if($update->message->text == '/bounties'|| $update->message->text == '/bounties@sperocoinbot') //Comando "/bounties" que retorna todas as recompensas que a SPERO paga por cumprir tarefas
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Develop Android Wallet = 1000 SPERO
Develop IOs Wallet = 1000 SPERO
Develop MAC Wallet = 1000 SPERO
Exchange = 10,000 SPERO - PAY TO COINSMARKETS
3x Point of Exchange (Social Market) = 5,000

Translate our official topic and win coins!*
📣 CODE BTCTALK: https://github.com/DigitalCoin1/BTCTALK/blob/master/Modelo-PT-BR.txt
Awards:
BrandNew ou Newbie: 100 SPERO
Jr. Member: 200 SPERO
Member: 400 SPERO
Full Member: 600 SPERO
Sr. Member: 800 SPERO
Hero ou Legendary: 1200 SPERO
*Each verified user will receive only one (01) payment! We will not pay translations previously made available, stay up to date!

Translations:
Korean: https://bitcointalk.org/index.php?topic=2302789.0
Russian: https://bitcointalk.org/index.php?topic=2315313.0
Romanian: https://bitcointalk.org/index.php?topic=4601437.0
      "
                ]);

    }
    else if($update->message->text == '/paymentsairdrop'|| $update->message->text == '/paymentsairdrop@sperocoinbot') //Comando "/paymentsairdrop" que retorna todos os pagamentos realizados para AIRDROPS
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
AIRDROP 01 - AIODEX(CLOSED):
01 - Otahumele Nicholas - dd00846139ae87bc36644436e80b41076a25c1107d62752af157db41998b9731
02 - Rock Star - 105ae5c1d193aab5aa1a0d1733a0c63a378fe8ab8ba97e6021203cca2441e7f2
03 - Alan Hannah - ed97cea73084fe71919e9b59bc03ae0ca826ea527d0fa3391882f381731eaa9d
04 - Odigie Victor - ed97cea73084fe71919e9b59bc03ae0ca826ea527d0fa3391882f381731eaa9d
05 - Douglas Aquino - 3a5309be1b766e75697b96a5ff02e4a9a97015cff3c8e30c2e7685911e2c75aa
06 - Lucas Souza - adea32b198bb8db8b44bbd1107ef8c2e2f46b1e903c3923588cc96e47bcbd0ea
07 - Beatus Christian - 42d26f6bdad61794752b68d7e67b98c59c180cfac556e8b67d3e4802fe3ad975
08 - Gabriel Silva - 6491f381a3d0785257cc091ab82b6040dcd1a4c8ba32d818555f8ed9dd589ffa
09 - jefferson freitas - c57cda3d4e9a5b9bee3570c4b9d4431fbeb7d0f4df1ac559b92429d85c571414
10 - Nayara Urgal - 01b941c3bd714491f1f112dbe512d8dbb38be55b097cee51127b80910036ad86
11 - Samuel Di Centa - 7cd42ee262e0dd2a48138a990c6d7b1e92a1b024d54cbd5c61021faaf41c04d5
12 - Robert Hatfield - 113d32a850cbdf472726340416705df52a9e7ae5742a94b0091f2468c49b13d2
13 - Scott Recio - 113d32a850cbdf472726340416705df52a9e7ae5742a94b0091f2468c49b13d2
14 - Timothy Contreras - 113d32a850cbdf472726340416705df52a9e7ae5742a94b0091f2468c49b13d2
15 - Marvin Deen - 113d32a850cbdf472726340416705df52a9e7ae5742a94b0091f2468c49b13d2

AIRDROP 02 - TELEGRAM(CLOSED):
01 - @otahumele - 40fa9baf5346250f470873adf92b18b1c8f1760d1b1d8fc1a0d45d68498b76dd
02 - @Mhi23 - f704a4fb0274d68488082acfbd97a7d5df8a460e1171db280fa231382fd19730
03 - @JanEmilDenmark - e3b607f074d1d5861cac0b1892ff68a78571f8fd93df506df83564ce1b395632
04 - @Alekmarques - e3b607f074d1d5861cac0b1892ff68a78571f8fd93df506df83564ce1b395632
05 - @Rebelway518 - e3b607f074d1d5861cac0b1892ff68a78571f8fd93df506df83564ce1b395632
06 - @Alanhannah - e3b607f074d1d5861cac0b1892ff68a78571f8fd93df506df83564ce1b395632
07 - Odigie Victor - e3b607f074d1d5861cac0b1892ff68a78571f8fd93df506df83564ce1b395632
08 - @Trentux - 5f10707fb3faa634be07ef192bca8eb93de076dacb1d8c5fc4be33807097d42f
09 - @bb_christian - b73dd0d25778bb0c07fc3650dbf51188bd6f4b2d2509505adc1ca71b0efaa0e6
10 - @Regueromarley1 - f6290b3c314bca182ae3b0c845cf019904172975e5639745ce31ff5cfeebac26
11 - @Biel2435 - c03a6237bae115de60911803390c0a421c8185ea6bd5941abb779fbc0d2e3421
12 - @Jeffhinfreitas - b5483f2f0e6482771bad01402e1b7db51acd45df47c05770d3707cecac0dfe00
13 - @Odacir - 21a19f54536272543271328f327eaa0f149b6d9361cd2f15a5ada0f2383bb1ec
14 - @Leogarc9 - 2aec9b977e6ba8c317a3319dd36e14a3e513e38351d028ffe22d95bd8761a2e3
15 - @Sambit2017 - 6ba1ef89d941d4853a5de31445871b3a2ac8dba6b51abe9fd3249086b7375cdf
16 - Danilo Dukler - 9ba889961740750cd158acf019bbc8403cdb1dd5f71cd051a6b75f1e037b8843
17 - @CryptoExtrem - 7afee9d42d5fcf89935c1be29a9a9f5599c1aa4453a3a29b5ad933f37147b6db
18 - @nayaraurgal - 72ec4678e782ec9a4a27d1aa988f27a5213422c6995a8ac5c0e0cd9bce18f82c
19 - @Orleilson - b41b400a7945dc8807e7c41ce8f5f7291ebe12be03d457f39ee98c435db825dc
20 - @Jhonthas - b054f9cee5992c94c0164f5bf96882d1bc8844e4bbe69c6561996157f2c4c197
      "
                ]);
    }
    else if($update->message->text == '/paymentsbounties'|| $update->message->text == '/paymentsbounties@sperocoinbot') //Comando "/paymentsbounties" que retorna todos os pagamentos realizados por realização de tarefas
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
Wallet Android =
Wallet IOS =
Wallet MAC =
Exchange = http://35.198.22.94:3001/tx/954af0b2e80730721d2f5edc30708a636802a27e5dfaa22fbbd620d5399f3cf5
Point of Exchange (Social Market) =
Point of Exchange (Social Market) =
Point of Exchange (Social Market) =

TRANSLATIONS:
BrandNew ou Newbie =
Jr. Member =
Member =
Full Member =
Sr. Member =
Hero ou Legendary =
      "
                ]);
    }
    else if($update->message->text == '/lottery'|| $update->message->text == '/lottery@sperocoinbot') //Comando "/lottery" que abre as opções de envio de comandos para participar dos sorteios da SperoCoin
    {
            $response = $client->sendChatAction(['chat_id' => $update->message->chat->id, 'action' => 'typing']);
            $response = $client->sendMessage([
                'chat_id' => $update->message->chat->id,
                'text' => "
[PORTUGUÊS]
Premiação: 20 SPERO
Data do Sorteio: Todo sábado
Horário: 16h00min UTC -3:00
Lista de Comandos a serem utilizados:
/participar - Com este simples comando você estará participando dos sorteios realizados pela SperoCoin
/infosorteio - Mostra as informações do último sorteio
/sairsorteio - Remove você da participação do sorteio
/participantes - Ver número atual de participantes

[ENGLISH]
Awards: 20 SPERO
Date of Draw: Every Saturday
Time: 4:00 p.m. UTC -3: 00
List of Commands to be used:
/participar - With this simple command you will be participating in the draws made by SperoCoin
/infosorteio - Shows the information of the last draw
/sairsorteio - Remove you from the raffle participation
/participantes - View current number of participants

[ESPAÑOL]
Premiación: 20 SPERO
Fecha del sorteo: Todos los sábados
Horario: 16h00min UTC -3: 00
Lista de Comandos a utilizar:
/participar - Con este sencillo comando usted estará participando en los sorteos realizados por SperoCoin
/infosorteio - Muestra la información del último sorteo
/sairsorteio - Quita usted de la participación del sorteo
/participantes - Ver el número actual de participantes

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
