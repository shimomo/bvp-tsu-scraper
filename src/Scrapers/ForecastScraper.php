<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Scrapers;

use BVP\ScraperCore\Normalizer;
use BVP\ScraperCore\Scraper;
use Carbon\CarbonImmutable as Carbon;
use Carbon\CarbonInterface;

/**
 * @author shimomo
 */
class ForecastScraper extends BaseScraper
{
    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    public function scrape(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        return array_merge(...[
            $this->scrapeYesterday($raceNumber, $raceDate),
            $this->scrapeToday($raceNumber, $raceDate),
        ]);
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     *
     * @throws \RuntimeException
     */
    private function scrapeYesterday(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        $raceDate = Carbon::parse($raceDate ?? 'today')->format('Ymd');
        $crawlerUrl = sprintf($this->baseUrl, 'group-syussou', $raceDate, $raceNumber);
        $crawler = Scraper::getInstance()->request('GET', $crawlerUrl);
        $forecasts = Scraper::filterByKeys($crawler, [
            '.zyosou_cmt',
        ]);

        foreach ($forecasts as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    __METHOD__ . "() - The specified key '{$key}' is not found " .
                    "in the content of the URL: '{$crawlerUrl}'."
                );
            }
        }

        $reporterYesterdayCommentLabel = '記者予想 前日コメント';
        $reporterYesterdayCourseLabel = '記者予想 前日コース';
        $reporterYesterdayFocusLabel = '記者予想 前日フォーカス';
        $reporterYesterdayFocusExactaLabel = '記者予想 前日フォーカス 2連単';
        $reporterYesterdayFocusTrifectaLabel = '記者予想 前日フォーカス 3連単';

        $reporterYesterdayComment = Normalizer::normalize($forecasts['.zyosou_cmt'][0]);
        $reporterYesterdayCourse = '';
        $crawler->filter('.sinnyu_list > li')->each(function ($node) use (&$reporterYesterdayCourse) {
            if (preg_match('/sinnyu_li_([sd])/u', $node->attr('class'), $matches1)) {
                if (preg_match('/img_boat-0([1-6]).png/u', $node->filter('img')->attr('src'), $matches2)) {
                    if ($matches1[1] === 'd' && !str_contains($reporterYesterdayCourse, '/')) {
                        $reporterYesterdayCourse .= '/';
                    }
                    $reporterYesterdayCourse .= Normalizer::normalize($matches2[1]);
                }
            }
        });
        $reporterYesterdayFocus = [];
        $reporterYesterdayFocusExacta = [];
        $reporterYesterdayFocusTrifecta = [];

        return [
            'reporter_yesterday_comment_label' => $reporterYesterdayCommentLabel,
            'reporter_yesterday_comment' => $reporterYesterdayComment,
            'reporter_yesterday_course_label' => $reporterYesterdayCourseLabel,
            'reporter_yesterday_course' => $reporterYesterdayCourse,
            'reporter_yesterday_focus_label' => $reporterYesterdayFocusLabel,
            'reporter_yesterday_focus' => $reporterYesterdayFocus,
            'reporter_yesterday_focus_exacta_label' => $reporterYesterdayFocusExactaLabel,
            'reporter_yesterday_focus_exacta' => $reporterYesterdayFocusExacta,
            'reporter_yesterday_focus_trifecta_label' => $reporterYesterdayFocusTrifectaLabel,
            'reporter_yesterday_focus_trifecta' => $reporterYesterdayFocusTrifecta,
        ];
    }

    /**
     * @param  string|int                           $raceNumber
     * @param  \Carbon\CarbonInterface|string|null  $raceDate
     * @return array
     */
    private function scrapeToday(string|int $raceNumber, CarbonInterface|string|null $raceDate = null): array
    {
        $raceDate = Carbon::parse($raceDate ?? 'today')->format('Ymd');
        $crawlerUrl = sprintf($this->baseUrl, 'cyokuzen', $raceDate, $raceNumber);
        $crawler = Scraper::getInstance()->request('GET', $crawlerUrl);
        $forecasts = Scraper::filterByKeys($crawler, [
            '.cyosou_cmt',
            '.par-icon_wrap',
        ]);

        foreach ($forecasts as $key => $value) {
            if (empty($value)) {
                throw new \RuntimeException(
                    __METHOD__ . "() - The specified key '{$key}' is not found " .
                    "in the content of the URL: '{$crawlerUrl}'."
                );
            }
        }

        $reporterTodayCommentLabel = '記者予想 当日コメント';
        $reporterTodayCourseLabel = '記者予想 当日コース';
        $reporterTodayFocusLabel = '記者予想 当日フォーカス';
        $reporterTodayFocusExactaLabel = '記者予想 当日フォーカス 2連単';
        $reporterTodayFocusTrifectaLabel = '記者予想 当日フォーカス 3連単';

        $reporterTodayComment = Normalizer::normalize($forecasts['.cyosou_cmt'][0]);
        $reporterTodayCourse = '';
        $reporterTodayFocus = Normalizer::normalize($forecasts['.par-icon_wrap']);
        $reporterTodayFocusExacta = array_values(array_filter($reporterTodayFocus, function ($focus) {
            return (substr_count($focus, '-') + substr_count($focus, '=')) === 1;
        }));
        $reporterTodayFocusTrifecta = array_values(array_filter($reporterTodayFocus, function ($focus) {
            return (substr_count($focus, '-') + substr_count($focus, '=')) === 2 || str_contains($focus, 'BOX');
        }));

        return [
            'reporter_today_comment_label' => $reporterTodayCommentLabel,
            'reporter_today_comment' => $reporterTodayComment,
            'reporter_today_course_label' => $reporterTodayCourseLabel,
            'reporter_today_course' => $reporterTodayCourse,
            'reporter_today_focus_label' => $reporterTodayFocusLabel,
            'reporter_today_focus' => $reporterTodayFocus,
            'reporter_today_focus_exacta_label' => $reporterTodayFocusExactaLabel,
            'reporter_today_focus_exacta' => $reporterTodayFocusExacta,
            'reporter_today_focus_trifecta_label' => $reporterTodayFocusTrifectaLabel,
            'reporter_today_focus_trifecta' => $reporterTodayFocusTrifecta,
        ];
    }
}
