<?php

namespace App\Services;


use App\Http\Resources\SearchResultResource;

class SearchService
{

    protected $searchItem;

    protected $companyModel;


    public function __construct($searchItem, $companyModel)
    {

        $this->searchItem = $searchItem;

        $this->companyModel = $companyModel;
    }

    public function search()
    {

        if ($this->searchItem) {

            $results =   $this->companyModel::query()
                ->where('name', 'LIKE', '%' . $this->searchItem . '%')
                ->orWhereJsonContains('stack_be', [$this->searchItem])
                ->orWhereJsonContains('stack_fe', [$this->searchItem])
                ->orWhereJsonContains('devops', [$this->searchItem])
                ->orWhereJsonContains('database_driver', [$this->searchItem])
                ->orderBy('id', 'DESC')->paginate(10);

            $searchResults = SearchResultResource::collection($results);
            return [$searchResults, ['status' => 200]];
        }
    }
}
