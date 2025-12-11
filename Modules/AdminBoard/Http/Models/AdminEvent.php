<?php

namespace Modules\AdminBoard\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Modules\AdminBoard\Enums\AdminEventStatusEnum;
use Modules\Ecommerce\Http\Models\EcommerceProduct;
use Modules\Ecommerce\Http\Models\PostCustomer;
use Modules\KamrulDashboard\Casts\SafeContent;
use Modules\KamrulDashboard\Http\Models\DboardModel;
use Modules\KamrulDashboard\Http\Models\User;

class AdminEvent extends DboardModel
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'short_description',
        'set_time',
        'admin_types_id',
        'start_date',
        'location',
        'youtube_link',
        'photo',
        'order',
        'slug',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => AdminEventStatusEnum::class,
        'name' => SafeContent::class,
    ];
//    public function getShortDescriptionAttribute($value)
//    {
//        $lang = app()->getLocale();
//        if ($lang !== 'en' && $this->translations->count()) {
//            $translation = $this->translations->where('lang_code', $lang.'_BD')->first();
//            if ($translation && $translation->short_description) {
//                return $translation->short_description;
//            }
//        }
//        return $value;
//    }
    protected static function booted(): void
    {
        static::deleting(function (AdminEvent $adminEvent) {
            $adminEvent->categories()->detach();
            $adminEvent->teams()->detach();
            $adminEvent->metadata()->delete();
        });
    }
    public function registrations()
    {
        return $this->hasMany(PostCustomer::class, 'event_id');
    }

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(EcommerceProduct::class, 'admin_event_related_products', 'event_id', 'product_id');
//            ->where('is_variation', 0);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(AdminCategory::class, 'admin_event_categories', 'event_id', 'category_id');
    }
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(AdminTeam::class, 'admin_event_teams', 'event_id', 'team_id');
    }
    /**
     * @return BelongsToMany
     */
    public function AdminGalleryParameter(): BelongsToMany
    {
        return $this->belongsToMany(AdminGallery::class, 'admin_gallery_parameters', 'reference_id', 'gallery_id')
            ->wherePivot('reference_type', AdminEvent::class);
    }
    public function getFaqItemsAttribute(): array
    {
        $this->loadMissing('metadata');
        $faqs = (array)$this->getMetaData('faq_schema_config', true);
        $faqs = array_filter($faqs);
        if (! empty($faqs)) {
            foreach ($faqs as $key => $item) {
                if (! $item[0]['value'] && ! $item[1]['value']) {
                    Arr::forget($faqs, $key);
                }
            }
        }

        return $faqs;
    }
    public function videoStories()
    {
        return $this->hasMany(AdminEventVideoStory::class, 'admin_event_id');
    }
    public function getCoursesLearnAttribute(): array
    {
        $this->loadMissing('metadata');
        $lessons_videos = (array)$this->getMetaData('courses_learn_schema_config', true);
        $lessons_videos = array_filter($lessons_videos);
        if (! empty($lessons_videos)) {
            foreach ($lessons_videos as $key => $item) {
                if (! $item[0]['value'] && ! $item[1]['value']) {
                    Arr::forget($lessons_videos, $key);
                }
            }
        }

        return $lessons_videos;
    }
    public function active()
    {
        return $this->where('status', 'active');
//        return rtrim(url($this->url), '/') == rtrim(Request::url(), '/');
    }
}
