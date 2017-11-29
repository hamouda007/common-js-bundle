<?php

namespace CommonJsBundle\Provider\Js;

use CommonJsBundle\Model\GoogleAnalytics\EcNameIdInterface;
use CommonJsBundle\Provider\BaseProvider;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

final class GoogleAnalyticsProvider extends BaseProvider
{
    const EC_ACTION_CLICK = 'click';
    const EC_ACTION_DETAIL = 'detail';
    const EC_ACTION_ADD = 'add';
    const EC_ACTION_REMOVE = 'remove';
    const EC_ACTION_CHECKOUT = 'checkout';
    const EC_ACTION_CHECKOUT_OPTION = 'checkout_option';
    const EC_ACTION_PURCHASE = 'purchase';
    const EC_ACTION_REFUND = 'refund';
    const EC_ACTION_PROMO_CLICK = 'promo_click';

    /**
     * @return array
     */
    public static function ecActions()
    {
        return [
            self::EC_ACTION_CLICK,
            self::EC_ACTION_DETAIL,
            self::EC_ACTION_ADD,
            self::EC_ACTION_REMOVE,
            self::EC_ACTION_CHECKOUT,
            self::EC_ACTION_CHECKOUT_OPTION,
            self::EC_ACTION_PURCHASE,
            self::EC_ACTION_REFUND,
            self::EC_ACTION_PROMO_CLICK,
        ];
    }

    /**
     * @param string $action
     * @return bool
     */
    public static function validateEcAction(string $action)
    {
        return in_array($action, self::ecActions());
    }

    public static function validateNameOrId(EcNameIdInterface $object, ExecutionContextInterface $context, $payload)
    {
        if (!$object->getId() && !$object->getName())
        {
            $context->buildViolation('Either ID or Name is required')
                ->atPath('id')
                ->addViolation();
        }
    }
}
