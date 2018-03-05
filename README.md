# Laravel5.5-googleAPI-twitterAPI
Simple Educational Project7

## Use API Twitter
https://packagist.org/packages/thujohn/twitter

```composer require thujohn/twitter```

Now open up /config/app.php and add the service provider to your providers array.
```
'providers' => [
	Thujohn\Twitter\TwitterServiceProvider::class,
]
```
Now add the alias.
```
'aliases' => [
	'Twitter' => Thujohn\Twitter\Facades\Twitter::class,
]
```

Run 
```
php artisan vendor:publish --provider="Thujohn\Twitter\TwitterServiceProvider" 
```
/config/ttwitter.php

## config
 .env file:
````
TWITTER_CONSUMER_KEY=
TWITTER_CONSUMER_SECRET=
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_TOKEN_SECRET=
````