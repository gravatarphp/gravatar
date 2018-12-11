<?php

declare(strict_types=1);

namespace Gravatar;

/**
 * Gravatar URL Builder.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class Gravatar
{
    /**
     * Gravatar endpoints.
     */
    private const HTTP_ENDPOINT = 'http://www.gravatar.com';
    private const HTTPS_ENDPOINT = 'https://secure.gravatar.com';

    /**
     * Minimum image size
     *
     * @var int
     */
    private const MINIMUM_IMAGE_SIZE = 1;

    /**
     * Maximum image size
     *
     * @var int
     */
    private const MAXIMUM_IMAGE_SIZE = 2048;

    /**
     * Default Image Keywords
     *
     * @var array
     */
    private const DEFAULT_IMAGE_KEYWORDS = [
        '404',
        'mp',
        'identicon',
        'monsterid',
        'wavatar',
        'retro',
        'robohash',
        'blank'
    ];

    /**
     * Image ratings
     *
     * @var array
     */
    private const IMAGE_RATINGS = [
        'g',
        'pg',
        'r',
        'x'
    ];

    /**
     * @var array
     */
    private $defaults = [];

    /**
     * Whether to use HTTPS endpoint.
     *
     * @var bool
     */
    private $secure;

    public function __construct(array $defaults = [], bool $secure = true)
    {
        $this->defaults = array_filter($defaults);
        $this->secure = $secure;
    }

    /**
     * Returns an Avatar URL.
     */
    public function avatar(string $email, array $options = [], ?bool $secure = null, bool $validateOptions = false): string
    {
        $url = 'avatar/'.$this->createEmailHash($email);

        $options = array_merge($this->defaults, array_filter($options));

        if ($validateOptions) {
            $this->validateOptions($options);
        }

        if (!empty($options)) {
            $url .= '?'.http_build_query($options);
        }

        return $this->buildUrl($url, $secure);
    }

    /**
     * Returns a profile URL.
     */
    public function profile(string $email, ?bool $secure = null): string
    {
        return $this->buildUrl($this->createEmailHash($email), $secure);
    }

    /**
     * Returns a vCard URL.
     */
    public function vcard(string $email, ?bool $secure = null): string
    {
        return $this->profile($email, $secure).'.vcf';
    }

    /**
     * Returns a QR Code URL.
     */
    public function qrCode(string $email, ?bool $secure = null): string
    {
        return $this->profile($email, $secure).'.qr';
    }

    /**
     * Creates a hash from an email address.
     */
    private function createEmailHash(string $email): string
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }

        return md5(strtolower(trim($email)));
    }

    private function validateOptions(array $options): array
    {
        // Image size
        if (array_key_exists('s', $options)) {
            $size = filter_var($options['s'], FILTER_VALIDATE_INT);

            if ($size === false) {
                throw new \InvalidArgumentException('The size parameter ' . $options['s'] . ' is not an integer.');
            }

            if ($size < self::MINIMUM_IMAGE_SIZE || $size > self::MAXIMUM_IMAGE_SIZE) {
                throw new \InvalidArgumentException('The parameter ' . $options['s'] . ' is outside the allowed range of ' . self::MINIMUM_IMAGE_SIZE . ' to ' . self::MAXIMUM_IMAGE_SIZE . '.');
            }
        }

        if (array_key_exists('size', $options)) {
            $size = filter_var($options['size'], FILTER_VALIDATE_INT);

            if ($size === false) {
                throw new \InvalidArgumentException('The size parameter ' . $options['size'] . ' is not an integer.');
            }

            if ($size < self::MINIMUM_IMAGE_SIZE || $size > self::MAXIMUM_IMAGE_SIZE) {
                throw new \InvalidArgumentException('The size parameter ' . $options['size'] . ' is outside the allowed range of ' . self::MINIMUM_IMAGE_SIZE . ' to ' . self::MAXIMUM_IMAGE_SIZE . '.');
            }
        }

        // Default image
        if (array_key_exists('d', $options)) {
            $defaultImage = $options['d'];

            if (filter_var($defaultImage, FILTER_VALIDATE_URL) === false && !in_array(strtolower($defaultImage), self::DEFAULT_IMAGE_KEYWORDS)) {
                throw new \InvalidArgumentException('The default image parameter ' . $options['d'] . ' is not a URL or one of the allowed image keywords.');
            }
        }

        if (array_key_exists('default', $options)) {
            $defaultImage = $options['default'];

            if (filter_var($defaultImage, FILTER_VALIDATE_URL) === false && !in_array(strtolower($defaultImage), self::DEFAULT_IMAGE_KEYWORDS)) {
                throw new \InvalidArgumentException('The default image parameter ' . $options['default'] . ' is not a URL or one of the allowed image keywords.');
            }
        }

        // Force Default
        if (array_key_exists('f', $options)) {
            $forceDefault = $options['f'];

            if ($forceDefault !== 'y') {
                throw new \InvalidArgumentException('The force default parameter ' . $options['f'] . ' is invalid.');
            }
        }

        if (array_key_exists('forcedefault', $options)) {
            $forceDefault = $options['forcedefault'];

            if ($forceDefault !== 'y') {
                throw new \InvalidArgumentException('The force default parameter ' . $options['forcedefault'] . ' is invalid.');
            }
        }

        // Rating
        if (array_key_exists('r', $options)) {
            $rating = strtolower($options['r']);

            if (!in_array($rating, self::IMAGE_RATINGS)) {
                throw new \InvalidArgumentException('The rating parameter ' . $options['r'] . ' is invalid.');
            }
        }

        if (array_key_exists('rating', $options)) {
            $rating = strtolower($options['rating']);

            if (!in_array($rating, self::IMAGE_RATINGS)) {
                throw new \InvalidArgumentException('The rating parameter ' . $options['rating'] . ' is invalid.');
            }
        }

        return $options;
    }

    /**
     * Builds the URL based on the given parameters.
     */
    private function buildUrl(string $resource, ?bool $secure): string
    {
        $secure = isset($secure) ? (bool) $secure : $this->secure;

        $endpoint = $secure ? self::HTTPS_ENDPOINT : self::HTTP_ENDPOINT;

        return sprintf('%s/%s', $endpoint, $resource);
    }
}
