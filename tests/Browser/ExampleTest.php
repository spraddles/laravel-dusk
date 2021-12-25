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
            $website = 'https://www.tradingview.com/';
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

            // clear strategy
            $arrowOption = '#drawing-toolbar div[class^="content-"] div[class^="inner-"] div[class^="group-"]:nth-of-type(4) [data-name="removeAllDrawingTools"] div[class^="arrow-"]';
            $removeAll = '#overlap-manager-root div[class^="menuBox-"] [data-name="remove-all"]';

            // pinescript
            $pineScriptTab = '#footer-chart-panel div[class^="tabs-"] div[class^="tab-"]:nth-of-type(3)';
            $openScriptMenu = '#bottom-area .bottom-widgetbar-content.scripteditor.tv-script-widget div[class^="rightControlsBlock-"] div[data-name="open-script"]';
            $openMyScript = '#overlap-manager-root div[class^="menuBox-"] div[class^="item-"]:first-of-type';
            $strategySearchInput = '#overlap-manager-root div[class^="container-"]:nth-of-type(2) div[class^="inputContainer-"] input';
            $strategySearchText = 'Strategy_1';
            $strategySelect = '#overlap-manager-root div[class^="wrapper-"] div[class^="container-"] div[class^="list-"] div[class^="itemRow-"]';
            $closeStrategySearch = 'div[data-outside-boundary-for="open-user-script-dialog"] div[class^="wrapper-"] div[class^="container-"]:first-of-type span[class^="close-"]';
            $addToChart = '#bottom-area .bottom-widgetbar-content.scripteditor.tv-script-widget #tv-script-pine-editor-header-root div[class^="content-"] div[class^="rightControlsBlock-"] div[data-name="add-script-to-chart"]';

            // date range chart setting
            $chartSettings = '#bottom-area .bottom-widgetbar-content.backtesting .group:nth-of-type(2) .js-backtesting-open-format-dialog';
            $inputsTab = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="scrollWrap-"] div[class^="tabs-"] [data-value="inputs"]';
            $selectArrow = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="scrollable-"] div[class^="content-"] div[class^="cell-"]:last-of-type span[class^="container-"] span[class^="inner-slot-"]:nth-of-type(2)';
            $dateRange_1 = 'div[id$="_item_All-2021"]';
            $okButton = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="footer-"] div[class^="buttons-"] span[class^="submitButton-"] button';

            // time interval
            $intervalMenu = '#header-toolbar-intervals div[class^="menu-"]';
            $interval = '#overlap-manager-root [data-value="1D"]'; // 1M,1W,1D,240,180,120,60,45,30,15,5

            // data points
            $netProfit = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(1) > td:nth-child(2) > div:nth-child(2) > span';
            //B+H
            //Difference
            //Total Trades closed
            //Trades p/day[calculated]
            //Trades open
            //Winning trades
            //Losing trades
            //Percent profitable
            //Win loss ratio

            // CSV file
            $output = array(
                $csvHeaders
            );
            $csvHeaders = array('Coin,Exchange,Date range,Net profit,B+H,Difference,Total Trades closed,Trades p/day[calculated],Trades open,Winning trades,Losing trades,Percent profitable,Win loss ratio');




            $browser

                // sign in
                ->visit( $website )
                ->waitFor( $userArea )
                ->click( $userArea )
                ->waitFor( $signInLink )
                ->press( $signInLink )
                ->waitFor( $emailLink )
                ->press( $emailLink )
                ->press( $focusUser )
                ->type( $focusUser, $username )
                ->press( $focusPassword )
                ->type( $focusPassword, $password )
                ->press( $signInButton )
                ->pause(1000)
                ->waitFor( $chartLink )
                ->assertVisible( $chartLink )
                ->press( $chartLink )

                // choose exchange
                ->waitFor( $coinList )
                ->press( $coinList )
                ->press( $exchangeButton )
                ->type( $exchangeInput, $exchange )
                ->press( $exchangeName )

                // choose coin
                ->clear( $coinInput )
                ->type( $coinInput, $coin )
                ->waitFor( $coinOption )
                ->press( $coinOption )
                ->press( $cookieButton )

                // clear strategy
                ->press( $arrowOption )
                ->press( $removeAll )             

                // open strategy
                ->press( $pineScriptTab )
                ->waitFor( $openScriptMenu )
                ->assertVisible( $openScriptMenu )
                ->press( $openScriptMenu )
                ->press( $openMyScript )
                ->waitFor( $strategySearchInput )
                ->type( $strategySearchInput, $strategySearchText )
                ->press( $strategySelect )
                ->press( $closeStrategySearch )
                ->waitFor( $addToChart )
                ->press( $addToChart )

                // change date range
                ->waitFor( $chartSettings )
                ->press( $chartSettings )
                ->waitFor( $inputsTab )
                ->press( $inputsTab )
                ->waitFor( $selectArrow )
                ->press( $selectArrow )
                ->waitFor( $dateRange_1 )
                ->press( $dateRange_1 )
                ->pause(1000)
                ->waitFor( $okButton )
                ->press( $okButton )

                // change time interval
                ->waitFor( $intervalMenu )
                ->press( $intervalMenu )
                ->waitFor( $interval )
                ->press( $interval )

                ->pause(1000)

                // data points
                ->waitFor( $netProfit );
                $data = strstr($browser->text( $netProfit ), ' %', true );
                echo $data;

                // dump into CSV


        });
    }
}
