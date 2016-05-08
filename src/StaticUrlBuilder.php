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
        if (!isset(static::$urlBuilder)) {
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
        static::getUrlBuilder()->useHttps($useHttps);
    }

    /**
     * Returns an Avatar URL.
     *
     * @param string $email
     * @param array  $options
     *
     * @return string
     */
    public static function avatar($email, array $options = [])
    {
        return static::getUrlBuilder()->avatar($email, $options);
    }

    /**
     * Returns a profile URL.
     *
     * @param string $email
     *
     * @return string
     */
    public static function profile($email)
    {
        return static::getUrlBuilder()->profile($email);
    }

    /**
     * Returns a vCard URL.
     *
     * @param string $email
     *
     * @return string
     */
    public static function vcard($email)
    {
        return static::getUrlBuilder()->vcard($email);
    }

    /**
     * Returns a QR Code URL.
     *
     * @param string $email
     *
     * @return string
     */
    public static function qrCode($email)
    {
        return static::getUrlBuilder()->qrCode($email);
    }
}
