<?php

namespace Intermediaio\ContaoNewsApi\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(Intermediaio\ContaoNewsApi\IntermediaioContaoNewsApiBundle::class)
                ->setLoadAfter([\Contao\CoreBundle\ContaoCoreBundle::class]),
        ];
    }
}
