<?php
namespace Intermediaio\ContaoNewsApi\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Config\PluginConfig;

class Plugin implements BundlePluginInterface
{
    public function getBundles(PluginConfig $pluginConfig): array
    {
        return [
          BundleConfig::create(\Intermediaio\ContaoNewsApi\IntermediaioContaoNewsApiBundle::class)
            ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}
