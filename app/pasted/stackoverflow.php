<?php

function tidy_html5($html, array $config = [], $encoding = 'utf8') {
    if (!extension_loaded('tidy')) {
        throw new \Exception("Tidy extension is missing!");
        return;
    }
    $config += [
        'clean'       => TRUE,
        'doctype'     => 'omit',
        'indent'      => 2, // auto
        'output-html' => TRUE,
        'tidy-mark'   => FALSE,
        'wrap'        => 0,
        // HTML5 tags
        'new-blocklevel-tags' => 'article aside audio bdi canvas details dialog figcaption figure footer header hgroup main menu menuitem nav section source summary template track video',
        'new-empty-tags' => 'command embed keygen source track wbr',
        'new-inline-tags' => 'audio command datalist embed keygen mark menuitem meter output progress source time video wbr',
    ];
    $html = tidy_parse_string($html, $config, $encoding);
    tidy_clean_repair($html);
    return '<!DOCTYPE html>' . PHP_EOL . $html;
}