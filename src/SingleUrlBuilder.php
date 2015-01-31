<?php

/*
 * This file is part of the Gravatar package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gravatar;

/**
 * Builds URLs for a single hash
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SingleUrlBuilder extends AbstractUrlBuilder
{
    /**
     * @var string
     */
    protected $emailHash;

    /**
     * @param string  $email
     * @param boolean $useHttps
     */
    public function __construct($email, $useHttps = true)
    {
        $this->emailHash = $this->createEmailHash($email);

        parent::__construct($useHttps);
    }

    /**
     * Returns an Avatar URL
     *
     * @param array  $options
     *
     * @return string
     */
    public function avatar(array $options = [])
    {
        return $this->buildUrl('avatar/'.$this->emailHash);
    }

    /**
     * Returns a profile URL
     *
     * @return string
     */
    public function profile()
    {
        return $this->buildUrl($this->emailHash);
    }

    /**
     * Returns a vCard URL
     *
     * @return string
     */
    public function vcard()
    {
        return $this->profile().'.vcf';
    }

    /**
     * Returns a QR Code URL
     *
     * @return string
     */
    public function qrCode()
    {
        return $this->profile().'.qr';
    }
}
