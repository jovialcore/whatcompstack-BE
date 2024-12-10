<?php

namespace Tests\Mocks;

use App\Models\Company;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Tests\Mocks\MockQueryBuilder;

class MockCompany extends Company
{
    private $mock_data;

    public function __construct($mock_data)
    {
        $this->mock_data = $mock_data;
    }

    public function newQuery()
    {
        return new MockQueryBuilder($this->mock_data);
    }

    public function FetchAllClientDetails()
    {
        return $this;
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

    public function paginate($perPage)
    {
        $currentPage = request('page', 1);
        $items = $this->mock_data->forPage($currentPage, $perPage);
        return new LengthAwarePaginator(
            $items,
            $this->mock_data->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function get()
    {
        return $this->mock_data;
    }
}
