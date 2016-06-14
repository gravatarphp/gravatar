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
            static::$urlBuilder = new UrlBuilder();
        }

        return static::$urlBuilder;
    }

    /**
     * Sets the used connection endpoint.
     *
     * @param bool $useHttps
     */
    public static function useHttps($useHttps)
    {
        static::$urlBuilder = new UrlBuilder($useHttps);
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
