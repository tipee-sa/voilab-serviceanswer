<?php

declare(strict_types=1);

namespace Voilab\Serviceanswer\Traits;

trait Base
{
    /**
     * @var mixed
     */
    public $body;

    /**
     * @var array<string, mixed>
     */
    public $messages = [];

    /**
     * @var bool
     */
    public $success = true;

    /**
     * @var string|int|null
     */
    public $errorCode;

    /**
     * @var array<string, mixed>
     */
    public $metadatas = [];

    /**
     * @var array<string, mixed>
     */
    public $internalDatas = [];

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     *
     * @return static
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return string|int|null
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param string|int|null $code
     *
     * @return static
     */
    public function setErrorCode($code)
    {
        $this->errorCode = $code;

        return $this;
    }

    /**
     * @param mixed $message
     *
     * @return static
     */
    public function setPublicMessage($message)
    {
        $this->messages['public'] = $message;

        return $this;
    }

    /**
     * @param mixed $message
     *
     * @return static
     */
    public function setDeveloperMessage($message)
    {
        $this->messages['dev'] = $message;

        return $this;
    }

    /**
     * @param mixed $message
     *
     * @return static
     */
    public function setEmptyBodyMessage($message)
    {
        $this->messages['empty'] = $message;

        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return static
     */
    public function setMetadata($key, $value)
    {
        $this->metadatas[$key] = $value;

        return $this;
    }

    /**
     * @param array<string, mixed> $metadatas
     *
     * @return static
     */
    public function setMetadatas($metadatas)
    {
        $this->metadatas = $metadatas;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getMetadatas()
    {
        return $this->metadatas;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getMetadata($key)
    {
        return $this->metadatas[$key];
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return static
     */
    public function setInternalData($key, $value)
    {
        $this->internalDatas[$key] = $value;

        return $this;
    }

    /**
     * @param array<string, mixed> $datas
     *
     * @return static
     */
    public function setInternalDatas($datas)
    {
        $this->internalDatas = $datas;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getInternalDatas()
    {
        return $this->internalDatas;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getInternalData($key)
    {
        return $this->internalDatas[$key];
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->body);
    }
}
