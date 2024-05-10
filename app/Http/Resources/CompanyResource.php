<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // dd($this->resource);
        return  [

            'id' => $this->id,
            'company' => $this->name,
            'about' => $this->about,
            'company_url' => $this->url,
            'source_slug' => $this->source_slug,
            'ceo' => $this->ceo,
            'ceo_contact' => $this->ceo_contact,
            'cto_contact' => $this->cto_contact,
            'cto_name' => $this->cto_name,
            'hr_name' => $this->hr,
            'hr_contact' => $this->hr_contact,
            'source_slug' => $this->source_slug,
            'logo' => $this->logo ? asset($this->logo) : null,
            'is_mobile_only' => $this->is_mobile_only == 1 ? true : false,
            'stack_be_plang' => $this->plangs->map(function ($item) {
                return [$item->name => ['rating' => $item->pivot->rating]];
            }),
            'stack_be_framework' => $this->frameworks->map(function ($item) {
                return [$item->name => ['rating' => $item->pivot->rating]];
            }),
            'stack_fe_framework' => $this->feFrameworks->map(function ($item) {
                return [$item->name => ['rating' => $item->pivot->rating]];
            }),
            'stack_mobile' => $this->mobilePlangs->map(function ($item) {
                return [$item->name => ['rating' => $item->pivot->rating]];
            }),
        ];
    }
}
