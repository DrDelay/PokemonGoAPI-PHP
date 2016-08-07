<?php

namespace NicklasW\PkmGoApi\Requests\Envelops;

use POGOProtos\Networking\Envelopes\RequestEnvelope\AuthInfo;
use POGOProtos\Networking\Envelopes\RequestEnvelope\AuthInfo\JWT;

class Factory {

    /**
     * @var string AuthInfo type
     */
    public static $TYPE_AUTHINFO = 'authinfo';

    /**
     * Envelope factory.
     *
     * @param string $type
     * @param array  ...$parameters
     * @return \Protobuf\Message|null
     */
    public function create($type, ...$parameters)
    {
        $envelope = null;

        switch ($type) {
            case self::$TYPE_AUTHINFO:
                // Create Auth Info envelope
                $envelope = $this->authInfoEnvelope(...$parameters);

                break;

        }

        return $envelope;
    }

    /**
     * Creates AuthInfoEnvelope.
     *
     * @param string $type
     * @param string $token
     * @return AuthInfo
     */
    protected function authInfoEnvelope($type, $token)
    {
        $authInfoJWT = new JWT();
        $authInfoJWT->setContents($token);
        $authInfoJWT->setUnknown2(59);

        $authInfoEnvelope = new AuthInfo();
        $authInfoEnvelope->setProvider($type);
        $authInfoEnvelope->setToken($authInfoJWT);

        return $authInfoEnvelope;
    }

}
