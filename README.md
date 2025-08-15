# BVP Tsu Scraper

[![tests](https://github.com/shimomo/bvp-tsu-scraper/actions/workflows/tests.yml/badge.svg)](https://github.com/shimomo/bvp-tsu-scraper/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/shimomo/bvp-tsu-scraper/graph/badge.svg?token=1AC3RA42BF)](https://codecov.io/gh/shimomo/bvp-tsu-scraper)
[![php](https://poser.pugx.org/bvp/tsu-scraper/require/php)](https://packagist.org/packages/bvp/tsu-scraper)
[![stable](https://poser.pugx.org/bvp/tsu-scraper/v/stable)](https://packagist.org/packages/bvp/tsu-scraper)
[![unstable](https://poser.pugx.org/bvp/tsu-scraper/v/unstable)](https://packagist.org/packages/bvp/tsu-scraper#5.x-dev)
[![license](https://poser.pugx.org/bvp/tsu-scraper/license)](https://packagist.org/packages/bvp/tsu-scraper)

BVP Tsu Scraper は、ボートレース津の公式サイトから記者予想をスクレイピングして取得できる PHP ライブラリです。

## 📦 Requirements
- PHP ^8.2
- Composer
- Carbon

## 💾 Installation
```bash
composer require bvp/tsu-scraper
```

## ⚡ Usage

### サポートメソッド一覧

| メソッド | 説明 | 引数 |
|---|---|---|
| `Scraper::scrapeForecasts($raceNumber, $raceDate = null)` | 記者予想を取得 | `$raceNumber` : 1〜12<br>`$raceDate` : Carbon対応日付文字列またはCarbonインスタンス（省略時は当日） |

**$raceDate の例**
- `'2025-01-01'`
- `'2025/01/01'`
- `'yesterday'`
- `Carbon::now()->subDay()`

### 基本的な使い方

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BVP\TsuScraper\Scraper;

// 記者予想を取得
$forecasts = Scraper::scrapeForecasts(1, '2025-01-01');

print_r($forecasts);
```

### Scraper::scrapeForecasts()

```php
// 例: ボートレース津の公式サイトから2025年01月01日の1レースの記者予想を取得
$forecasts = Scraper::scrapeForecasts(1, '2025-01-01');
print_r($forecasts);
```

<details>
<summary>取得結果</summary>

```php
Array
(
    [reporter_yesterday_comment_label] => 記者予想 前日コメント
    [reporter_yesterday_comment] => 一柳がツッキーレースの1号艇で登場。エンジンはまだ不透明だが、ズリ下がったりはしていない。インを生かす。谷本が2コースから追撃を開始する。酒井がカドでスタート決めて。
    [reporter_yesterday_course_label] => 記者予想 前日コース
    [reporter_yesterday_course] => 123/456
    [reporter_yesterday_focus_label] => 記者予想 前日フォーカス
    [reporter_yesterday_focus] => Array
        (
        )

    [reporter_yesterday_focus_exacta_label] => 記者予想 前日フォーカス 2連単
    [reporter_yesterday_focus_exacta] => Array
        (
        )

    [reporter_yesterday_focus_trifecta_label] => 記者予想 前日フォーカス 3連単
    [reporter_yesterday_focus_trifecta] => Array
        (
        )

    [reporter_today_comment_label] => 記者予想 当日コメント
    [reporter_today_comment] => あけましておめでとうございます!2025年のボートレース津、まずはツッキーレース。展示気配は1号艇の一柳がなかなかよかった。周回展示のターン気配もいいので逃げそうだ。
    [reporter_today_course_label] => 記者予想 当日コース
    [reporter_today_course] =>
    [reporter_today_focus_label] => 記者予想 当日フォーカス
    [reporter_today_focus] => Array
        (
            [0] => 1-4=2
            [1] => 1-4=3
        )

    [reporter_today_focus_exacta_label] => 記者予想 当日フォーカス 2連単
    [reporter_today_focus_exacta] => Array
        (
        )

    [reporter_today_focus_trifecta_label] => 記者予想 当日フォーカス 3連単
    [reporter_today_focus_trifecta] => Array
        (
            [0] => 1-4=2
            [1] => 1-4=3
        )

)
```

</details>

## ⚠️ Notes
- **スクレイピング対象の公式サイトの構造が変更された場合**、正しくデータを取得できなくなる可能性があります。
- 利用時は対象サイトの利用規約を遵守してください。

## 📄 License
BVP Tsu Scraper は [MIT license](LICENSE) の元で公開されています。
