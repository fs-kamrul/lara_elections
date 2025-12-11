<?php

namespace Modules\AdminBoard\Packages\Supports;

use Modules\SeoHelper\Contracts\RenderableContract;

interface AdminBoardFullGraphContract extends RenderableContract
{
    public function setStartDate(string $date);
    public function getStartDate(): ?string;
    public function setSetTime(string $time);
    public function getSetTime(): ?string;
    public function addProperty(string $key, $value);
    public function getProperty(string $key);
}
