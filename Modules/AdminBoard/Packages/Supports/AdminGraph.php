<?php

namespace Modules\AdminBoard\Packages\Supports;

use Carbon\Carbon;

class AdminGraph implements AdminBoardFullGraphContract
{
    /**
     * Holds data-like data.
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Set start date (store it like data info).
     *
     * @param string $date
     * @return $this
     */
    public function setStartDate(string $date)
    {
        $this->data['start_date'] = $date;
        return $this;
    }

    /**
     * Get start date.
     *
     * @return string|null
     */
    public function getStartDate(): ?string
    {
//        return $this->data['start_date'] ?? null;
        if (empty($this->data['start_date'])) {
            return null;
        }

        // Parse and format the date
        return Carbon::parse($this->data['start_date'])->format('F d, Y');
    }
    /**
     * Set start date (store it like data info).
     *
     * @param string $date
     * @return $this
     */
    public function setSetTime(string $date)
    {
        $this->data['set_time'] = $date;
        return $this;
    }

    /**
     * Get start date.
     *
     * @return string|null
     */
    public function getSetTime(): ?string
    {
        return $this->data['set_time'] ?? null;
    }
    // NEW: Add any property
    public function addProperty(string $key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    // NEW: Get any property
    public function getProperty(string $key)
    {
        return $this->data[$key] ?? null;
    }
    /**
     * Return render output (for debugging or SEO output).
     */
    public function render(): string
    {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }

    public function __toString(): string
    {
        return $this->render();
    }
}
