<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Response represents an HTTP response in JSON format.
 *
 * @author Igor Wiedler <igor@wiedler.ch>
 */
class vpaJsonResponse extends JsonResponse
{
    /**
     * Sets the data to be sent as json.
     *
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function setData($data = array())
    {
        // Standard Symfony JsonResponse encodes double-quotes.
        // We frequently use JSON as the data we're setting, so we
        // don't want to encode double-quotes.

        // Encode <, >, ', &, and " for RFC4627-compliant JSON, which may also be embedded into HTML.
        $this->data = json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP );

        return $this->update();
    }
}
