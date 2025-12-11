<?php

namespace Modules\Post\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\KamrulDashboard\Http\Models\DboardModel;

class PostCategory extends DboardModel
{
    use HasFactory;
    protected $guarded = [];

    public function active()
    {
        return $this->where('status', 1);
//        return rtrim(url($this->url), '/') == rtrim(Request::url(), '/');
    }
}
