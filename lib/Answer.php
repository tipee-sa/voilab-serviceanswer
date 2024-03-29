<?php
namespace Voilab\Serviceanswer;


use Voilab\Serviceanswer\Interfaces\Returnable;
use Voilab\Serviceanswer\Traits\Base;

class Answer implements Returnable {
    use Base;

    /**
     * @var Container
     */
    public $container;



/** ================== Constructor ========================================== */

    public function __construct(Container $c) {
        $this->container = $c;
    }

/** ================ / Constructors ========================================= */






/** ================== Public methods ======================================= */

    public function getMessage($type = null) {
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
        if (isset($this->messages['dev'])) {
            return $this->container['config']['wording']['devMessagePrefix'] . $this->messages['dev'];
        }
        if (count($this->messages) > 0) {
            return array_shift($this->messages);
        }

        return null;
    }

/** ================ / Public methods ======================================= */

}