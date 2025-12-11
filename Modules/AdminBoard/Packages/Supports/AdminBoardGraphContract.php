<?php

namespace Modules\AdminBoard\Packages\Supports;

use Modules\SeoHelper\Contracts\RenderableContract;

interface AdminBoardGraphContract extends RenderableContract
{
    public function setOpenGraph(AdminBoardFullGraphContract $openGraph);
    public function setStartDate(string $date);
    public function getStartDate(): ?string;
    public function setSetTime(string $date);
    public function getSetTime(): ?string;
    public function addProperty(string $key, $value);
    public function getProperty(string $key);
}
