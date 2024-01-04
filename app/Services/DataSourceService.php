<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DataSource;
use Illuminate\Database\Eloquent\Collection;

class DataSourceService
{


    public function getAllDataSources(): Collection
    {
        $sources = DataSource::all();

        return $sources;
    }


    public function addDataSource($request): bool
    {
        $request->validate([
            'data_source_name' => 'required|string',
            'data_source_url' => 'required|url|unique:data_sources,url,except,id'
        ]);

        $dataSource = new DataSource;
        $dataSource->name = $request->data_source_name;
        $dataSource->url = $request->data_source_url;

        return $dataSource->save();
    }
}
