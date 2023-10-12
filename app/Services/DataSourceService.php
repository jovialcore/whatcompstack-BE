<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DataSource;

class DataSourceService
{

    public function addDataSource($request)
    {
        $request->validate([
            'data_source_name' => 'required|string',
            'data_source_url' => 'required|url'
        ]);

        $dataSource = new DataSource;
        $dataSource->data_source_name = $request->data_source_name;
        $dataSource->data_source_url = $request->data_source_url;

        return $dataSource->save();
    }
}
