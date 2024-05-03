<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

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
        try {
            $customer = $this->customerRepositoryInterface->update($updateDetails, $id);

            DB::commit();
            return ApiResponseClass::sendResponse('', 'Customer Update Successful', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->customerRepositoryInterface->delete($id);
        return ApiResponseClass::sendResponse('', 'Customer Delete Successful', 204);
    }


    /**
     * Search Name of the customer by Siren or Siret.
     */
    public function searchBySiren($siren)
    {
        $url = "https://api.insee.fr/entreprises/sirene/V3.11/siren/" . $siren . "?champs=prenom1UniteLegale&masquerValeursNulles=true";
        $token = $this->getToken();
        if ($token == null) {
            return response()->json(['error' => 'Failed to get access token.'], 500);
        }

        // Make a GET request to the API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get($url);

        // Check if the request was successful
        if ($response->successful()) {
            // Get the response data
            $data = $response->json();

            // Return the response data
            return response()->json($data);
        } else {
            // If the request failed, return an error response
            return response()->json(['error' => 'Failed to fetch data from the API.'], $response->status());
        }
    }

    /**
     * Get access token from INSEE API.
     */
    private function getToken()
    {
        // Check if the token exists in the cache
        $accessToken = Cache::get('insee_access_token');
        if (!$accessToken) {

            // Client ID and client secret.
            // In production these should be stored in the .env file
            $clientId = '9hWaTK_KKgYfa7lYTL72NhemPWIa';
            $clientSecret = 'tq5t7YwMfZEVAgz6wTJabxS5RmUa';

            $client = new Client();
            $response = $client->request('POST', 'https://api.insee.fr/token', [
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ],
            ]);

            // Check if the request was successful
            if ($response->getStatusCode() === 200) {
                // Get the access token from the response
                $responseBody = json_decode($response->getBody()->getContents(), true);
                $accessToken = $responseBody['access_token'];

                // Store the access token in the cache with an expiration time
                Cache::put('insee_access_token', $accessToken, now()->addSeconds($responseBody['expires_in']));

                // Return the access token
                return $accessToken;
            } else {
                return null;
            }
        } else {
            // If the token exists in the cache, return it
            return $accessToken;
        }
    }
}
