<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {

        $strategy = [
            $name = 'Strategy 1',
            $filepath = './files/strategy-1.txt'
        ];

        $coins = [
            'BTCUSD',
            'ETHUSD',
            'MATICUSD',
            'XRPUSD',
            'LUNAUSD',
            'BNBUSD',
            'SOLUSD',
            'EOSUSD',
            'ADAUSD',
            'LTCUSD',
            'TRXUSD',
            'DOTUSD',
            'WAXPUSD',
            'BCHUSD',
            'XTZUSD'
        ];

        $date_range = [
            '2021',
            '32w',
            '16w',
            '8w',
            '3w'
        ];

        $intervals = [
            '5m',
            '15m',
            '30m',
            '45m',
            '1h',
            '2h',
            '3h',
            '4h',
            '1d'
        ];

        $data_points = [
            'Coin',
            'Exchange',
            'Date range',
            'Net profit',
            'B+H',
            'Difference',
            'Total Trades closed',
            'Trades p/day [calculated]',
            'Trades open',
            'Winning trades',
            'Losing trades',
            'Percent profitable',
            'Win loss ratio'
        ];


        // FOR EACH $strategy:

            // set strategy name
            // create TXT file

            // FOR EACH $coins:

            // click: coin list
            // click: filter exchange
            // type: Binance
            // type: coin
            // select: coin

                // FOR EACH $date_range:
            
                // click: open strategy
                // select: new blank strategy
                // select all & paste from file (set timeframe variables)
                // set commission value

                    // FOR EACH $intervals:

                    // select interval
                    // get details (from overview & performace tabs) & store as variables
                    // append into existing TXT file

            // clear chart!  [data-name="legend-delete-action"]
            // repeat



        // CSV format:
        // Coin,Exchange,Date range,Net profit,B+H,Difference,Total Trades closed,Trades p/day[calculated],Trades open,Winning trades,Losing trades,Percent profitable,Win loss ratio







        // selectors
        $chartLink = '@open-invite-modal-button';


        $this->browse(function (Browser $browser) {
            $browser

                ->visit('https://www.tradingview.com/', 2000)
                //->assertVisible('.index-page')

                ->press('div.tv-main > div.tv-header.tv-header__top.js-site-header-container.tv-header--sticky.tv-header--promo.tv-header--animated > div.tv-header__inner > div.tv-header__middle-content > nav > ul > li:nth-child(1) > a')





                ->pause(5000)
                ->assertPresent('html');

        });
    }
}
