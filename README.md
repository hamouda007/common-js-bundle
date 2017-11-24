# BW Javascript SDK Bundle
This bundle provides twig functions to easily add common Javascript SDK tags to any page.

It has been structured to be easily expanded for whatever SDKs you may want. Out of the box this bundle will support Google Analytics, Woopra, Facebook, Facebook Pixel and Twitter.

This bundle is only configured and tested to be used for Symfony >=3.4 using the new Flex file structure.

## Installation
This bundle will be submitted to the Symfony Flex contrib repository shortly. Until then you'll have to add the bundle into your bundles.php file manually.
```bash
composer req silverbackis/js-sdk-bundle
```

```php
// config/bundles.php
return [
    JsSdkBundle\JsSdkBundle::class => ['all' => true],
];
```

## Getting Started
Javascript blocks can be configured directly from your twig templates using the following functions
```twig
{{ js_sdk_add_block(sdk_name, sdk_block_name, at_sdk_block_name, before_at_sdk_block_name, override_params) }}
{{ js_sdk_output(sdk_name, override_params) }}
```

You can duplicate an SDK block in its current state at any point in the Twig template
```twig
{{ js_sdk_duplicate(sdk_name, new_sdk_name, override_params) }}
```

You can also remove a block (if you've duplicated a block but want to remove a specific section for example)
```twig
{{ js_sdk_remove(sdk_name, sdk_block_name) }}
```

### Example with Google Analytics
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

### SDK Names, Blocks and Configuration Parameters
#### Google Analytics

<table>
  <thead>
    <tr>
      <th>Block</th>
      <th>Description</th>
      <th>Variables</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>page_view</td>
      <td>page view tracking code</td>
      <td>
        <ul>
          <li>tracking_function</li>
        </ul>
      </td>
    </tr>
    <tr>
      <td>ec/init</td>
      <td>extended e-commerce tracking initialisation</td>
      <td>
        <ul>
          <li>tracking_function</li>
          <li>currency</li>
        </ul>
      </td>
    </tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th>Variable</th>
      <th>Default</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>tracking_function</td>
      <td>ga</td>
    </tr>
    <tr>
      <td>currency</td>
      <td>GBP</td>
    </tr>
  </tbody>
</table>