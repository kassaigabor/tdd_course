<?php

namespace MarkDownConverter\Parser;

/**
 * Class Parser
 * @package MarkDownConverter\Parser
 */
class Parser
{
    /**
     * @param $content
     * @return mixed
     */
    public function parse($content)
    {
        $content = $this->parseImg($content);
        $content = $this->parseHref($content);

        $content = $this->parseBold($content);
        $content = $this->parsePre($content);
        $content = $this->parseItalic($content);

        return $content;
    }

    /**
     * @param $content
     * @return mixed
     */
    protected function parseBold($content)
    {
        $pattern = '/(^|\s|>|\b)[*]{2}(?=\S)([\s\S]+?)[*]{2}(?=\b|<|\s|$)/';
        $replacement = '$1<strong>$2</strong>';
        return preg_replace($pattern, $replacement, $content);
    }

    /**
     * @param $content
     * @return mixed
     */
    protected function parsePre($content)
    {
        $pattern = '/(^|\s|>|\b)`(?=\S)([\s\S]+?)`(?=\b|<|\s|$)/';
        $replacement = '$1<pre>$2</pre>';
        return preg_replace($pattern, $replacement, $content);
    }

    /**
     * @param $content
     * @return mixed
     */
    protected function parseItalic($content)
    {
        $pattern = '/(^|\s|>|\b)_(?=\S)([\s\S]+?)_(?=\b|<|\s|$)/';
        $replacement = '$1<i>$2</i>';
        return preg_replace($pattern, $replacement, $content);
    }

    /**
     * @param $content
     * @return mixed
     */
    protected function parseHref($content)
    {
        $pattern = '/\[(.*)\]\((.*)\)/U';
        $replacement = '<a href="$1">$2</a>';
        return preg_replace($pattern, $replacement, $content);
    }

    /**
     * @param $content
     * @return mixed
     */
    protected function parseImg($content)
    {
        $pattern = '/!\[(.*)\]\((.*)\)/U';
        $replacement = '<img src="$1" alt="$2" />';
        return preg_replace($pattern, $replacement, $content);
    }
}