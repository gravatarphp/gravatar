<?php

namespace Gravatar;

/**
 * Provides common functions for UrlBuilder and SingleUrlBuilder.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class BaseUrlBuilder
{
    /**
     * Gravatar endpoints.
     */
    const HTTP_ENDPOINT = 'http://www.gravatar.com';
    const HTTPS_ENDPOINT = 'https://secure.gravatar.com';

    /**
     * Whether to use HTTPS endpoint.
     *
     * @var bool
     */
    protected $secure;

    /**
     * @param bool $secure
     */
    public function __construct($secure = true)
    {
        $this->secure = (bool) $secure;
    }

    /**
     * Creates a hash from an email address.
     *
     * @param string $email
     *
     * @return string
     */
    protected function createEmailHash($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        return md5(strtolower(trim($email)));
    }

    /**
     * Builds the URL based on the given parameters.
     *
     * @param string    $segment
     * @param array     $params
     * @param bool|null $secure
     *
     * @return string
     */
    protected function buildUrl($segment, array $params = [], $secure = null)
    {
        $secure = isset($secure) ? (bool) $secure : $this->secure;

        $endpoint = $secure ? self::HTTPS_ENDPOINT : self::HTTP_ENDPOINT;

        $params = array_filter($params);

        $url = sprintf('%s/%s', $endpoint, $segment);

        if (!empty($params)) {
            $url .= '?'.http_build_query($params);
        }

        return $url;
    }
}
