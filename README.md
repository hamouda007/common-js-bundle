# BW Javascript SDK Bundle
**This bundle is currently under development but there will be a release shortly, firstly with just the Google Analytics SDK**

[![Build Status](https://travis-ci.org/silverbackis/js-sdk-bundle.svg?branch=master)](https://travis-ci.org/silverbackis/js-sdk-bundle)
[![codecov](https://codecov.io/gh/silverbackis/js-sdk-bundle/branch/master/graph/badge.svg)](https://codecov.io/gh/silverbackis/js-sdk-bundle)
[![License](https://poser.pugx.org/silverbackis/js-sdk-bundle/license)](https://packagist.org/packages/silverbackis/js-sdk-bundle)

This bundle provides twig functions to easily add common Javascript SDK tags to any page.

It has been structured to be easily expanded for whatever SDKs you may want. Out of the box this bundle will support Google Analytics, Woopra, Facebook, Facebook Pixel and Twitter.

This bundle is only configured and tested to be used for Symfony >=3.4 using Symfony Flex (or at at a minimum the new Flex file structure)

## Installation
This bundle will be submitted to the Symfony Flex contrib repository shortly. Until then you'll have to add the bundle into your bundles.php file manually.
```bash
composer req silverbackis/js-sdk-bundle@dev
```

```php
// config/bundles.php
return [
    JsSdkBundle\JsSdkBundle::class => ['all' => true],
];
```

## Getting Started
### Twig
Javascript blocks can be configured directly from your twig templates using the following functions
```twig
{{ js_sdk_add_block(sdk_name, sdk_block_name, at_sdk_block_name, before_at_sdk_block_name, override_params) }}
{{ js_sdk_output(sdk_name, override_params) }}
```
`at_sdk_block_name` can be `"false"` (note this is a string) which will result in the function returning the javascript for you to insert. You may which to track a click event for example when a user clicks a link instead of in the main tracking code.

You can duplicate an SDK block in its current state at any point in the Twig template
```twig
{{ js_sdk_duplicate(sdk_name, new_sdk_name, override_params) }}
```

You can also remove a block (if you've duplicated a block but want to remove a specific section for example)
```twig
{{ js_sdk_remove_block(sdk_name, sdk_block_name) }}
```

To get/create a new model (models are explained a little later) you can use:
```twig
{{ js_sdk_model(sdk_name, model, arguments) }}
```

### Configuration
Each parameter for an SDK can be configured in your *js_sdk.yaml* file. This is an example for Google Analytics. Not all parameters are required. There is an optional `enabled` parameter not shown below.
```yaml
# config/packages/js_sdk.yaml
js_sdk:
    google_analytics:
        id: UA-12452352
```

If an SDK has been enabled in one configuration, you can disable in another environment's config file by setting the SDK name to false:
```yaml
js_sdk:
    google_analytics: false
```

### Models
There are models available for some SDK blocks (e.g. Google Analytics Event). You can use these to easily construct and pass data to a block. All models allow you to define all the variables in the constructor (in the order they are documented here) and also have getters and setters.

## Google Analytics Example
The first SDK implemented is for Google Analytics. Here is an example of how you may end up using the functions.

This will state that when you output the google_analytics sdk, you want to include the page_view block:
```twig
{{ js_sdk_add_block('google_analytics', 'page_view') }}
```

This will state that you also want the extended ecommerce initialised, but you want this BEFORE the 'page_view' block - you could just define this first, but in some situations that may not be as easy. If the final parameter is false or ommitted, the ec/init block would be inserted after the page_view block:
```twig
{{ js_sdk_add_block('google_analytics', 'ec/init', 'page_view', true) }}
```

This will output the sdk block javascript with all the options above - this should always be executed last in your twig template. You may wish to include an empty block in your base twig template that you can insert this into from child pages when ready, or that you can override. E.g. the base twig template could always output a page_view but on pages where there are product impressions you could override this to also include additional tracking code. With analytics it is beneficial to add ec tracking code before the initial page view otherwise you'll need to send an additional event to track data:
```twig
{{ js_sdk_output('google_analytics') }}
```

This library is designed to be as flexible as possible. At any point you are able to duplicate an SDK block with a new name and new parameters. If you want to duplicate the entire tracking code for another account you could add this once you've populated all your blocks:
```twig
{{ js_sdk_duplicate('google_analytics', 'analytics_two', {tracking_function: 'ga_extra', id: 'UA-98765432'}) }}
{{ js_sdk_output('analytics_two') }}
```

## SDK Names, Blocks and Configuration Parameters
Some parameters are common across all SDKs. You cannot pass the `default_blocks` variable in via the twig template, but you can still remove and modify the default blocks from the template using `js_sdk_add_block()` and `js_sdk_remove_block()` functions

| Parameter | Default | Details |
| --- | --- | --- |
| enabled | false | Enable the SDK |
| default_blocks | false | Can be an array of blocks you want. You can also include parameters if you want. Cannot be defined from a twig template. This config parameter will pre-populate blocks in the order provided so you can just write `{{ js_sdk_output('sdk_name') }}` in your twig template |

```yaml
js_sdk:
    sdk_name:
        default_blocks:
            block_name: ~
            "another/block_name":
                param1: value1
                param2: value2
```

### JS SDK Docs
[Google Analytics](Docs/GoogleAnalytics.md)

### Other JS SDKs
I have not implemented the other planned Javascript SDKs at the moment. Feel free to submit a PR if you're able to help or have another SDK suggestion (or indeed you have any more features or improvements you'd like to see in what is already implemented)

### Contributing an SDK
Adding an SDK is pretty straight forwards. A new Provider is required in `JsSdkBundle\Provider\Sdk` extending `JsSdkBundle\Provider\BaseProvider`. In the dependency injection new configuration parameters may be required and models can be added in the `JsSdkBundle\Model\PascalCaseSdkName` namespace where PascalCaseSdkName is the name of the SDK in Pascal Case. Template blocks are added in `Resources/views/blocks/sdk_snake_case_name` with an `init.html.twig` file and then a sub directory `js` for all blocks needed.
