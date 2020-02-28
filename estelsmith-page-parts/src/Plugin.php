<?php

namespace EstelSmith\WordPress\PageParts;

use EstelSmith\WordPress\PageParts\Traits\BindClosure;

class Plugin
{
    use BindClosure;

    /**
     * @var Module[]
     */
    protected $modules = [];

    public function __construct()
    {
        $this->registerHooks();
    }

    /**
     * Instantiate only a single instance of the class.
     */
    public static function getInstance(): self
    {
        static $instance = null;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    protected function init(): void
    {
        foreach ($this->modules as $module) {
            $module->init();
        }
    }

    protected function registerHooks(): void
    {
        add_action(
            'init',
            $this->bindThis(
                function () {
                    $this->init();
                }
            )
        );
    }

    public function addModule(Module ...$modules): void
    {
        foreach ($modules as $module) {
            $this->modules[] = $module;
        }
    }
}
