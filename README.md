## Prerequisites:
- php 7.3 or greater
- composer
- NodeJS, NPM
- a paid (non-trial) TradingView account with Pro subscription level

## Config:
- set TV_USERNAME in .ENV file (this is your TradingView username, e.g. TV_USERNAME=john.smith@gmail.com)
- set TV_PASSWORD in .ENV file (this is your TradingView password, e.g. TV_PASSWORD=mypassword)
- add DUSK_HEADLESS=true in .ENV file if you want a headless browser (runs in background as opposed to launching a browser)
- add your Pinescript strategy into TradingView & save it (the exact name is important, take note of this for the $strategyName variable)
- your Pinescript will need to include date range code, if you want them in your CSV
- modify your $strategyName, $exchange, $coins, $dateRanges, $intervals variables in tests/Browser/ExampleTest.php
- use the $testPause variable to diagnose for issues, key issue is Dusk runs too fast, sometimes you need to slow it down (e.g. $testPause=1500, meaning delay each action by 1.5 seconds)

## How to run:
- open a termnial session and type in the below commands:
- php artisan serve
- php artisan dusk:chrome-driver 96 (number must match your current Google Chrome desktop version)
- php artisan dusk tests/Browser/ExampleTest.php

## Output:
- less combinations of coins, dataranges, and intervals will run faster... and vice versa
- a new CSV file (Strategy_XXX.csv) will be created in the root directory
- this file will be overwritten each time the test is run