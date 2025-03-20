<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Tests;

use BVP\TsuScraper\ScraperCore;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class ScraperCoreTest extends TestCase
{
    /**
     * @var \BVP\TsuScraper\ScraperCore
     */
    protected ScraperCore $scraper;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->scraper = new ScraperCore();
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ScraperCoreDataProvider::class, 'scrapeForecastsProvider')]
    public function testScrapeForecasts(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrapeForecasts(...$arguments));
    }

    /**
     * @return void
     */
    public function testScrapeCommentsWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\CommentScraper::scrape() - " .
            "The 'scrape' feature is currently not implemented."
        );

        $this->scraper->scrapeComments(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testScrapeTimesWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\TimeScraper::scrape() - " .
            "The 'scrape' feature is currently not implemented."
        );

        $this->scraper->scrapeTimes(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testScrapeWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\ForecastScraper::scrapeYesterday() - " .
            "The specified key '.zyosou_cmt' is not found in the content of the URL: " .
            "'https://www.boatrace-tsu.com/modules/yosou/group-syussou.php?day=20250106&race=1'."
        );

        $this->scraper->scrapeForecasts(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testInvalidWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\ScraperCore::__call() - " .
            "Call to undefined method 'BVP\TsuScraper\ScraperCore::invalid()'."
        );

        $this->scraper->invalid(1, '2025-01-06');
    }
}
