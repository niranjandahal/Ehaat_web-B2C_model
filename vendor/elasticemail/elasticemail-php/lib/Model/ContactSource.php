<?php
/**
 * ContactSource
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  ElasticEmail
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Elastic Email REST API
 *
 * This API is based on the REST API architecture, allowing the user to easily manage their data with this resource-based approach.    Every API call is established on which specific request type (GET, POST, PUT, DELETE) will be used.    The API has a limit of 20 concurrent connections and a hard timeout of 600 seconds per request.    To start using this API, you will need your Access Token (available <a target=\"_blank\" href=\"https://app.elasticemail.com/marketing/settings/new/manage-api\">here</a>). Remember to keep it safe. Required access levels are listed in the given request’s description.    Downloadable library clients can be found in our Github repository <a target=\"_blank\" href=\"https://github.com/ElasticEmail?tab=repositories&q=%22rest+api%22+in%3Areadme\">here</a>
 *
 * The version of the OpenAPI document: 4.0.0
 * Contact: support@elasticemail.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.2.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace ElasticEmail\Model;
use \ElasticEmail\ObjectSerializer;

/**
 * ContactSource Class Doc Comment
 *
 * @category Class
 * @package  ElasticEmail
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ContactSource
{
    /**
     * Possible values of this enum
     */
    public const DELIVERY_API = 'DeliveryApi';

    public const MANUAL_INPUT = 'ManualInput';

    public const FILE_UPLOAD = 'FileUpload';

    public const WEB_FORM = 'WebForm';

    public const CONTACT_API = 'ContactApi';

    public const VERIFICATION_API = 'VerificationApi';

    public const FILE_VERIFICATION_API = 'FileVerificationApi';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::DELIVERY_API,
            self::MANUAL_INPUT,
            self::FILE_UPLOAD,
            self::WEB_FORM,
            self::CONTACT_API,
            self::VERIFICATION_API,
            self::FILE_VERIFICATION_API
        ];
    }
}


