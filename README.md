## Prerequisites:
- php 7.3 or greater
- composer
- NodeJS, NPM
- a paid (non-trial) TradingView account with Pro subscription level

## Config:
- set TV_USERNAME in .ENV file (this is your TradingView username, e.g. TV_USERNAME=john.smith@gmail.com)
- set TV_PASSWORD in .ENV file (this is your TradingView password, e.g. TV_PASSWORD=mypassword)
- add DUSK_HEADLESS_DISABLED=true in .ENV file if you want a headless browser (runs in background as opposed to launching a browser)
- change the $coins, $dateRanges, and $intervals variables in tests/Browser/ExampleTest.php

## How to run:
- php artisan serve
- php artisan dusk:chrome-driver 96 (number must match your current Google Chrome desktop version)
- php artisan dusk tests/Browser/ExampleTest.php

## Output:
- less combinations of coins, dataranges, and intervals will run faster... and vice versa
- a new CSV file (Strategy_XXX.csv) will be created in the root directory
- this file will be overwritten each time the test is run