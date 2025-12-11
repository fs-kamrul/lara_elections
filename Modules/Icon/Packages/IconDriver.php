<?php

namespace Modules\Icon\Packages;

abstract class IconDriver
{
    protected $config = [];

    protected $iconPath;

    public function setConfig(array $config)
    {
        $this->config = $config;

        return $this;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    abstract public function all(): array;

    abstract public function render(string $name, array $attributes = []): string;

    abstract public function has(string $name): bool;

    public function setIconPath(string $path)
    {
        $this->iconPath = $path;

        return $this;
    }

    public function iconPath(): string
    {
        return $this->iconPath;
    }

    protected function parseAttributesToHtml(array $attributes): string
    {
        $attributes = $this->formatAttributes($attributes);

        return collect($attributes)
            ->map(function (?string $value, $key) {
                if (is_int($key)) {
                    return $value;
                }

                return sprintf('%s="%s"', $key, e($value));
            })
            ->implode(' ');
    }

    protected function formatAttributes(array $attributes = []): array
    {
        $attributes['class'] = $this->mergeClassNameAttribute(
            $attributes['class'] ?? ''
        );
        $defaultAttributes = $this->config['attributes'] ?? [];
//        $attributes = [...$defaultAttributes, ...$attributes];
        $attributes = array_merge($defaultAttributes, $attributes);

        foreach ($attributes as $key => $value) {
            if (is_string($value)) {
                $attributes[$key] = str_replace('"', '&quot;', $value);
            }
        }

        return $attributes;
    }

    protected function mergeClassNameAttribute(string $className = ''): string
    {
        return trim(sprintf('%s %s', $this->config['className'] ?? '', $className));
    }
}
