<?php

declare(strict_types=1);

namespace Voilab\Serviceanswer;

use Pimple\Container as PimpleContainer;

class Container extends PimpleContainer
{
    /**
     * @param mixed[] $config Global configuration
     */
    public function __construct(array $config)
    {
        parent::__construct();

        $this['config'] = array_merge([
            'wording' => [
                'devMessagePrefix' => 'Technical message: ',
            ],
        ], $config);

        $this['answer'] = $this->factory(function (self $c) {
            return new Answer($c);
        });

        $this['error'] = $this->factory(function (self $c) {
            $answer = new Answer($c);
            $answer->success = false;

            return $answer;
        });
    }
}
