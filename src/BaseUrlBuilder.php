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
     * @var array
     */
    protected $defaultParams = [];

    /**
     * Whether to use HTTPS endpoint.
     *
     * @var bool
     */
    protected $secure;

    /**
     * @param array $defaultParams
     * @param bool  $secure
     */
    public function __construct(array $defaultParams = [], $secure = true)
    {
        $this->defaultParams = array_filter($defaultParams);
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
     * @param string    $resource
     * @param bool|null $secure
     *
     * @return string
     */
    protected function buildUrl($resource, $secure = null)
    {
        $secure = isset($secure) ? (bool) $secure : $this->secure;

        $endpoint = $secure ? self::HTTPS_ENDPOINT : self::HTTP_ENDPOINT;

        return sprintf('%s/%s', $endpoint, $resource);
    }

    /**
     * Builds the URL based on the given parameters.
     *
     * @param string    $resource
     * @param array     $params
     * @param bool|null $secure
     *
     * @return string
     */
    protected function buildUrlWithParams($resource, array $params = [], $secure = null)
    {
        $params = array_merge($this->defaultParams, array_filter($params));

        if (!empty($params)) {
            $resource .= '?'.http_build_query($params);
        }

        return $this->buildUrl($resource, $secure);
    }
}
