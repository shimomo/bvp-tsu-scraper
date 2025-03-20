<?php

declare(strict_types=1);

namespace BVP\TsuScraper;

/**
 * @author shimomo
 */
interface ScraperInterface extends ScraperContractInterface
{
    /**
     * @param  \BVP\TsuScraper\ScraperCoreInterface
     * @return \BVP\TsuScraper\ScraperInterface
     */
    public static function getInstance(?ScraperCoreInterface $scraperCore = null): ScraperInterface;

    /**
     * @param  \BVP\TsuScraper\ScraperCoreInterface
     * @return \BVP\TsuScraper\ScraperInterface
     */
    public static function createInstance(?ScraperCoreInterface $scraperCore = null): ScraperInterface;

    /**
     * @return void
     */
    public static function resetInstance(): void;
}
