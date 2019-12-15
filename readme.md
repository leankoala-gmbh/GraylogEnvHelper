#Graylog Env Helper

Creates a GelfMessage with predefined values coming from ENV variables.

## Usage
```php
$gelfMessage = \Leankoala\GraylogEnvHelper\Helper::createMessage('Smoke', $message);
```