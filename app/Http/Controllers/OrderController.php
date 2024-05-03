<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepositoryInterface;

    public function __construct(OrderRepositoryInterface $productRepositoryInterface)
    {
        $this->orderRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->orderRepositoryInterface->index();

        return ApiResponseClass::sendResponse(OrderResource::collection($data), '', 200);
    }

    public function store(StoreOrderRequest $request)
    {
        // Get an array even if no IDs are provided
        $vendorIds = $request->input('vendor_id', []); 

        $orderDetails = [
            'customer_id' => $request->customer_id,
            'offer_id' => $request->offer_id,
            'licenses' => $request->licenses,
            'description' => $request->description,
        ];
    
        DB::beginTransaction();
        try {
            $order = $this->orderRepositoryInterface->store($orderDetails);

            // Attach vendors to the order
            if (!empty($vendorIds)) {
                $order->vendors()->attach($vendorIds);
            }
            
            DB::commit();
            return ApiResponseClass::sendResponse(new OrderResource($order), 'Order Created Successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }
    
}
