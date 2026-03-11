<?php

declare(strict_types=1);

namespace Voilab\Serviceanswer;

use Voilab\Serviceanswer\Interfaces\Returnable;
use Voilab\Serviceanswer\Traits\Base;
use function count;
use function is_string;

class Answer implements Returnable
{
    use Base;

    /**
     * @var Container
     */
    public $container;

    public function __construct(Container $c)
    {
        $this->container = $c;
    }

    public function getMessage($type = null)
    {
        // if a type is provided, try to get the message
        if ($type) {
            if (isset($this->messages[$type])) {
                return $this->messages[$type];
            }

            return null;
        }

        // otherwise, get the most appropriate message
        if (isset($this->messages['public'])) {
            return $this->messages['public'];
        }
        if (isset($this->messages['dev']) && is_string($this->messages['dev'])) {
            // @phpstan-ignore-next-line Pimple container access returns mixed
            $prefix = $this->container['config']['wording']['devMessagePrefix'] ?? '';

            return (is_string($prefix) ? $prefix : '') . $this->messages['dev'];
        }
        if (count($this->messages) > 0) {
            return array_shift($this->messages);
        }

        return null;
    }
}
