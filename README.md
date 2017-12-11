# Common JS Bundle
***Not affiliated with The CommonJS group***

[![Build Status](https://travis-ci.org/silverbackis/common-js-bundle.svg?branch=master)](https://travis-ci.org/silverbackis/common-js-bundle)
[![codecov](https://codecov.io/gh/silverbackis/common-js-bundle/branch/master/graph/badge.svg)](https://codecov.io/gh/silverbackis/common-js-bundle)
[![license](https://img.shields.io/github/license/silverbackis/common-js-bundle.svg)](LICENCE)

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

Enable the Symfony Flex Recipes Contrib Repository
```bash
composer config extra.symfony.allow-contrib true
```

Until merged set the SYMFONY_ENDPOINT env var:
```bash
export SYMFONY_ENDPOINT=https://symfony.sh/r/github.com/symfony/recipes-contrib/159
```

Install the bundle:
```bash
composer req "silverbackis/common-js-bundle:^1.0@beta"
```

Until merged, unset the environment variable:
```bash
unset SYMFONY_ENDPOINT
```

## Getting Started
Javascript blocks can be configured directly from your twig templates using the following functions
```twig
{{ cjs_add_block(name, block_name, at_block_name, before_at_block_name, override_params_object) }}
```
>`at_block_name` can be `"false"` (note this is a string) which will result in the function returning the javascript for you to insert. You may which to track a click event for example when a user clicks a link instead of in the main tracking code.

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
The default configuration values will work for 90% of use cases if you simply set the environment variables (when required). Other scripts will be enabled by default.

However, you may wish to create a config file to add in default blocks:
```yaml
# config/packages/silverback_common_js.yaml
# Enable and configure the scripts you'd like
silverback_common_js:
    google_analytics:
        default_blocks:
            page_view: ~
            "ec/init":
                currency: USD
```
`default_blocks` can be an array of blocks you want. You can also include parameters if you want. It will pre-populate blocks in the order provided so you can just write `{{ cjs_js('name') }}` in your twig template

> You cannot pass the `default_blocks` variable in via the twig template, but you can still remove and modify the default blocks from the template using `cjs_add_block()` and `cjs_remove_block()` functions

Identifiers will be added as environment variables by Flex into your **.env** file.
```dotenv
GOOGLE_ANALYTICS_ID=
GTM_CONTAINER_ID=
FACEBOOK_APP_ID=
```
Set the IDs for these services if you want to enable them. Otherwise they will be disabled.

### Models
There are models available for some SDK blocks (e.g. Google Analytics Event). You can use these to easily construct and pass data to a block. All models allow you to define all the variables in the constructor (in the order they are documented here) and also have getters and setters. Examples are provided in the individual script docs.

### Supported Javascripts Docs
#### [Google Analytics](Docs/GoogleAnalytics.md)
#### [Google Tag Manager (GTM)](Docs/GoogleTagManager.md)
#### [Twitter](Docs/Twitter.md)
#### [Facebook SDK](Docs/FacebookSdk.md)

### Contributing a new Javascript
Adding an SDK is pretty straight forwards.
- A new Provider is required in `CommonJsBundle\Provider\Sdk` extending `CommonJsBundle\Provider\BaseProvider`.
- In the dependency injection new configuration parameters will be required
- Models can be added in the `CommonJsBundle\Model\PascalCaseName` namespace where PascalCaseName is the name of the new javascript in PascalCase.
- Template blocks are added in `Resources/views/blocks/snake_case_name` with an `init.html.twig` file and then a sub directory `js` for all blocks needed.
