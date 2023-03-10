<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */

    public static $wrap = 'results';
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
