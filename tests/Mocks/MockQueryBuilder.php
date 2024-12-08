<?php

namespace Tests\Mocks;

use Illuminate\Support\Collection;

class MockQueryBuilder
{
    private $mockData;

    public function __construct(Collection $mockData)
    {
        $this->mockData = $mockData;
    }

    public function where($column, $operator = null, $value = null)
    {
        if (func_num_args() === 2) {
            return $this;
        }
        return $this;
    }

    public function orWhereHas($relation, $callback)
    {
        return $this;
    }

    public function exists()
    {
        return !$this->mockData->isEmpty();
    }

    public function get()
    {
        return $this->mockData;
    }

    public function paginate($perPage)
    {
        $currentPage = request('page', 1);
        $items = $this->mockData->forPage($currentPage, $perPage);
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $this->mockData->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }
}
