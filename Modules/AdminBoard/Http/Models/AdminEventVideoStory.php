<?php

namespace Modules\AdminBoard\Http\Models;

use Modules\Ecommerce\Http\Models\EcommerceProduct;
use Modules\KamrulDashboard\Http\Models\DboardModel;

class AdminEventVideoStory extends DboardModel
{

    protected $table = 'admin_event_video_stories';

    protected $fillable = [
        'admin_event_id',
        'youtube_url',
        'thumbnail_image',
        'text_story',
        'user_name',
        'user_designation',
        'user_image',
    ];

    public function adminEvent()
    {
        return $this->belongsTo(AdminEvent::class, 'admin_event_id');
    }
}
