<?php

namespace Modules\KamrulDashboard\Http\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\KamrulDashboard\Packages\Supports\DboardStatus;

class DboardQueryBuilder extends Builder
{
    /**
     * @param string $column
     * @param string|null $term
     * @return DboardQueryBuilder
     */
    public function addSearch(string $column, ?string $term, bool $isPartial = true, bool $or = true)
    {
        $term = trim($term);
        $term = str_replace('&', '&amp;', $term);

        if (! $isPartial) {
            $this->{$or ? 'orWhere' : 'where'}($column, 'LIKE', '%' . $term . '%');

            return $this;
        }

        $searchTerms = explode(' ', $term);

        $sql = 'LOWER(' . $this->getGrammar()->wrap($column) . ') LIKE ? ESCAPE ?';

        $getBackslashByPdo = DB::getDefaultConnection() === 'sqlite' ? '\\\\' : '\\\\\\';

        foreach ($searchTerms as $searchTerm) {
            $searchTerm = mb_strtolower($searchTerm, 'UTF8');
            $searchTerm = str_replace('\\', $getBackslashByPdo, $searchTerm);
            $searchTerm = addcslashes($searchTerm, '%_');

            $this->orWhereRaw($sql, ['%' . $searchTerm . '%', '\\']);
        }

        return $this;
    }

    public function wherePublished($column = 'status')
    {
        $this->where($column, DboardStatus::PUBLISHED);

        return $this;
    }

    public function get($columns = ['*'])
    {
        return apply_filters('model_after_execute_get', parent::get($columns), $this->getModel(), $columns);
    }
    /**
     * @return string
     */
    protected function getBackslashByPdo()
    {
        if (config('database.default') === 'sqlite') {
            return '\\\\';
        }

        return '\\\\\\';
    }
}
