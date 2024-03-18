<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request as HttpRequest;


class AdminController extends Controller
{
    use ApiResponse;
    /**
     * Assign Marketing rights
     */
    public function assignMarketerRights(HttpRequest $request)
    {
        try {

            if (is_array($request->marketers)) {

                $this->processBatch($request->marketers);
            } else {

                $this->processSingle($request->marketers);
            }

            return $this->success(message: 'Roles Assigned Successfully');
        } catch (\Throwable $th) {

            return $this->serverError(message: $th->getMessage());
        }
    }


    private function processBatch(array $data)
    {
        foreach ($data as $id) {
            $this->processSingle($id);
        }
    }

    private function processSingle($Marketer)
    {
        $Maketer = User::findOrFail($Marketer);

        $Maketer->role = 'marketer';

        return $Maketer->save();
    }
}
