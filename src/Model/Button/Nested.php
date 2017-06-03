<?php

namespace Tgallice\FBMessenger\Model\Button;

use Tgallice\FBMessenger\Model\Button;

class Nested extends Button
{
    /**
     * @var string
     */
    private $title;

    /**
     * Payload Array
     *
     * @var array
     */
    private $payload;

    /**
     * @param string $title
     * @param array $payload
     */
    public function __construct($title, array $payloads)
    {
        parent::__construct(Button::TYPE_NESTED);

        self::validateTitleSize($title);
        $this->title = $title;

        foreach ($payloads as $payload) {
            Button::validatePayload($payload->getPayload());
        }

        $this->payload = $payloads;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        $json = parent::jsonSerialize();
        $json['title'] = $this->title;
        $json['call_to_actions'] = $this->payload;

        return $json;
    }
}
