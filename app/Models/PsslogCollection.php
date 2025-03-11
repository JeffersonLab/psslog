<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class PsslogCollection extends Collection
{
    public function groupBy($groupBy, $preserveKeys = false)
    {
        if (is_string($groupBy)) {
            switch (strtolower($groupBy)) {
                case 'shift': return $this->groupByShift($preserveKeys);
                case 'day': return $this->groupByDay($preserveKeys);
                case 'area': return $this->groupByArea($preserveKeys);
            }
        }

        // Fall through to inherited method
        return parent::groupBy($groupBy, $preserveKeys);
    }

    /**
     * Applies multi-key sorting to the collection items.
     */
    public function sorted(array $sortBy = [], $sortOrder = null): PsslogCollection
    {
        if (empty($sortBy)) {
            return $this;
        }

        return $this->sortBy(function ($psslog, $idx) use ($sortBy) {
            $hashedKey = '';
            foreach ($sortBy as $key) {
                $hashedKey .= isset($psslog->$key) ? '#'.$psslog->$key : '#';
            }

            return $hashedKey;
        }, SORT_REGULAR, $this->isDescendingSort($sortBy, $sortOrder));
    }

    /**
     * Should sorting be in reverse (desc) order?
     */
    public function isDescendingSort(array $sortBy, $sortOrder): bool
    {
        if (! $sortOrder) {
            $sortOrder = $this->defaultSortOrder($sortBy);
        }

        return $sortOrder == 'desc' ? true : false;
    }

    /**
     * Determine default sort order based on column(s) being sorted upon.
     *
     * If the list of columns contains a date attribute, then the default order
     * will
     *
     * @return string asc|desc
     */
    public function defaultSortOrder(array $sortBy): string
    {
        $dateAttributes = (new Psslog)->getDates();
        foreach ($dateAttributes as $dateAttribute) {
            if (in_array($dateAttribute, $sortBy)) {
                return 'desc';
            }
        }

        return 'asc';
    }

    public function groupByArea($preserveKeys)
    {
        return parent::groupBy('area', $preserveKeys);
    }

    public function groupByDay($preserveKeys = false)
    {
        return parent::groupBy(function ($item, $key) {
            return $this->dayName($item->entry_timestamp);
        }, $preserveKeys);
    }

    public function groupByShift($preserveKeys)
    {
        return parent::groupBy(function ($item, $key) {
            return $this->shiftName($item->entry_timestamp).' '.$this->dayName($item->entry_timestamp);
        }, $preserveKeys);
    }

    /**
     * Sort grouped items by key.
     */
    public function sortByGroup()
    {
        ksort($this->items);
    }

    protected function shiftName(Carbon $date)
    {
        $shiftsTable = config('settings.ops_shifts');

        return $shiftsTable[$date->format('G')];
    }

    protected function dayName(Carbon $date)
    {
        return $date->format('l (d-M-Y)');
    }
}
