<?php

namespace Gravatar;

/**
 * Provides helper for static access.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class StaticUrlBuilder
{
    /**
     * @var UrlBuilder
     */
    protected static $urlBuilder;

    /**
     * Returns an UrlBuilder instance.
     *
     * @return UrlBuilder
     */
    protected static function getUrlBuilder()
    {
        if (null === static::$urlBuilder) {
            static::configure();
        }

        return static::$urlBuilder;
    }

    /**
     * Configures the underlying URL Builder.
     *
     * @param array $defaultParams
     * @param bool  $secure
     */
    public static function configure(array $defaultParams = [], $secure = true)
    {
        static::$urlBuilder = new UrlBuilder($defaultParams, $secure);
    }

    /**
     * Returns an Avatar URL.
     *
     * @param string    $email
     * @param array     $options
     * @param bool|null $secure
     *
     * @return string
     */
    public static function avatar($email, array $options = [], $secure = null)
    {
        return static::getUrlBuilder()->avatar($email, $options, $secure);
    }

    /**
     * Returns a profile URL.
     *
     * @param string    $email
     * @param bool|null $secure
     *
     * @return string
     */
    public static function profile($email, $secure = null)
    {
        return static::getUrlBuilder()->profile($email, $secure);
    }

    /**
     * Returns a vCard URL.
     *
     * @param string    $email
     * @param bool|null $secure
     *
     * @return string
     */
    public static function vcard($email, $secure = null)
    {
        return static::getUrlBuilder()->vcard($email, $secure);
    }

    /**
     * Returns a QR Code URL.
     *
     * @param string    $email
     * @param bool|null $secure
     *
     * @return string
     */
    public static function qrCode($email, $secure = null)
    {
        return static::getUrlBuilder()->qrCode($email, $secure);
    }
}
