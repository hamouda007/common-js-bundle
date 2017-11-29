# Common JS Bundle
***Not affiliated with The CommonJS group***

[![Build Status](https://travis-ci.org/silverbackis/common-js-bundle.svg?branch=master)](https://travis-ci.org/silverbackis/common-js-bundle)
[![codecov](https://codecov.io/gh/silverbackis/common-js-bundle/branch/master/graph/badge.svg)](https://codecov.io/gh/silverbackis/common-js-bundle)
[![Latest Stable Version](https://poser.pugx.org/silverbackis/common-js-bundle/v/stable)](https://packagist.org/packages/silverbackis/common-js-bundle)
[![Latest Unstable Version](https://poser.pugx.org/silverbackis/common-js-bundle/v/unstable)](https://packagist.org/packages/silverbackis/common-js-bundle)
[![License](https://poser.pugx.org/silverbackis/common-js-bundle/license)](https://packagist.org/packages/silverbackis/common-js-bundle)

This bundle provides twig functions to easily add commonly used Javascript tags & SDKs to any page.

By default this bundle will support
- Google Analytics
- Google Tag Manager (GTM)
- Facebook Javascript SDK
- Twitter for Websites

## Requirements
This bundle is only configured and tested to be used for Symfony >=3.4

All default configurations and examples assume you are using Symfony Flex.

## Installation
This bundle will be submitted to the Symfony Flex contrib repository shortly with some example configs. If you're using flex, the bundle will automatically be added into yor bundles.php file though.
```bash
composer req silverbackis/common-js-bundle@alpha
```

## Getting Started
Javascript blocks can be configured directly from your twig templates using the following functions
```twig
{{ cjs_add_block(name, block_name, at_block_name, before_at_block_name, override_params_object) }}
```
>`at_sdk_block_name` can be `"false"` (note this is a string) which will result in the function returning the javascript for you to insert. You may which to track a click event for example when a user clicks a link instead of in the main tracking code.

You can duplicate an SDK block including any blocks that have already been configured
```twig
{{ cjs_duplicate(name, block_name, override_params_object) }}
```

You can also remove a block (e.g. if you've duplicated a block but want to remove a specific section )
```twig
{{ cjs_remove_block(name, block_name) }}
```

To generate a new model to be inserted as a parameter you can use `cjs_model` - this example shows how you can create your model with arguments to define variables and/or using setters and then how you would inject the model as a parameter into a block.
```twig
{% set my_model = cjs_model(name, model, args_array) %}
{{ my_model.setArg3('arg3') }}
{{ cjs_add_block(name, block_name, null, false, { param_name: my_model }) }}
```

Finally to output the scripts **after** all the blocks have been configured for a given block use the `cjs_js` function
```twig
{{ cjs_js(name, override_params_object) }}
```

If there is an noscript fallback specified, you will want to output this at a different section in your template. This is implemented when using GTM for example. Yuu can output the fallback HTML using `cjs_html`
```twig
{{ cjs_noscript(name, override_params_object) }}
```

### Configuration
Each parameter for an SDK can be configured in your *common_js.yaml* file. This is an example for Google Analytics. Not all parameters are required. There is an optional `enabled` parameter not shown below.
```yaml
# config/packages/common_js.yaml
common_js:
    google_analytics:
        id: '%env(GOOGLE_ANALYTICS_ID)%'
```

If an SDK has been enabled in one configuration, you can disable in another environment config file by setting the SDK name to false:
```yaml
# config/packages/dev/common_js.yaml
common_js:
    google_analytics: false
```

Using Symfony Flex, you will have new environment variables to configure for whichever blocks you'd like to use in your `.env` file.

### Models
There are models available for some SDK blocks (e.g. Google Analytics Event). You can use these to easily construct and pass data to a block. All models allow you to define all the variables in the constructor (in the order they are documented here) and also have getters and setters.

## SDK Names, Blocks and Configuration Parameters
Some parameters are common across all SDKs. You cannot pass the `default_blocks` variable in via the twig template, but you can still remove and modify the default blocks from the template using `cjs_add_block()` and `cjs_remove_block()` functions

| Parameter | Default | Details |
| --- | --- | --- |
| enabled | false | Enable the SDK |
| default_blocks | false | Can be an array of blocks you want. You can also include parameters if you want. Cannot be defined from a twig template. This config parameter will pre-populate blocks in the order provided so you can just write `{{ cjs_js('sdk_name') }}` in your twig template |

```yaml
common_js:
    sdk_name:
        default_blocks:
            block_name: ~
            "another/block_name":
                param1: value1
                param2: value2
```

### Supported Javascripts Docs
#### [Google Analytics](Docs/GoogleAnalytics.md)
#### [Google Tag Manager (GTM)](Docs/GoogleTagManager.md)
#### [Twitter](Docs/Twitter.md)
#### [Facebook SDK](Docs/FacebookSdk.md)

### Other Javascripts
I have not implemented the other planned Javascript SDKs at the moment. Feel free to submit a PR if you're able to help or have another SDK suggestion (or indeed you have any more features or improvements you'd like to see in what is already implemented)

### Contributing a new Javascript
Adding an SDK is pretty straight forwards.
- A new Provider is required in `CommonJsBundle\Provider\Sdk` extending `CommonJsBundle\Provider\BaseProvider`.
- In the dependency injection new configuration parameters will be required
- Models can be added in the `CommonJsBundle\Model\PascalCaseName` namespace where PascalCaseName is the name of the new javascript in PascalCase.
- Template blocks are added in `Resources/views/blocks/sdk_snake_case_name` with an `init.html.twig` file and then a sub directory `js` for all blocks needed.
