# Spotify Web API PHP Wrapper

An easy to use class for placing GET requests to the Spotify Web API.

To get started, instantiate the class with your credentials:
```php
$spotify = new Spotify(CLIENT_ID, CLIENT_SECRET);
```

Then call any GET endpoint from the Spotify API as a function:
```php
$artist_info = $spotify->artists('2buda3WQO8N9DEkmNItRWC');
```
