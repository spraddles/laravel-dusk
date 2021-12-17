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
            //'BTCUSD' => $this->lastName, // usage: $fake['last_name']
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





        $this->browse(function (Browser $browser) {

            // CSS selectors
            $chartsLink = 'div.tv-main > div.tv-header.tv-header__top.js-site-header-container.tv-header--sticky.tv-header--promo.tv-header--animated > div.tv-header__inner > div.tv-header__middle-content > nav > ul > li:nth-child(1) > a';
            $coinList = '#header-toolbar-symbol-search';
            $exchangeButton = '[data-name="symbol-search-items-dialog"] .apply-common-tooltip';
            $exchangeInput = '[data-outside-boundary-for="exchanges-search"] input';
            $exchangeName = '[data-outside-boundary-for="exchanges-search"] [data-name="exchanges-search"] div[class^="exchangeItemsContainer-"] div[class^="wrap-"]:first-of-type';
            $coinInput = '[data-dialog-name="Symbol Search"] input';
            $coinOption = '[data-dialog-name="Symbol Search"] div[class^="listContainer-"]  div[class^="itemRow-"]:nth-of-type(2)';
            $cookieButton = '[data-role="toast-container"] div[class^="toast-wrapper-"] div[class^="actions-"] button';
            $expandToolBar = '.layout__area--bottom #footer-chart-panel div[class^="buttons-"] [data-name="toggle-visibility-button"]';
            $pineScriptTab = '#footer-chart-panel div[class^="tab-"][title="Open Pine Script Editor"]';
            $pineScriptTextInput = '.layout__area--bottom #bottom-area .tv-script-editor-container .ace_content';
            $pineScriptTextInputType = '.layout__area--bottom #bottom-area .tv-script-editor-container textarea.ace_text-input';



            $browser
                ->visit('https://www.tradingview.com/' )

                // $browser->waitFor('.selector');

                ->pause( 1500 )
                ->press( $chartsLink )

                ->pause( 2500 )
                ->press( $coinList )

                ->press( $exchangeButton )

                ->pause( 1000 )
                ->type( $exchangeInput, 'binance' )
                ->press( $exchangeName )

                ->pause( 1000 )
                ->clear( $coinInput )
                ->type( $coinInput, 'XRPUSD' )

                ->pause( 1000 )
                ->press( $coinOption )

                ->press( $cookieButton )

                ->press( $expandToolBar )

                ->press( $pineScriptTab )

                ->pause( 1000 )
                ->click( $pineScriptTextInput )
                ->keys( $pineScriptTextInputType, ['{command}', 'a'], ['{delete}'])







                





                ->pause(4000);

                //->assertVisible('.index-page')

        });
    }
}
