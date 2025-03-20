<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Tests\Scrapers;

use BVP\TsuScraper\Scrapers\CommentScraper;
use PHPUnit\Framework\TestCase;

/**
 * @author shimomo
 */
final class CommentScraperTest extends TestCase
{
    /**
     * @var \BVP\TsuScraper\Scrapers\CommentScraper
     */
    protected CommentScraper $scraper;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->scraper = new CommentScraper();
    }

    /**
     * @return void
     */
    public function testScrapeWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\CommentScraper::scrape() - " .
            "The 'scrape' feature is currently not implemented."
        );

        $this->scraper->scrape(1, '2025-01-06');
    }

    /**
     * @return void
     */
    public function testInvalidWithRaceCode1AndDate20250106(): void
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(
            "BVP\TsuScraper\Scrapers\BaseScraper::__call() - " .
            "Call to undefined method 'BVP\TsuScraper\Scrapers\BaseScraper::invalid()'."
        );

        $this->scraper->invalid(1, '2025-01-06');
    }
}
