<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Scrapers;

use BVP\TsuScraper\ScraperContractInterface;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
interface ForecastScraperInterface extends ScraperContractInterface
{
    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return array
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $date = null): array;
}
