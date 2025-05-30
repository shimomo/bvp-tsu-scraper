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
    public function testThrowsExceptionWhenMethodIsNotImplementedInComments(): void
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
    public function testThrowsExceptionWhenMethodIsNotImplementedInTimes(): void
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
    public function testThrowsExceptionWhenKeyNotFoundInForecasts(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\ForecastScraper::scrape() - " .
            "The specified key '.zyosou_cmt' is not found in the content of the URL: " .
            "'https://www.boatrace-tsu.com/modules/yosou/group-syussou.php?day=20250106&race=1'."
        );

        $this->scraper->scrapeForecasts(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testThrowsExceptionWhenMethodDoesNotExist(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\ScraperCore::__call() - " .
            "Call to undefined method 'BVP\TsuScraper\ScraperCore::ghost()'."
        );

        $this->scraper->ghost(1, '2025-01-06');
    }
}
