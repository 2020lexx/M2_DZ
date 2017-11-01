
/*
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/shipping-rates-validator',
        'Magento_Checkout/js/model/shipping-rates-validation-rules',
        'shipping-rates-validator',
        'shipping-rates-validation-rules'
    ],
    function (
        Component,
        defaultShippingRatesValidator,
        defaultShippingRatesValidationRules,
        zxShippingProviderShippingRatesValidator,
        zxShippingProviderShippingRatesValidationRules
    ) {
        "use strict";
        defaultShippingRatesValidator.registerValidator('zxshipping', zxShippingProviderShippingRatesValidator);
        defaultShippingRatesValidationRules.registerRules('zxshipping', zxShippingProviderShippingRatesValidationRules);
        return Component;
    }
);
