<?php

namespace Gravatar;

/**
 * Builds URLs for a single hash.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SingleUrlBuilder extends BaseUrlBuilder
{
    /**
     * @var string
     */
    protected $emailHash;

    /**
     * @param string $email
     * @param bool   $useHttps
     */
    public function __construct($email, $useHttps = true)
    {
        $this->emailHash = $this->createEmailHash($email);

        parent::__construct($useHttps);
    }

    /**
     * Returns an Avatar URL.
     *
     * @param array $options
     *
     * @return string
     */
    public function avatar(array $options = [])
    {
        return $this->buildUrl('avatar/'.$this->emailHash, $options);
    }

    /**
     * Returns a profile URL.
     *
     * @return string
     */
    public function profile()
    {
        return $this->buildUrl($this->emailHash);
    }

    /**
     * Returns a vCard URL.
     *
     * @return string
     */
    public function vcard()
    {
        return $this->profile().'.vcf';
    }

    /**
     * Returns a QR Code URL.
     *
     * @return string
     */
    public function qrCode()
    {
        return $this->profile().'.qr';
    }
}
