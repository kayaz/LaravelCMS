<?php

namespace App\Providers;

use Illuminate\Support\Arr;

class MetaTag
{
    /**
     * @var array
     */
    private $metas = [];

    public function __construct(){}

    /**
     * @param  string $key
     * @return string
     */
    public function get($key)
    {
        $tag = Arr::get($this->metas, $key);
        return $tag ? $tag : null;
    }

    /**
     * @param  string $key
     * @param  string $value
     * @return string
     */
    public function set($key, $value = null)
    {
        $value = $this->fix($value);

        $method = 'set'.$key;

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return $this->metas[$key] = $value;
    }

    /**
     * Create a tag based on the given key
     *
     * @param  string $key
     * @param  string $value
     * @return string
     */
    public function tag($key, $value = null)
    {
        return $this->createTag([
            'name' => $key,
            'property' => $key,
            'content' => $value ?: Arr::get($this->metas, $key),
        ]);
    }

    /**
     * Create meta tag from attributes
     *
     * @param  array $values
     * @return string
     */
    private function createTag(array $values)
    {
        $attributes = array_map(function($key) use ($values) {
            $value = $this->fix($values[$key]);
            return "{$key}=\"{$value}\"";
        }, array_keys($values));

        $attributes = implode(' ', $attributes);

        return "<meta {$attributes}>\n    ";
    }

    /**
     * @param  string $text
     * @return string
     */
    private function fix($text)
    {
        $text = preg_replace('/<[^>]+>/', ' ', $text);
        $text = preg_replace('/[\r\n\s]+/', ' ', $text);

        return trim(str_replace('"', '&quot;', $text));
    }
}
