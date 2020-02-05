<?php

namespace CascadeMedia\WordPress\PageParts;

use CascadeMedia\WordPress\PageParts\Module\CustomPostType;
use CascadeMedia\WordPress\PageParts\Traits\BindClosure;

//@TODO Rename class simply to `Plugin`, since there aren't multiple plugins here.
class PagePartsPlugin
{
    use BindClosure;

    /**
     * @var Module[]
     */
    protected $modules = [];

    public function __construct()
    {
        $this->registerHooks();

        //@TODO Make this configurable.
        $this->addModules(...[
            new CustomPostType($this)
        ]);
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

    public function addModule(Module $module): void
    {
        $this->modules[] = $module;
    }

    public function addModules(Module ...$modules): void
    {
        foreach ($modules as $module) {
            $this->addModule($module);
        }
    }
}
