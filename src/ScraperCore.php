<?php

declare(strict_types=1);

namespace BVP\TsuScraper;

use BVP\TsuScraper\Scrapers\CommentScraper;
use BVP\TsuScraper\Scrapers\ForecastScraper;
use BVP\TsuScraper\Scrapers\TimeScraper;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
class ScraperCore implements ScraperCoreInterface
{
    /**
     * @var array
     */
    private array $instances = [];

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
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    public function scrapeComments(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        return ($this->instances['CommentScraper'] ??= new CommentScraper())->scrape($raceNumber, $raceDate);
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    public function scrapeForecasts(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        return ($this->instances['ForecastScraper'] ??= new ForecastScraper())->scrape($raceNumber, $raceDate);
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    public function scrapeTimes(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        return ($this->instances['TimeScraper'] ??= new TimeScraper())->scrape($raceNumber, $raceDate);
    }
}
