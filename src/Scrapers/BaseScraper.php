<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Scrapers;

use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
abstract class BaseScraper implements BaseScraperInterface
{
    /**
     * @var string
     */
    protected string $baseUrl = 'https://www.boatrace-tsu.com/modules/yosou/%s.php?day=%s&race=%d';

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return never
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - Call to undefined method '" . self::class . "::{$name}()'."
        );
    }

    /**
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    abstract public function scrape(string|int $raceCode, CarbonInterface|string|null $date = null): array;
}
