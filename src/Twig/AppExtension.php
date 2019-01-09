<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class AppExtension extends AbstractExtension
{
    private $defaultImageName;
    private $imagesRoot;

    public function __construct(string $defaultImageName, string $imagesRoot)
    {
        $this->defaultImageName = $defaultImageName;
        $this->imagesRoot = $imagesRoot;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('imagePath', [$this, 'imagePathFilter'])
        ];
    }

    public function imagePathFilter(string $path): string
    {
        return $path === $this->defaultImageName ? \sprintf('%s/%s', $this->imagesRoot, $path) : $path;
    }

}
