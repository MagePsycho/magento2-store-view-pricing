<div align="center">

![Magento 2 Store View Pricing](https://i.imgur.com/d8QEHRb.png)
# Magento 2 Store View Pricing

</div>

<div align="center">

[![Packagist Version](https://img.shields.io/github/v/tag/MagePsycho/magento2-store-view-pricing?logo=packagist&sort=semver&label=packagist&style=for-the-badge)](https://packagist.org/packages/magepsycho/magento2-storepricing)
[![Packagist Downloads](https://img.shields.io/packagist/dt/magepsycho/magento2-storepricing.svg?logo=packagist&style=for-the-badge)](https://packagist.org/packages/magepsycho/magento2-storepricing/stats)
![Supported Magento Versions](https://img.shields.io/badge/magento-%202.3_|_2.4-brightgreen.svg?logo=magento&longCache=true&style=for-the-badge)
![License](https://img.shields.io/badge/license-MIT-green?color=%23234&style=for-the-badge)

</div>

## Overview
[Magento 2 Store View Pricing](https://www.magepsycho.com/magento2-store-view-pricing.html) extension helps store owners to set up different product prices (cost, regular, special prices, etc.) per store view.

By default, product prices can be configured to apply at either the global or website level.  
If applied to the global level, the same price is used throughout the store hierarchy. If applied to the website level, the same product can be available at different prices from stores that are associated with different websites.  

With this extension, product prices can also be configured at the store view level. This means the same product can have different prices per store view.

## Key Features
* Can setup product prices (`cost`, `regular`, `special prices`, etc.) at the store view level
* Compatible with [Magento 2 Regular, Special & Tier Price Importer](https://www.magepsycho.com/magento2-mass-regular-special-tier-group-price-importer.html) extension

## Feature Highlights

### Set Prices at Store View Level
With this extension, the store admin can set different prices for the product as per store view.

All these price types can have multiple values  
* Regular Price
* Special Price (along with the from/to dates)
* Cost
* Tier Price / Group Price *(will be supported soon)*
* etc.


![Magento 2 Store View Pricing - Admin Product Edit](https://www.magepsycho.com/media/catalog/product/9/0/90-1-m2-store-view-pricing-storefront-specific-store-prices.png)

![Magento 2 Store View Pricing - Storefront Product Page](https://www.magepsycho.com/media/catalog/product/9/0/90-m2-store-view-pricing-storefront-specific-store-prices.png)

*By default, the scope of product pricing is global.*

## 🛠️ Installation

### 1 Using Composer (Preferred)
```
composer require magepsycho/magento2-storepricing
```

### 2 Using Modman
```
modman init
modman clone git@github.com:MagePsycho/magento2-store-view-pricing.git
```

### 3 Using Zip File
* Download the [Extension Zip File](https://github.com/MagePsycho/magento2-store-view-pricing/archive/master.zip)
* Extract & upload the files to `/path/to/magento2/app/code/MagePsycho/StorePricing/`

After installation by either means, activate the extension with following steps

1. Enable the module
```
php bin/magento module:enable MagePsycho_StorePricing --clear-static-content
php bin/magento setup:upgrade
```
2. Flush the store cache
```
php bin/magento cache:flush
```
3. Deploy static content - *in Production mode only*
```
rm -rf pub/static/* var/view_preprocessed/*
php bin/magento setup:static-content:deploy
```
4. Go to Admin > CATALOG > Store View Pricing > Manage Settings

## Live Demo:

* [Frontend Demo](http://m2default.mage-expo.com/)
* [Backend Demo](http://m2default.mage-expo.com/admin_m2demo/?module=storepricing)

## Changelog

**Version 1.0.1 (2022-03-21)**

* Fix of error in 2.4.3-p1: The "componentType" configuration parameter is required for the "container_msrp" component.

**Version 1.0.0 (2022-01-19)**

* Initial Release.

## Authors
- Raj KB [![Twitter Follow](https://img.shields.io/twitter/follow/rajkbnp.svg?style=social)](https://twitter.com/rajkbnp)

## Contributors

![Contributors](https://contrib.rocks/image?repo=magepsycho/magento2-store-view-pricing)

## To Contribute
Any contribution to the development of `Magento 2 Store View Pricing` is highly welcome.  
The best possibility to provide any code is to open a [pull request on GitHub](https://github.com/MagePsycho/magento2-store-view-pricing/pulls).

## Need Support?
If you encounter any problems or bugs, please create an issue on [GitHub](https://github.com/MagePsycho/magento2-store-view-pricing/issues).

Please [visit our store](https://www.magepsycho.com/extensions/magento-2.html) for more FREE / paid extensions OR [contact us](https://magepsycho.com/contact) for customization / development services.
