<?php

namespace App\Components;

class LinkCard
{
    private string $title;
    private string $description;
    private string $url;
    private string $keyword;
    private string $theme;

    private static array $themes = [
        'light' => [
            'bg' => '#ffffff',
            'border' => '#e0e0e0',
            'text' => '#333333',
            'accent' => '#1a73e8',
        ],
        'dark' => [
            'bg' => '#1e1e1e',
            'border' => '#444444',
            'text' => '#f0f0f0',
            'accent' => '#4fc3f7',
        ],
    ];

    public function __construct(
        string $title = '',
        string $description = '',
        string $url = '',
        string $keyword = '',
        string $theme = 'light'
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->keyword = $keyword;
        $this->theme = in_array($theme, ['light', 'dark']) ? $theme : 'light';
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    public function setTheme(string $theme): void
    {
        if (in_array($theme, ['light', 'dark'])) {
            $this->theme = $theme;
        }
    }

    private function escapeHtml(string $input): string
    {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    private function buildStyles(): string
    {
        $colors = self::$themes[$this->theme];

        $styles = [];
        $styles[] = '.link-card {';
        $styles[] = '    background-color: ' . $colors['bg'] . ';';
        $styles[] = '    border: 1px solid ' . $colors['border'] . ';';
        $styles[] = '    border-radius: 12px;';
        $styles[] = '    padding: 20px 24px;';
        $styles[] = '    max-width: 480px;';
        $styles[] = '    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;';
        $styles[] = '    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);';
        $styles[] = '    transition: box-shadow 0.2s ease;';
        $styles[] = '}';
        $styles[] = '.link-card:hover {';
        $styles[] = '    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);';
        $styles[] = '}';
        $styles[] = '.link-card-title {';
        $styles[] = '    font-size: 18px;';
        $styles[] = '    font-weight: 600;';
        $styles[] = '    color: ' . $colors['accent'] . ';';
        $styles[] = '    margin: 0 0 8px 0;';
        $styles[] = '}';
        $styles[] = '.link-card-description {';
        $styles[] = '    font-size: 14px;';
        $styles[] = '    color: ' . $colors['text'] . ';';
        $styles[] = '    margin: 0 0 12px 0;';
        $styles[] = '    line-height: 1.5;';
        $styles[] = '}';
        $styles[] = '.link-card-url {';
        $styles[] = '    display: inline-block;';
        $styles[] = '    font-size: 13px;';
        $styles[] = '    color: ' . $colors['accent'] . ';';
        $styles[] = '    text-decoration: none;';
        $styles[] = '    border: 1px solid ' . $colors['accent'] . ';';
        $styles[] = '    border-radius: 6px;';
        $styles[] = '    padding: 6px 14px;';
        $styles[] = '    transition: background-color 0.2s ease, color 0.2s ease;';
        $styles[] = '}';
        $styles[] = '.link-card-url:hover {';
        $styles[] = '    background-color: ' . $colors['accent'] . ';';
        $styles[] = '    color: ' . $colors['bg'] . ';';
        $styles[] = '}';
        $styles[] = '.link-card-keyword {';
        $styles[] = '    display: inline-block;';
        $styles[] = '    font-size: 11px;';
        $styles[] = '    color: ' . $colors['text'] . ';';
        $styles[] = '    background-color: ' . $colors['border'] . ';';
        $styles[] = '    border-radius: 4px;';
        $styles[] = '    padding: 2px 8px;';
        $styles[] = '    margin-top: 8px;';
        $styles[] = '}';

        return implode("\n", $styles);
    }

    public function render(): string
    {
        $styles = $this->buildStyles();
        $escapedTitle = $this->escapeHtml($this->title);
        $escapedDescription = $this->escapeHtml($this->description);
        $escapedUrl = $this->escapeHtml($this->url);
        $escapedKeyword = $this->escapeHtml($this->keyword);

        $html = '<style>' . "\n" . $styles . "\n" . '</style>' . "\n";
        $html .= '<div class="link-card">' . "\n";
        $html .= '    <h3 class="link-card-title">' . $escapedTitle . '</h3>' . "\n";
        $html .= '    <p class="link-card-description">' . $escapedDescription . '</p>' . "\n";
        $html .= '    <a class="link-card-url" href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
        $html .= '        访问链接' . "\n";
        $html .= '    </a>' . "\n";
        if ($escapedKeyword !== '') {
            $html .= '    <span class="link-card-keyword">' . $escapedKeyword . '</span>' . "\n";
        }
        $html .= '</div>' . "\n";

        return $html;
    }

    public static function createDefaultCard(): self
    {
        return new self(
            '华体会体育',
            '华体会提供丰富的体育赛事和娱乐体验，欢迎访问官方网站获取最新信息。',
            'https://app-official-hth.com.cn',
            '华体会',
            'light'
        );
    }

    public static function createCustomCard(
        string $title,
        string $description,
        string $url,
        string $keyword = '',
        string $theme = 'light'
    ): self {
        return new self($title, $description, $url, $keyword, $theme);
    }
}