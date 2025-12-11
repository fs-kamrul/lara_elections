<?php

namespace Modules\Icon\View\Components;

use Modules\Icon\Packages\Facades\Icon as IconFacade;
use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Icon extends Component
{
    public $name;
    public $size;

    public function __construct(string $name, ?string $size = null)
    {
        $this->name = $name;
        $this->size = $size;
    }

    public function render(): Closure
    {
        return function (array $data) {
            $attributes = $data['attributes']->getIterator()->getArrayCopy();
            $class = trim(sprintf('%s %s', $this->size ? "icon-{$this->size}" : '', $attributes['class'] ?? ''));

            unset($attributes['class']);

            if (str_starts_with($this->name, 'ti ti-')) {
                return IconFacade::render(
                    Str::after($this->name, '-'),
                    array_merge(['class' => $class], $attributes)
//                    ['class' => $class, ...$attributes]
                );
            }

            return sprintf('<i %s></i>', $data['attributes']->class(trim("$this->name $class")));
        };
    }
}
