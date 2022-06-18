#### https://codeception.com/quickstart
```
composer require "codeception/codeception" --dev
composer require "codeception/module-phpbrowser" --dev
composer require "codeception/module-asserts" --dev
composer require "codeception/module-webdriver" --dev
composer require "codeception/module-rest" --dev
composer install -n
php vendor/bin/codecept bootstrap
```

#### snapshot.feature
```
php vendor/codeception/codeception/codecept run Acceptance ./tests/Acceptance/snapshot.feature --html --colors --steps --env firefox --debug
bash tests/Support/Data/command-to-fix.sh
```

#### ./tests/Acceptance
```
php vendor/codeception/codeception/codecept run Acceptance ./tests/Acceptance  --html --colors --steps --env firefox
```

#### ./tests/Functional
```
php vendor/codeception/codeception/codecept run Functional ./tests/Functional --html --colors --steps --env firefox
```

#### ./tests/Unit
```
php vendor/codeception/codeception/codecept run Unit --html --colors
```