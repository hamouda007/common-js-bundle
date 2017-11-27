[< Back to main Readme](../README.md)

### Google Analytics
SDK name: **google_analytics**

#### Models
##### JsSdkBundle\Model\GoogleAnalytics\Event
- category
- action
- label
- transport
- nonInteraction

For the EC models below see the [Google Developer Guide](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce)
##### JsSdkBundle\Model\GoogleAnalytics\EcAction
- id
- affiliation
- revenue
- tax
- shipping
- coupon
- list
- step
- option

##### JsSdkBundle\Model\GoogleAnalytics\EcImpression
- id
- name
- list
- brand
- category
- variant
- position
- price

##### JsSdkBundle\Model\GoogleAnalytics\EcProduct
- id
- name
- brand
- category
- variant
- price
- quantity
- coupon
- position

##### JsSdkBundle\Model\GoogleAnalytics\EcPromo
- id
- name
- creative
- position

#### Reference
| Parameter | Default | Details |
| :--- | :--- | :--- |
| id | n/a (required) | Used in js_sdk_output function to initialise tracking code. E.g. 'UA-12345678' |
| debug | false | Can enable debug mode on the analytics tracking code |
| tracking_function | "ga" | The function variable to be used for tracking |
| currency | "GBP" | Used in extended e-commerce tracking to define the default currency you are recording monetary values with |
| event | n/a | An instance of the Event model **(required for event block)** |
| key | n/a | String - key of variable to set **(required for set block)** |
| value | n/a | String - value of the variable to set **(required for set block)** |
| impression | n/a | An instance of the EcImpression model **(required for ec/addImpression block)** |
| product | n/a | An instance of the EcProduct model **(required for ec/addProduct block)** |
| promo | n/a | An instance of the EcPromo model **(required for ec/addPromo block)** |
| action_name | n/a | String - any of the action types supported by [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#action-types) - actions also available from `JsSdkBundle\Provider\Sdk\GoogleAnalyticsProvider::ecActions()` and class constants available as well **(required for ec/setAction block)**  |
| action | n/a | An instance of the EcAction model **(required for ec/setAction block)** |

| Block | Description | Variables Used
| :--- | :--- | :--- |
| page_view | page view tracking code | tracking_function |
| event | send an event to track | tracking_function<br>event |
| set | sets an analytics variable | key<br>value |
| ec/init | extended e-commerce tracking initialisation | tracking_function<br>currency |
| ec/addImpression | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-activities) | impression |
| ec/addProduct | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-activities) | product |
| ec/addPromo | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-promos) | promo |
| ec/setAction | [Google Developers Reference](https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#measuring-activities) | action_name<br>action |