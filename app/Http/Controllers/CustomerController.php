<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private CustomerRepositoryInterface $customerRepositoryInterface;

    public function __construct(CustomerRepositoryInterface $productRepositoryInterface)
    {
        $this->customerRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->customerRepositoryInterface->index();

        return ApiResponseClass::sendResponse(CustomerResource::collection($data), '', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $details = [
            'siret' => $request->siret,
            'siren' => $request->siren,
            'legal_name' => $request->legal_name,
        ];
        DB::beginTransaction();
        try {
            $customer = $this->customerRepositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new CustomerResource($customer), 'Customer Create Successful', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->customerRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new CustomerResource($product), '', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $updateDetails = [
            'siret' => $request->siret,
            'siren' => $request->siren,
            'legal_name' => $request->legal_name,
        ];
        DB::beginTransaction();
        try{
             $customer = $this->customerRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('','Customer Update Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->customerRepositoryInterface->delete($id);
        return ApiResponseClass::sendResponse('','Customer Delete Successful',204);
    }
}
