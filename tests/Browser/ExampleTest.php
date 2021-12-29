<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Log;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {

        $exchanges = [
            'binance'
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

            // coins
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

            // coins & exchanges
            $exchange = 'Binance';
            $coinList = '#header-toolbar-symbol-search';
            $exchangeButton = '[data-name="symbol-search-items-dialog"] .apply-common-tooltip';
            $exchangeInput = '[data-outside-boundary-for="exchanges-search"] input';
            $exchangeName = '[data-outside-boundary-for="exchanges-search"] [data-name="exchanges-search"] div[class^="exchangeItemsContainer-"] div[class^="wrap-"]:first-of-type';
            $coinInput = '#overlap-manager-root [data-dialog-name="Symbol Search"] div[class^="container-"] input ';
            $coinOption = '[data-dialog-name="Symbol Search"] div[class^="listContainer-"] div[class^="itemRow-"]:nth-of-type(2)';
            $cookieButton = '[data-role="toast-container"] div[class^="toast-wrapper-"] div[class^="actions-"] button';

            // clear chart
            $arrowOption = '#drawing-toolbar div[class^="inner-"] div[class^="group-"]:nth-of-type(4) div[class^="dropdown-"] div[class^="arrow-"]';
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

            // date ranges: the 3rd item in array is days in that period (used for trades p/day calculation)
            $dateRanges = [
                /*['div[id$="_item_All-2021"]', 'All 2021', 298],
                ['div[id$="_item_32-weeks"]', '32 weeks', 224],
                ['div[id$="_item_16-weeks"]', '16 weeks', 112],
                ['div[id$="_item_8-weeks"]', '8 weeks', 56],
                ['div[id$="_item_3-weeks"]', '3 weeks', 21]*/
                ['div[id$="_item_Bad_period_BTC"]', 'Bad period BTC', 99]
            ];

            // chart setting
            $chartSettings = '#bottom-area .bottom-widgetbar-content.backtesting .group:nth-of-type(2) .js-backtesting-open-format-dialog';
            $inputsTab = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="scrollWrap-"] div[class^="tabs-"] [data-value="inputs"]';
            $selectArrow = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="scrollable-"] div[class^="content-"] div[class^="cell-"]:last-of-type span[class^="container-"] span[class^="inner-slot-"]:nth-of-type(2)';
            $okButton = '#overlap-manager-root div[data-outside-boundary-for="indicator-properties-dialog"] div[class^="footer-"] div[class^="buttons-"] span[class^="submitButton-"] button';

            // time intervals
            $intervals = [
                ['#overlap-manager-root [data-value="1M"]', '1 Month'],
                ['#overlap-manager-root [data-value="1W"]', '1 Week'],
                ['#overlap-manager-root [data-value="1D"]', '1 Day'],
                ['#overlap-manager-root [data-value="240"]', '4 hrs'],
                ['#overlap-manager-root [data-value="180"]', '3 hrs'],
                ['#overlap-manager-root [data-value="120"]', '2 hrs'],
                ['#overlap-manager-root [data-value="60"]', '1 hr'],
                ['#overlap-manager-root [data-value="45"]', '45 mins'],
                ['#overlap-manager-root [data-value="30"]', '30 mins'],
                ['#overlap-manager-root [data-value="15"]', '15 mins'],
                ['#overlap-manager-root [data-value="5"]', '5 mins']
            ];
            $intervalMenu = '#header-toolbar-intervals div[class^="menu-"]';

            // data points
            $netProfit = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(1) > td:nth-child(2) > div:nth-child(2) > span';
            $buyAndHold = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(5) > td:nth-child(2) > div:nth-child(2) > span';
            $TotalTradesClosed = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(12) > td:nth-child(2)';
            $TotalTradesOpen = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(13) > td:nth-child(2)';
            $winningTrades = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(14) > td:nth-child(2)';
            $losingTrades = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(15) > td:nth-child(2)';
            $percentProfitable = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(16) > td:nth-child(2)';
            $winLossRatio = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(20) > td:nth-child(2)';
            $sharpeRatio = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(6) > td:nth-child(2)';
            $sortinoRatio = '#bottom-area > div.bottom-widgetbar-content.backtesting > div.backtesting-content-wrapper > div > div > div > table > tbody > tr:nth-child(7) > td:nth-child(2)';

            // CSV file
            $csvHeaders = array('Coin','Exchange','Date range','Interval','Net profit','B+H','Difference','Trades p/day','Total Trades closed','Trades open','Winning trades','Losing trades','Percent profitable','Win loss ratio','Sharpe Ratio','Sortino Ratio');

            // begin Dusk process
            $testPause = 1500; // use to slow Dusk down for diagnosing issues
            $browser
            
                // sign in
                ->visit( $website )
                ->waitFor( $userArea )
                ->assertPresent( $userArea )
                ->assertVisible( $userArea )
                ->click( $userArea )
                ->waitFor( $signInLink )
                ->assertPresent( $signInLink )
                ->assertVisible( $signInLink )
                ->press( $signInLink )
                ->pause($testPause)
                ->waitFor( $emailLink )
                ->assertPresent( $emailLink )
                ->assertVisible( $emailLink )
                ->press( $emailLink )
                ->pause($testPause)
                ->waitFor( $focusUser )
                ->assertPresent( $focusUser )
                ->assertVisible( $focusUser )
                ->press( $focusUser )
                ->pause($testPause)
                ->type( $focusUser, $username )
                ->waitFor( $focusPassword )
                ->assertPresent( $focusPassword )
                ->assertVisible( $focusPassword )
                ->press( $focusPassword )
                ->pause($testPause)
                ->type( $focusPassword, $password )
                ->waitFor( $signInButton )
                ->assertPresent( $signInButton )
                ->assertVisible( $signInButton )
                ->press( $signInButton )
                ->pause($testPause)
                ->pause(1000)
                ->waitFor( $chartLink )
                ->assertPresent( $chartLink )
                ->assertVisible( $chartLink )
                ->press( $chartLink )
                ->pause($testPause)
                ->pause(2000)
                ->assertPresent( $cookieButton )
                ->assertVisible( $cookieButton )
                ->press( $cookieButton )
                ->pause($testPause)

                // clear chart
                ->pause(1500)
                ->press( $arrowOption )
                ->pause($testPause)
                ->waitFor( $removeAll )
                ->assertPresent( $removeAll )
                ->assertVisible( $removeAll )
                ->press( $removeAll )
                ->pause($testPause)
                ->pause(1500)

                // add strategy
                ->waitFor( $pineScriptTab )
                ->assertPresent( $pineScriptTab )
                ->assertVisible( $pineScriptTab )
                ->press( $pineScriptTab )
                ->pause($testPause)
                ->waitFor( $openScriptMenu )
                ->assertPresent( $openScriptMenu )
                ->assertVisible( $openScriptMenu )
                ->press( $openScriptMenu )
                ->pause($testPause)
                ->waitFor( $openMyScript )
                ->assertPresent( $openMyScript )
                ->assertVisible( $openMyScript )
                ->press( $openMyScript )
                ->pause($testPause)
                ->waitFor( $strategySearchInput )
                ->assertPresent( $strategySearchInput )
                ->assertVisible( $strategySearchInput )
                ->type( $strategySearchInput, $strategyName )
                ->waitFor( $strategySelect )
                ->assertPresent( $strategySelect )
                ->assertVisible( $strategySelect )
                ->press( $strategySelect )
                ->pause($testPause)
                ->waitFor( $closeStrategySearch )
                ->assertPresent( $closeStrategySearch )
                ->assertVisible( $closeStrategySearch )
                ->press( $closeStrategySearch )
                ->pause($testPause)
                ->waitFor( $addToChart )
                ->assertPresent( $addToChart )
                ->assertVisible( $addToChart )
                ->press( $addToChart )
                ->pause($testPause);

                // prepare CSV file
                $CSVfilename = $strategyName.'.csv';
                $file = fopen( $CSVfilename, 'w' );
                if ($file === false) {
                    die('Error opening the file ' . $CSVfilename);
                };
                fputcsv( $file, $csvHeaders );

                // loop through coins
                foreach ($coins as $coin) { $browser

                    // choose exchange
                    ->waitFor( $coinList )
                    ->assertPresent( $coinList )
                    ->assertVisible( $coinList )
                    ->press( $coinList )
                    ->pause($testPause)
                    ->waitFor( $exchangeButton )
                    ->assertPresent( $exchangeButton )
                    ->assertVisible( $exchangeButton )
                    ->press( $exchangeButton )
                    ->pause($testPause)
                    ->waitFor( $exchangeInput )
                    ->assertPresent( $exchangeInput )
                    ->assertVisible( $exchangeInput )
                    ->type( $exchangeInput, $exchange )
                    ->waitFor( $exchangeName )
                    ->assertPresent( $exchangeName )
                    ->assertVisible( $exchangeName )
                    ->press( $exchangeName )
                    ->pause($testPause)
                
                    // choose coin
                    ->assertPresent( $coinInput )
                    ->assertVisible( $coinInput )
                    ->clear( $coinInput )
                    ->pause(1000)
                    ->type( $coinInput, $coin )
                    ->pause(1000)
                    ->waitFor( $coinOption )
                    ->assertPresent( $coinOption )
                    ->assertVisible( $coinOption )
                    ->press( $coinOption )
                    ->pause($testPause)
                    ->pause(1500);

                    // loop through date ranges
                    foreach ($dateRanges as $dateRange) { $browser

                        // change date range
                        ->waitFor( $chartSettings )
                        ->assertPresent( $chartSettings )
                        ->assertVisible( $chartSettings )
                        ->press( $chartSettings )
                        ->pause($testPause)
                        ->waitFor( $inputsTab )
                        ->assertPresent( $inputsTab )
                        ->assertVisible( $inputsTab )
                        ->press( $inputsTab )
                        ->pause($testPause)
                        ->waitFor( $selectArrow )
                        ->assertPresent( $selectArrow )
                        ->assertVisible( $selectArrow )
                        ->press( $selectArrow )
                        ->pause($testPause)
                        ->waitFor( $dateRange[0] )
                        ->assertPresent( $dateRange[0] )
                        ->assertVisible( $dateRange[0] )
                        ->press( $dateRange[0] )
                        ->pause($testPause)
                        ->pause(500)
                        ->waitFor( $okButton )
                        ->assertPresent( $okButton )
                        ->assertVisible( $okButton )
                        ->press( $okButton )
                        ->pause($testPause)
                        ->pause(500);

                        foreach ($intervals as $interval) { $browser

                            // change time interval
                            ->pause(750)
                            ->waitFor( $intervalMenu )
                            ->assertPresent( $intervalMenu )
                            ->assertVisible( $intervalMenu )
                            ->press( $intervalMenu )
                            ->pause($testPause)
                            ->waitFor( $interval[0] )
                            ->assertPresent( $interval[0] )
                            ->assertVisible( $interval[0] )
                            ->press( $interval[0] );
                            
                            // data points
                            $defaultPause = 2500;
                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $netProfit )
                                ->assertPresent( $netProfit )
                                ->assertVisible( $netProfit );
                            $netProfitData = strstr($browser->text( $netProfit ), ' %', true );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $buyAndHold )
                                ->assertPresent( $buyAndHold )
                                ->assertVisible( $buyAndHold );
                            $buyAndHoldData = strstr($browser->text( $buyAndHold ), ' %', true );

                            $difference = (int)$netProfitData - (int)$buyAndHoldData;

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $TotalTradesClosed )
                                ->assertPresent( $TotalTradesClosed )
                                ->assertVisible( $TotalTradesClosed );
                            $TotalTradesClosedData = $browser->text( $TotalTradesClosed );

                            if( ( ((int)$TotalTradesClosedData !== 0))  || ((int)$dateRange[2] !== 0) ) {
                                $tradesPerDay = number_format( (int)$TotalTradesClosedData / (int)$dateRange[2], 2 );
                            }
                            else $tradesPerDay = 0;

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $TotalTradesOpen )
                                ->assertPresent( $TotalTradesOpen )
                                ->assertVisible( $TotalTradesOpen );
                            $TotalTradesOpenData = $browser->text( $TotalTradesOpen );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $winningTrades )
                                ->assertPresent( $winningTrades )
                                ->assertVisible( $winningTrades );
                            $winningTradesData = $browser->text( $winningTrades );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $losingTrades )
                                ->assertPresent( $losingTrades )
                                ->assertVisible( $losingTrades );
                            $losingTradesData = $browser->text( $losingTrades );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $percentProfitable )
                                ->assertPresent( $percentProfitable )
                                ->assertVisible( $percentProfitable );
                            $percentProfitableData = strstr($browser->text( $percentProfitable ), ' %', true );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $winLossRatio )
                                ->assertPresent( $winLossRatio )
                                ->assertVisible( $winLossRatio );
                            $winLossRatioData = $browser->text( $winLossRatio );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $sharpeRatio )
                                ->assertPresent( $sharpeRatio )
                                ->assertVisible( $sharpeRatio );
                            $sharpeRatioData = $browser->text( $sharpeRatio );

                            $browser
                                ->pause($defaultPause)
                                ->waitFor( $sortinoRatio )
                                ->assertPresent( $sortinoRatio )
                                ->assertVisible( $sortinoRatio );
                            $sortinoRatioData = $browser->text( $sortinoRatio );

                            // CSV add data
                            $lines = [
                                $coin,
                                $exchange,
                                $dateRange[1],
                                $interval[1],
                                $netProfitData,
                                $buyAndHoldData,
                                $difference,
                                $tradesPerDay,
                                $TotalTradesClosedData,
                                $TotalTradesOpenData,
                                $winningTradesData,
                                $losingTradesData,
                                $percentProfitableData,
                                $winLossRatioData,
                                $sharpeRatioData,
                                $sortinoRatioData
                            ];
                            fputcsv( $file, $lines );
                        }
                    }
                }
            fclose($file);
        });
    }
}
