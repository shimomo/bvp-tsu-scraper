<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Tests;

use BVP\TsuScraper\Scraper;
use BVP\TsuScraper\ScraperInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class ScraperTest extends TestCase
{
    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ScraperCoreDataProvider::class, 'scrapeForecastsProvider')]
    public function testScrapeForecasts(array $arguments, array $expected): void
    {
        $this->assertSame($expected, Scraper::scrapeForecasts(...$arguments));
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

        Scraper::scrapeComments(1, '2025-01-06');
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

        Scraper::scrapeTimes(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testScrapeWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\ForecastScraper::scrape() - " .
            "The specified key '.zyosou_cmt' is not found in the content of the URL: " .
            "'https://www.boatrace-tsu.com/modules/yosou/group-syussou.php?day=20250106&race=1'."
        );

        Scraper::scrapeForecasts(1, '2025-01-06');
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

        Scraper::invalid(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testGetInstance(): void
    {
        Scraper::resetInstance();
        $this->assertInstanceOf(ScraperInterface::class, Scraper::getInstance());
    }

    /**
     * @return void
     */
    public function testCreateInstance(): void
    {
        Scraper::resetInstance();
        $this->assertInstanceOf(ScraperInterface::class, Scraper::createInstance());
    }

    /**
     * @return void
     */
    public function testResetInstance(): void
    {
        Scraper::resetInstance();
        $instance1 = Scraper::getInstance();
        Scraper::resetInstance();
        $instance2 = Scraper::getInstance();
        $this->assertNotSame($instance1, $instance2);
    }
}
