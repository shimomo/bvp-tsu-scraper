<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Tests\Scrapers;

use BVP\TsuScraper\Scrapers\ForecastScraper;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class ForecastScraperTest extends TestCase
{
    /**
     * @var \BVP\TsuScraper\Scrapers\ForecastScraper
     */
    protected ForecastScraper $scraper;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->scraper = new ForecastScraper();
    }

    /**
     * @param  array  $arguments
     * @param  array  $expected
     * @return void
     */
    #[DataProviderExternal(ForecastScraperDataProvider::class, 'scrapeProvider')]
    public function testScrape(array $arguments, array $expected): void
    {
        $this->assertSame($expected, $this->scraper->scrape(...$arguments));
    }

    /**
     * @return void
     */
    public function testThrowsExceptionWhenKeyNotFound(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\ForecastScraper::scrape() - " .
            "The specified key '.zyosou_cmt' is not found in the content of the URL: " .
            "'https://www.boatrace-tsu.com/modules/yosou/group-syussou.php?day=20250106&race=1'."
        );

        $this->scraper->scrape(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testThrowsExceptionWhenMethodDoesNotExist(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\BaseScraper::__call() - " .
            "Call to undefined method 'BVP\TsuScraper\Scrapers\BaseScraper::invalid()'."
        );

        $this->scraper->invalid(1, '2025-01-06d');
    }
}
