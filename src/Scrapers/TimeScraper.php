<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Scrapers;

use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
class TimeScraper extends BaseScraper implements TimeScraperInterface
{
    /**
     * @param  string|int                           $raceCode
     * @param  \Carbon\CarbonInterface|string|null  $date
     * @return never
     *
     * @throws \BadMethodCallException
     */
    public function scrape(string|int $raceCode, CarbonInterface|string|null $date = null): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - The 'scrape' feature is currently not implemented."
        );
    }
}
