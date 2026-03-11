<?php

declare(strict_types=1);

namespace Voilab\Serviceanswer\Interfaces;

interface Returnable
{
    /**
     * Retrieve the content of the returned object
     *
     * @return mixed
     */
    public function getBody();

    /**
     * Define if the called service method is considered as successful
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * Get all messages
     *
     * @return array<string, mixed>
     */
    public function getMessages();

    /**
     * Get a specific message
     *
     * @param string|null $type
     * @return mixed
     */
    public function getMessage($type = null);

    /**
     * Get an error code
     *
     * @return string|int|null
     */
    public function getErrorCode();

    /**
     * Récupération des métadonnées de la réponse
     *
     * @return array<string, mixed>
     */
    public function getMetadatas();

    /**
     * @return bool
     */
    public function isEmpty();
}
