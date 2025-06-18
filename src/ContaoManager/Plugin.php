<?php

/**
 * @copyright   Copyright (c) 2025, intermeida.io GmbH
 * @author      Fabian Britsch <info@intermedia.io>
 */

namespace Intermediaio\ContaoNewsApi\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Intermediaio\ContaoNewsApi\IntermediaioContaoNewsApiBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(IntermediaioContaoNewsApiBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                ]),
        ];
    }
}
