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

            // login
            $userArea = '.tv-header__user-menu-button.tv-header__user-menu-button--anonymous.js-header-user-menu-button';
            $signInLink = 'div[class^="item-"][data-name="header-user-menu-sign-in"]';
            $emailLink = '.tv-signin-dialog__social.tv-signin-dialog__toggle-email.js-show-email';
            $focusUser = '.tv-signin-dialog input[id^="email-signin__user-name-input__"]';
            $focusPassword = '.tv-signin-dialog input[id^="email-signin__password-input__"]';
            $username = env('TV_USERNAME');
            $password = env('TV_PASSWORD');
            $signInButton = '.tv-signin-dialog__footer button[id^="email-signin__submit-button__"]';
            $chartLink = 'a[data-main-menu-root-track-id="chart"]';

            // coins & exchanges
            $coinList = '#header-toolbar-symbol-search';
            $exchangeButton = '[data-name="symbol-search-items-dialog"] .apply-common-tooltip';
            $exchange = 'binance';
            $exchangeInput = '[data-outside-boundary-for="exchanges-search"] input';
            $exchangeName = '[data-outside-boundary-for="exchanges-search"] [data-name="exchanges-search"] div[class^="exchangeItemsContainer-"] div[class^="wrap-"]:first-of-type';
            $coin = 'XRPUSD';
            $coinInput = '[data-dialog-name="Symbol Search"] input';
            $coinOption = '[data-dialog-name="Symbol Search"] div[class^="listContainer-"]  div[class^="itemRow-"]:nth-of-type(2)';
            $cookieButton = '[data-role="toast-container"] div[class^="toast-wrapper-"] div[class^="actions-"] button';

            // pinescript
            $openScriptMenu = '.layout__area--bottom #bottom-area .bottom-widgetbar-content.scripteditor.tv-script-widget div[class^="rightControlsBlock-"] div[data-name="open-script"]';
            $openMyScript = '#overlap-manager-root div[class^="menuBox-"] div[class^="item-"]:first-of-type';
            $strategySearchInput = '#overlap-manager-root div[class^="container-"]:nth-of-type(2) div[class^="inputContainer-"] input';
            $strategySearchText = 'Strategy_1';
            $strategySelect = '#overlap-manager-root div[class^="wrapper-"] div[class^="container-"] div[class^="list-"] div[class^="itemRow-"]';
            $closeStrategySearch = 'div[data-outside-boundary-for="open-user-script-dialog"] div[class^="wrapper-"] div[class^="container-"]:first-of-type span[class^="close-"]';
            $addToChart = '.layout__area--bottom #bottom-area .bottom-widgetbar-content.scripteditor.tv-script-widget #tv-script-pine-editor-header-root div[class^="content-"] div[class^="rightControlsBlock-"] div[data-name="add-script-to-chart"]';

            // data points
            





            $browser
                ->visit( 'https://www.tradingview.com/' )

                ->pause( 1500 )

                // sign in
                ->click( $userArea )
                ->pause( 1000 )
                ->press( $signInLink )
                ->pause( 1000 )
                ->press( $emailLink )
                ->press( $focusUser )
                ->type( $focusUser, $username )
                ->press( $focusPassword )
                ->type( $focusPassword, $password )
                ->press( $signInButton )
                ->pause( 1500 )
                ->press( $chartLink )

                // choose exchange
                ->pause( 2500 )
                ->press( $coinList )
                ->press( $exchangeButton )
                ->pause( 1000 )
                ->type( $exchangeInput, $exchange )
                ->press( $exchangeName )
                ->pause( 1000 )

                // choose coin
                ->clear( $coinInput )
                ->type( $coinInput, $coin )
                ->pause( 1000 )
                ->press( $coinOption )

                ->press( $cookieButton )

                // open strategy
                ->pause( 1500 )
                ->press( $openScriptMenu )
                ->press( $openMyScript )
                ->pause( 1000 )
                ->type( $strategySearchInput, $strategySearchText )
                ->press( $strategySelect )
                ->press( $closeStrategySearch )
                ->pause( 1000 )
                ->press( $addToChart )

                // 

                








                


                ->pause(25000);


                

                //->assertVisible('.index-page')

        });
    }
}
