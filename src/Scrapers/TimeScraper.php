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
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return never
     *
     * @throws \BadMethodCallException
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): never
    {
        throw new \BadMethodCallException(
            __METHOD__ . "() - The 'scrape' feature is currently not implemented."
        );
    }
}
