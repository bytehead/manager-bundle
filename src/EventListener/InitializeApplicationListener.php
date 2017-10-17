<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ManagerBundle\EventListener;

use Symfony\Component\Filesystem\Filesystem;

class InitializeApplicationListener
{
    /**
     * @var string
     */
    private $projectDir;

    /**
     * @param string $projectDir
     */
    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * Adds the initialize.php file.
     */
    public function onInitializeApplication(): void
    {
        if (file_exists($this->projectDir.'/system/initialize.php')) {
            return;
        }

        (new Filesystem())
            ->copy(
                __DIR__.'/../Resources/skeleton/system/initialize.php',
                $this->projectDir.'/system/initialize.php',
                true
            )
        ;
    }
}
