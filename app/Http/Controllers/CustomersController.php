<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customers::all();
        return response()->json($customers, 200);
    }                                                 
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    { 
        $data = $request->validated();
        $customer = Customers::create($data);
        return response()->json([
            'message' => 'Cliente creado exitosamente',
            'customer' => $customer
        ], 201);
    }
    


    public function show(Customers $customer)
    {
        return response()->json($customer, 200);
        
    }

    public function update(CustomerRequest $request, Customers $customer)
    {
        $customer->update($request->validated());
        return response()->json(['customer' => $customer], 200);
    }

    public function destroy(Customers $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }


/////////////////////////////////////////'

public function indexcustotype()
{
    $customerTypes = CustomerType::all();
    return response()->json($customerTypes);
}

public function storecustomertype(Request $request)
{
    $request->validate([
        'name' => 'required|string|unique:customer_types',
    ]);

    $customerType = CustomerType::create($request->all());
    return response()->json(['message' => 'Tipo de cliente creado.', 'data' => $customerType]);
}

public function updateCustType(Request $request, CustomerType $customerType)
{
    $request->validate([
        'name' => 'required|string|unique:customer_types,name,' . $customerType->id,
    ]);

    $customerType->update($request->all());
    return response()->json(['message' => 'Tipo de cliente actualizado.', 'data' => $customerType]);
}

public function destroyCustype( CustomerType $customerType)
{
    $customerType->delete();
    return response()->json(['message' => 'Tipo de cliente eliminado.']);
}

public function deactivateCustype(CustomerType $customerType)
{
    $customerType->update(['status' => false]);
    return response()->json(['message' => 'Tipo de cliente desactivado.']);
}


public function showCustypes(CustomerType $customerType){
        if (!$customerType->status) {
            return response()->json(['message' => 'El tipo de cliente ha sido eliminado'], 404);
        }

        return response()->json($customerType);
    }
}