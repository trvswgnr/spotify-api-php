# Spotify Web API PHP Wrapper

An easy to use class for placing GET requests to the Spotify Web API.

## Getting Started

To get started, make sure you have a developer app created through Spotify, and can locate your Client ID and Client Secret.

Copy Shopify.php to your project, and require it:
```php
require_once 'Shopify.php';
```

Instantiate the class with your credentials:
```php
$client_id     = 'f6755c1c08example22480522e5b04';
$client_secret = '7191a8c7exampleA5239b7102595d';
$spotify       = new Spotify($client_id, $client_secret);
```

Then call any GET endpoint from the Spotify API as a function:
```php
$artist_info = $spotify->artists('2buda3WQO8N9DEkmNItRWC');
```
