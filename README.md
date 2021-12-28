## Prerequisites:
- php 7.3 or greater
- composer
- NodeJS, NPM
- chrome-driver
- a paid (non-trial) TradingView account with Pro subscription level


## Config:
- set TV_USERNAME in .ENV file (this is your TradingView username)
- set TV_PASSWORD in .ENV file (this is your TradingView password)
- add DUSK_HEADLESS_DISABLED=true if you want a headless browser


## How to run:
- php artisan serve
- php artisan dusk:chrome-driver 96 (number must match your current Google Chrome desktop version)
- php artisan dusk tests/Browser/ExampleTest.php