<?php

declare(strict_types=1);

namespace BVP\TsuScraper\Tests;

/**
 * @author shimomo
 */
final class ScraperCoreDataProvider
{
    /**
     * @return array
     */
    public static function scrapeForecastsProvider(): array
    {
        return [
            [
                'arguments' => [1, '2025-01-01'],
                'expected' => [
                    'reporter_yesterday_comment_label' => '記者予想 前日コメント',
                    'reporter_yesterday_comment' => '一柳がツッキーレースの1号艇で登場。エンジンはまだ不透明だが、ズリ下がったりはしていない。インを生かす。谷本が2コースから追撃を開始する。酒井がカドでスタート決めて。',
                    'reporter_yesterday_course_label' => '記者予想 前日コース',
                    'reporter_yesterday_course' => '123/456',
                    'reporter_yesterday_focus_label' => '記者予想 前日フォーカス',
                    'reporter_yesterday_focus' => [],
                    'reporter_yesterday_focus_exacta_label' => '記者予想 前日フォーカス 2連単',
                    'reporter_yesterday_focus_exacta' => [],
                    'reporter_yesterday_focus_trifecta_label' => '記者予想 前日フォーカス 3連単',
                    'reporter_yesterday_focus_trifecta' => [],
                    'reporter_today_comment_label' => '記者予想 当日コメント',
                    'reporter_today_comment' => 'あけましておめでとうございます!2025年のボートレース津、まずはツッキーレース。展示気配は1号艇の一柳がなかなかよかった。周回展示のターン気配もいいので逃げそうだ。',
                    'reporter_today_course_label' => '記者予想 当日コース',
                    'reporter_today_course' => '',
                    'reporter_today_focus_label' => '記者予想 当日フォーカス',
                    'reporter_today_focus' => ['1-4=2', '1-4=3'],
                    'reporter_today_focus_exacta_label' => '記者予想 当日フォーカス 2連単',
                    'reporter_today_focus_exacta' => [],
                    'reporter_today_focus_trifecta_label' => '記者予想 当日フォーカス 3連単',
                    'reporter_today_focus_trifecta' => ['1-4=2', '1-4=3'],
                ],
            ],
            [
                'arguments' => [4, '2025-01-01'],
                'expected' => [
                    'reporter_yesterday_comment_label' => '記者予想 前日コメント',
                    'reporter_yesterday_comment' => '新田が切れのあるハンドルさばきを披露するか。伸びていく訳じゃないが、ターン回りはゾーンに入れてきた。中山は高野のピット離れがよくないのでここイン奪取も見込める。',
                    'reporter_yesterday_course_label' => '記者予想 前日コース',
                    'reporter_yesterday_course' => '123/465',
                    'reporter_yesterday_focus_label' => '記者予想 前日フォーカス',
                    'reporter_yesterday_focus' => [],
                    'reporter_yesterday_focus_exacta_label' => '記者予想 前日フォーカス 2連単',
                    'reporter_yesterday_focus_exacta' => [],
                    'reporter_yesterday_focus_trifecta_label' => '記者予想 前日フォーカス 3連単',
                    'reporter_yesterday_focus_trifecta' => [],
                    'reporter_today_comment_label' => '記者予想 当日コメント',
                    'reporter_today_comment' => 'このレースも1236ダッシュ45か。最初はカドの石塚がいったが、となりの新田がすぐ追いついていた。さっきのレースだと平田が攻めて行ったがどうなるか…。伸びはそこまで変わらない感じがした。',
                    'reporter_today_course_label' => '記者予想 当日コース',
                    'reporter_today_course' => '',
                    'reporter_today_focus_label' => '記者予想 当日フォーカス',
                    'reporter_today_focus' => ['6=2-3', '6-3=4'],
                    'reporter_today_focus_exacta_label' => '記者予想 当日フォーカス 2連単',
                    'reporter_today_focus_exacta' => [],
                    'reporter_today_focus_trifecta_label' => '記者予想 当日フォーカス 3連単',
                    'reporter_today_focus_trifecta' => ['6=2-3', '6-3=4'],
                ],
            ],
        ];
    }
}
