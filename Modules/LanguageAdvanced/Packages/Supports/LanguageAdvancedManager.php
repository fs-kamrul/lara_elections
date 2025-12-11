<?php

namespace Modules\LanguageAdvanced\Packages\Supports;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Language;
use Modules\KamrulDashboard\Http\Models\DboardModel;
use Modules\KamrulDashboard\Packages\Supports\MacroableModels;
use Modules\LanguageAdvanced\Http\Models\PageTranslation;
use Modules\LanguageAdvanced\Http\Models\PostTranslation;
use Modules\LanguageAdvanced\Http\Models\TranslationResolver;
use Modules\Post\Http\Models\Page;
use Modules\Post\Http\Models\Post;

class LanguageAdvancedManager
{
    /**
     * @param DboardModel|\stdClass $object
     * @param Request $request
     * @return bool
     */
    public static function save($object, $request): bool
    {
        if (!self::isSupported($object)) {
            return false;
        }

        $language = $request->input('language');
        if (! $language) {
            $language = Language::getCurrentAdminLocaleCode();
        }
        $condition = [
            'lang_code'                 => $language,
            $object->getTable() . '_id' => $object->id,
        ];

        $table = $object->getTable() . '_translations';

        $data = [];
        foreach (DB::getSchemaBuilder()->getColumnListing($table) as $column) {
            if (!in_array($column, array_keys($condition))) {
                $data[$column] = $request->input($column);
            }
        }

        $data = array_merge($data, $condition);

        $translate = DB::table($table)->where($condition)->first();

        if ($translate) {
            DB::table($table)->where($condition)->update($data);
        } else {
            DB::table($table)->insert($data);
        }
        $defaultLocale = Language::getDefaultLocaleCode();
        if ($language != $defaultLocale) {
            $defaultTranslation = DB::table($table)
                ->where([
                    'lang_code'                 => $defaultLocale,
                    $object->getTable() . '_id' => $object->id,
                ])
                ->first();

            if ($defaultTranslation) {
                foreach (DB::getSchemaBuilder()->getColumnListing($table) as $column) {
                    if (!in_array($column, array_keys($condition))) {
                        $object->{$column} = $defaultTranslation->{$column};
                    }
                }

                $object->save();
            }
        }

        return true;
    }

    /**
     * @param string|DboardModel $model
     * @return bool
     */
    public static function isSupported($model): bool
    {
        if (!$model) {
            return false;
        }

        if (is_object($model)) {
            $model = get_class($model);
        }

        return in_array($model, self::supportedModels());
    }

    /**
     * @return int[]|string[]
     */
    public static function supportedModels(): array
    {
        return array_keys(self::getSupported());
    }

    /**
     * @return array
     */
    public static function getSupported(): array
    {
        return config('languageadvanced.supported', []);
    }

    /**
     * @return array
     */
    public static function getConfigs(): array
    {
        return config('languageadvanced', []);
    }

    /**
     * @param string|DboardModel $model
     * @return array
     */
    public static function getTranslatableColumns($model)
    {
        if (!$model) {
            return [];
        }

        if (is_object($model)) {
            $model = get_class($model);
        }

        return Arr::get(self::getSupported(), $model, []);
    }

    /**
     * @param string|DboardModel $model
     * @return ?string
     */
    public static function getTranslationModel($model): ?string
    {
        if (!$model) {
            return null;
        }

        if (is_object($model)) {
            $model = get_class($model);
        }

        if ($model == Page::class) {
            return PageTranslation::class;
        }
//        if ($model == Post::class) {
//            return PostTranslation::class;
//        }

        return $model . 'Translation';
    }

    /**
     * @param string $model
     * @return bool
     */
    public static function registerModule(string $model, array $columns): bool
    {
        config([
            'languageadvanced.supported' => array_merge(self::getSupported(), [$model => $columns]),
        ]);

        return true;
    }

    /**
     * @param DboardModel|\stdClass $object
     * @return bool
     */
    public static function delete($object): bool
    {
        if (!self::isSupported($object)) {
            return false;
        }

        $table = $object->getTable() . '_translations';

        DB::table($table)->where([$object->getTable() . '_id' => $object->id])->delete();

        return true;
    }

    /**
     * @param string $metaBoxKey
     * @return bool
     */
    public static function isTranslatableMetaBox(string $metaBoxKey): bool
    {
        return in_array($metaBoxKey, Arr::get(self::getConfigs(), 'translatable_meta_boxes', []));
    }

    /**
     * @param string $model
     * @return bool
     */
    public static function addTranslatableMetaBox(string $metaBoxKey): bool
    {
        $metaBoxes = array_merge(Arr::get(self::getConfigs(), 'translatable_meta_boxes', []), [$metaBoxKey]);

        config(['languageadvanced.translatable_meta_boxes' => $metaBoxes]);

        return true;
    }

    public static function initModelRelations(): void
    {
        $locale = is_in_admin() ? Language::getCurrentAdminLocaleCode() : Language::getCurrentLocaleCode();

        $isDefaultLocale = $locale == Language::getDefaultLocaleCode();

        foreach (self::getSupported() as $item => $columns) {
            if (! class_exists($item)) {
                continue;
            }
            /**
             * @var Model $item
             */
            $item::resolveRelationUsing('translations', function ($model) use ($locale) {
                $instance = tap(
                    new TranslationResolver(),
                    function ($instance) {
                        if (! $instance->getConnectionName()) {
                            $instance->setConnection(DB::getDefaultConnection());
                        }
                    }
                );

                $modelTable = $model->getTable();

                $instance->setTable($modelTable . '_translations');

                $instance->fillable(array_merge([
                    'lang_code',
                    $modelTable . '_id',
                ], self::getTranslatableColumns($model::class)));

                return new HasMany(
                    $instance->newQuery(),
                    $model,
                    $modelTable . '_translations.' . $modelTable . '_id',
                    $model->getKeyName()
                );
            });

            foreach ($columns as $column) {
                MacroableModels::addMacro(
                    $item,
                    'get' . ucfirst(Str::camel($column)) . 'Attribute',
                    function () use ($column, $locale, $isDefaultLocale) {
                        if (
                            ! $this->lang_code && // @phpstan-ignore-line
                            ! $isDefaultLocale &&
                            $translation = $this->translations->where('lang_code', $locale)->value($column) // @phpstan-ignore-line
                        ) {
                            return $translation;
                        }

                        // @phpstan-ignore-next-line
                        return $this->getAttribute($column);
                    }
                );
            }
        }
    }
}
