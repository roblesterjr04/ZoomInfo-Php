# ZoomInfo Php SDK

## Installation

Install via composer

```bash
composer require rob-lester-jr04/zoom-info-php
```

## Usage

```php
use ZoomInfo\ZoomInfo;

$z = new ZoomInfo([
	'username' => '...',
	'password' => '...'
]);

$company = $z->search->company([
	'companyName' => 'ZoomInfo'
]);
```