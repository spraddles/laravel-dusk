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
            'Strategy_1',
            'Strategy_2',
            'Strategy_3',
            'Strategy_4',
            'Strategy_5',
            'Strategy_6'
        ];

        $exchanges = [
            'binance'
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
            $exchange = 'Binance';
            $exchangeInput = '[data-outside-boundary-for="exchanges-search"] input';
            $exchangeName = '[data-outside-boundary-for="exchanges-search"] [data-name="exchanges-search"] div[class^="exchangeItemsContainer-"] div[class^="wrap-"]:first-of-type';
            $coinPair = 'XRPUSD';
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
            $strategyName = 'Strategy_1';
            $strategySelect = '#overlap-manager-root div[class^="wrapper-"] div[class^="container-"] div[class^="list-"] div[class^="itemRow-"]';
            $closeStrategySearch = 'div[data-outside-boundary-for="open-user-script-dialog"] div[class^="wrapper-"] div[class^="container-"]:first-of-type span[class^="close-"]';
            $addToChart = '#bottom-area .bottom-widgetbar-content.scripteditor.tv-script-widget #tv-script-pine-editor-header-root div[class^="content-"] div[class^="rightControlsBlock-"] div[data-name="add-script-to-chart"]';

            // date range chart setting
            $dateRange_1 = ['div[id$="_item_All-2021"]', 'All 2021'];
            $dateRange_2 = ['div[id$="_item_32-weeks"]', '32 weeks'];
            $dateRange_3 = ['div[id$="_item_16-weeks"]', '16 weeks'];
            $dateRange_4 = ['div[id$="_item_8-weeks"]', '8 weeks'];
            $dateRange_5 = ['div[id$="_item_3-weeks"]', '3 weeks'];
            $chartSettings = '#bottom-area .bottom-widgetbar-content.backtesting .group:nth-of-type(2) .js-backtesting-open-format-dialog';
            $inputsTab = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="scrollWrap-"] div[class^="tabs-"] [data-value="inputs"]';
            $selectArrow = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="scrollable-"] div[class^="content-"] div[class^="cell-"]:last-of-type span[class^="container-"] span[class^="inner-slot-"]:nth-of-type(2)';
            $dateRange = $dateRange_2;
            $okButton = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="footer-"] div[class^="buttons-"] span[class^="submitButton-"] button';

            // time intervals
            $interval_1M = ['#overlap-manager-root [data-value="1M"]', '1 Month'];
            $interval_1W = ['#overlap-manager-root [data-value="1W"]', '1 Week'];
            $interval_1D = ['#overlap-manager-root [data-value="1D"]', '1 Day'];
            $interval_4hrs = ['#overlap-manager-root [data-value="240"]', '4 hrs'];
            $interval_3hrs = ['#overlap-manager-root [data-value="180"]', '3 hrs'];
            $interval_2hrs = ['#overlap-manager-root [data-value="120"]', '2 hrs'];
            $interval_1hr = ['#overlap-manager-root [data-value="60"]', '1 hr'];
            $interval_45mins = ['#overlap-manager-root [data-value="45"]', '45 mins'];
            $interval_30mins = ['#overlap-manager-root [data-value="30"]', '30 mins'];
            $interval_15mins = ['#overlap-manager-root [data-value="15"]', '15 mins'];
            $interval_5mins = ['#overlap-manager-root [data-value="5"]', '5 mins'];
            $intervalMenu = '#header-toolbar-intervals div[class^="menu-"]';
            $interval = $interval_15mins;

            // data points
            $netProfit = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(1) > td:nth-child(2) > div:nth-child(2) > span';
            $buyAndHold = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(5) > td:nth-child(2) > div:nth-child(2) > span';
            $difference = (int)$netProfit - (int)$buyAndHold;
            // $tradesPerDay = ''; [calculated value]
            $TotalTradesClosed = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(12) > td:nth-child(2)';
            $TotalTradesOpen = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(13) > td:nth-child(2)';
            $winningTrades = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(14) > td:nth-child(2)';
            $losingTrades = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(15) > td:nth-child(2)';
            $percentProfitable = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(16) > td:nth-child(2)';
            $winLossRatio = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(20) > td:nth-child(2)';

            // CSV file
            //$output = array( $csvHeaders, ... );
            $csvHeaders = array('Coin','Exchange','Date range','Interval','Net profit','B+H','Difference','Trades p/day[calculated]','Total Trades closed','Trades open','Winning trades','Losing trades','Percent profitable','Win loss ratio');

            // begin Dusk process
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
                ->type( $coinInput, $coinPair )
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
                ->type( $strategySearchInput, $strategyName )
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
                ->waitFor( $dateRange[0] )
                ->press( $dateRange[0] )
                ->pause(1000)
                ->waitFor( $okButton )
                ->press( $okButton )

                // change time interval
                ->waitFor( $intervalMenu )
                ->press( $intervalMenu )
                ->waitFor( $interval[0] )
                ->press( $interval[0] )

                ->pause(1000)

                // data points
                ->waitFor( $netProfit );
                $netProfitData = strstr($browser->text( $netProfit ), ' %', true );
                $buyAndHoldData = strstr($browser->text( $buyAndHold ), ' %', true );
                $TotalTradesClosedData = $browser->text( $TotalTradesClosed );
                $TotalTradesOpenData = $browser->text( $TotalTradesOpen );
                $winningTradesData = $browser->text( $winningTrades );
                $losingTradesData = $browser->text( $losingTrades );
                $percentProfitableData = strstr($browser->text( $percentProfitable ), ' %', true );
                $winLossRatioData = $browser->text( $winLossRatio );

                // CSV prepare
                $lines = [ 
                    $coinPair, 
                    $exchange, 
                    $dateRange[1], 
                    $interval[1], 
                    $netProfitData, 
                    $buyAndHoldData, 
                    $difference, 
                    '[blank]', 
                    $TotalTradesClosedData, 
                    $TotalTradesOpenData, 
                    $winningTradesData, 
                    $losingTradesData, 
                    $percentProfitableData, 
                    $winLossRatioData 
                ];
                $CSVdata = [ // dump into CSV
                    $csvHeaders,
                    $lines
                ];
                $CSVfilename = $strategyName.'.csv';
                $file = fopen( $CSVfilename, 'w' ); // open csv file for writing
                if ($file === false) {
                    die('Error opening the file ' . $CSVfilename);
                }
                foreach ($CSVdata as $row) { // write each row at a time to a file
                    fputcsv($file, $row);
                }
                fclose($file); // close the file

        });
    }
}
