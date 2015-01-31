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
 * Gravatar URL Builder
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UrlBuilder extends AbstractUrlBuilder
{
    /**
     * Returns an Avatar URL
     *
     * @param string $email
     * @param array  $options
     *
     * @return string
     */
    public function avatar($email, array $options = [])
    {
        return $this->buildUrl('avatar/'.$this->createEmailHash($email));
    }

    /**
     * Returns a profile URL
     *
     * @param string $email
     *
     * @return string
     */
    public function profile($email)
    {
        return $this->buildUrl($this->createEmailHash($email));
    }

    /**
     * Returns a vCard URL
     *
     * @param string $email
     *
     * @return string
     */
    public function vcard($email)
    {
        return $this->profile($email).'.vcf';
    }

    /**
     * Returns a QR Code URL
     *
     * @param string $email
     *
     * @return string
     */
    public function qrCode($email)
    {
        return $this->profile($email).'.qr';
    }
}
