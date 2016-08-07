<?php

namespace NicklasW\PkmGoApi\Requests;

use POGOProtos\Networking\Envelopes\ResponseEnvelope;
use POGOProtos\Networking\Requests\Messages\GetPlayerMessage;
use POGOProtos\Networking\Requests\RequestType;
use POGOProtos\Networking\Responses\GetPlayerResponse;
use ProtobufMessage;

class GetPlayerRequest extends Request {

    /**
     * @var integer The request type
     */
    protected $type = RequestType::GET_PLAYER_VALUE;

    /**
     * @var ProtobufMessage The request message
     */
    protected $message;

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return \Protobuf\Message
     */
    public function getMessage()
    {
        return new GetPlayerMessage();
    }

    /**
     * Handles the request data.
     *
     * @param ResponseEnvelope $data
     * @return mixed
     */
    public function handleResponse($data)
    {
        // Retrieve the specific request data
        $requestData = current($data->getReturnsList());

        // Initialize the player response
        $playerResponse = new GetPlayerResponse($requestData);

        $this->setData($playerResponse);
    }
}