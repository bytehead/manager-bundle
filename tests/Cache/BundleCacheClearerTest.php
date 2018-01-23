<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\ManagerBundle\Test\Cache;

use Contao\ManagerBundle\Cache\BundleCacheClearer;
use Contao\TestCase\ContaoTestCase;
use Symfony\Component\Filesystem\Filesystem;

class BundleCacheClearerTest extends ContaoTestCase
{
    public function testInstantiation(): void
    {
        $clearer = new BundleCacheClearer();

        $this->assertInstanceOf('Contao\ManagerBundle\Cache\BundleCacheClearer', $clearer);
    }

    public function testClear(): void
    {
        $fs = new Filesystem();
        $fs->mkdir($this->getTempDir());
        $fs->touch($this->getTempDir().'/bundles.map');

        $this->assertFileExists($this->getTempDir().'/bundles.map');

        $clearer = new BundleCacheClearer($fs);
        $clearer->clear($this->getTempDir());

        $this->assertFileNotExists($this->getTempDir().'/bundles.map');
    }
}
