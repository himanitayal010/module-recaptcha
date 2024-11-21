/**
 * HTS Inc.
 *
 * @category  HTS
 * @package   HTS_ReCaptcha
 * @author    HTS
 * @copyright Copyright (c) HTS Inc.
 */

'use strict';

define(['ko'], function (ko) {
return {
    ids: ko.observableArray([]),
    captchaList: ko.observableArray([]),
    tokenFields: ko.observableArray([])
};
});
