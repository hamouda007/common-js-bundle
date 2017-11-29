[< Back to main Readme](../README.md)

# Google Analytics
SDK name: **google_analytics**

## Models
> *For the EC models see the [Google Developer Guide](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce)*
### CommonJsBundle\Model\GoogleAnalytics\Event
- category
- action
- label
- transport
- nonInteraction


### CommonJsBundle\Model\GoogleAnalytics\EcAction
- name (this must be a name of the action as documented [here](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#action-types))
- id
- affiliation
- revenue
- tax
- shipping
- coupon
- list
- step
- option

### CommonJsBundle\Model\GoogleAnalytics\EcImpression
- id
- name
- list
- brand
- category
- variant
- position
- price

### CommonJsBundle\Model\GoogleAnalytics\EcProduct
- id
- name
- brand
- category
- variant
- price
- quantity
- coupon
- position

### CommonJsBundle\Model\GoogleAnalytics\EcPromo
- id
- name
- creative
- position

## Reference
| Parameter | Default | Details |
| :--- | :--- | :--- |
| id | n/a (required) | Used in cjs_output function to initialise tracking code. E.g. 'UA-12345678' |
| tracking_function | "ga" | The function variable to be used for tracking |
| debug | false | Can enable debug mode on the analytics tracking code |
| currency | "GBP" | Used in extended e-commerce tracking to define the default currency you are recording monetary values with |
| event | n/a | An instance of the Event model **(required for "event" block)** |
| key | n/a | String - key of variable to set **(required for "set" block)** |
| value | n/a | String - value of the variable to set **(required for "set" block)** |
| impression | n/a | An instance of the EcImpression model **(required for "ec/add_impression" block)** |
| product | n/a | An instance of the EcProduct model **(required for "ec/add_product" block)** |
| promo | n/a | An instance of the EcPromo model **(required for "ec/add_promo" block)** |
| action | n/a | An instance of the EcAction model **(required for "ec/set_action" block)** |

> Every block in this SDK can take the parameter `tracking_function` but it's recommended to duplicate your default google_analytics block with a new `tracking_function` parameter and simply use the new SDK name instead rather than overriding it on each individual block. Alternatively to just use a different `tracking_function` parameter for the default SDK, you can change this in your config files.

| Block | Description | Parameter Used
| :--- | :--- | :--- |
| page_view | page view tracking code | - |
| event | send an event to track | event |
| set | sets an analytics variable | key<br>value |
| ec/init | extended e-commerce tracking initialisation | currency |
| ec/add_impression | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-activities) | impression |
| ec/add_product | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-activities) | product |
| ec/add_promo | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-promos) | promo |
| ec/set_action | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-activities) | action |