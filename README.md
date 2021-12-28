## Prerequisites:
- php 7.3 or greater
- composer
- NodeJS, NPM
- a paid (non-trial) TradingView account with Pro subscription level

## Config:
- set TV_USERNAME in .ENV file (this is your TradingView username)
- set TV_PASSWORD in .ENV file (this is your TradingView password)
- add DUSK_HEADLESS_DISABLED=true if you want a headless browser (runs in background as opposed to launching a browser)
- change the $coins, $dateRanges, and $intervals variables in tests/Browser/ExampleTest.php

## How to run:
- php artisan serve
- php artisan dusk:chrome-driver 96 (number must match your current Google Chrome desktop version)
- php artisan dusk tests/Browser/ExampleTest.php

## Output:
- the automation can take some time depending on the amount of coins, dataranges, and intervals you have set
- a new CSV file (Strategy_XXX.csv) will be created in the root directory
- this file will be overwritten each time the test is run