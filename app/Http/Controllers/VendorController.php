<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    function index()
    {
        $data = Vendor::all();
        return ApiResponseClass::sendResponse(VendorResource::collection($data), '', 200);
    }
}
