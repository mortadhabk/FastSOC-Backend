<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Resources\OfferResource;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    function index()
    {
        $data = Offer::all();
        return ApiResponseClass::sendResponse(OfferResource::collection($data), '', 200);
    }
}
