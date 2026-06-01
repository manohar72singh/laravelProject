<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\App as GameApp;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;

class ScrapeYonoApps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrapes and imports games from allnewyonoapps.com';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching HTML from allnewyonoapps.com...');
        
        $htmlFile = storage_path('app/allnewyonoapps.html');
        if (file_exists($htmlFile)) {
            $html = file_get_contents($htmlFile);
        } else {
            // Fetch HTML
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://allnewyonoapps.com/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
            $html = curl_exec($ch);
            curl_close($ch);
        }

        if (!$html) {
            $this->error('Failed to fetch the website.');
            return;
        }

        $this->info('Extracting JSON-LD descriptions...');
        $descriptions = [];
        if (preg_match('/<script type="application\/ld\+json">\s*({.*?"@type":\s*"ItemList".*?})\s*<\/script>/s', $html, $matches)) {
            $jsonLd = json_decode($matches[1], true);
            if (isset($jsonLd['itemListElement'])) {
                foreach ($jsonLd['itemListElement'] as $item) {
                    $name = trim($item['name'] ?? '');
                    if ($name) {
                        $descriptions[$name] = $item['description'] ?? '';
                    }
                }
            }
        }

        $this->info('Parsing HTML DOM...');
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();
        
        $xpath = new DOMXPath($dom);
        $cards = $xpath->query('//*[contains(@class, "game-card")]');

        if ($cards->length === 0) {
            $this->error('No games found in the HTML structure.');
            return;
        }

        $this->info('Truncating apps table...');
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Review::truncate();
        GameApp::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $count = 0;
        foreach ($cards as $card) {
            $nameNode = $xpath->query('.//*[contains(@class, "game-name")]', $card)->item(0);
            $name = $nameNode ? trim($nameNode->nodeValue) : '';

            if (!$name) continue;

            $iconNode = $xpath->query('.//*[contains(@class, "game-icon")]//img', $card)->item(0);
            $icon = $iconNode ? $iconNode->getAttribute('src') : null;
            if ($icon && !str_starts_with($icon, 'http')) {
                $icon = rtrim('https://allnewyonoapps.com', '/') . '/' . ltrim($icon, '/');
            }

            $downloadNode = $xpath->query('.//a[contains(@class, "download-btn")]', $card)->item(0);
            $download = $downloadNode ? $downloadNode->getAttribute('href') : '#';

            $bonusNode = $xpath->query('.//*[contains(@class, "bonus-info")]', $card)->item(0);
            $bonusText = $bonusNode ? trim($bonusNode->nodeValue) : '₹0';
            $bonusText = trim(str_replace('Bonus:', '', $bonusText));

            $desc = $descriptions[$name] ?? '';
            if (!$desc) {
                foreach ($descriptions as $dName => $dText) {
                    if (stripos($name, $dName) !== false || stripos($dName, $name) !== false) {
                        $desc = $dText;
                        break;
                    }
                }
            }

            GameApp::create([
                'name' => $name,
                'slug' => Str::slug($name) . '-' . uniqid(),
                'icon_url' => $icon,
                'download_url' => $download,
                'bonus_amount' => $bonusText,
                'intro_text' => $desc,
                'about_text' => $desc,
                'is_new' => true,
            ]);

            $count++;
        }

        $this->info("Successfully imported $count games!");
    }
}
