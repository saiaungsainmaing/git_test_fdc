<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
  public function register()
  {
      return view('customer.register');
  }

  //create customer account......................................
  public function create(Request $request)
{
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:50',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'phoneNumber' => 'required',
        ],[
            'name.required' => "Please Fill...(name)",
            'name.max' => 'Not greaten than 50',
            'email.required' => 'Email Required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // // Retrieve the validated input...
        // $validated = $validator->validated();

        // // Retrieve a portion of the validated input...
        // $validated = $validator->safe()->only(['name', 'email']);
        // $validated = $validator->safe()->except(['name', 'email']);


    $data = $this->getCustomerData($request);
    Customer::create($data);

    return back()->with(['insertSuccess'=> 'User Information Recorded...']);   // dd("insert success");
}

// customer list page.........................................................................................
// paginate..................................................................................
public function list() {
    $data = Customer::paginate(20);
    return view('customer.list')->with(['customer' => $data]);
}


//customer see more....................................
public function seeMore($id)
{
    $data = Customer::where('customer_id', $id)->get()->toArray(); //object data type.................

    // dd($data->toArray());
    return view('customer.seeMore')->with(['customer' => $data]);
}



//delete customer data................................
public function delete($id)
{
    Customer::where('customer_id', $id)->delete();
    return back()->with(['deleteSuccess'=> 'Customer Data Deleted!']);
}


//edit customer data................................
public function edit($id)
{
    $data = Customer::where('customer_id', $id)->first();//object data type........
    return view('customer.edit')->with(['customer' => $data]);
}


//update customer data................................
public function update($id, Request $request)
{
    $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required',
            'phoneNumber' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
    $updateData = $this->getCustomerData($request);
    $updateData['id']=$id;
    Session::put('CUSTOMER_DATA', $updateData);
    return redirect()->route('customer#confirm');
}
    // Customer::where('customer_id', $id)->update ( $updateData );
    // return redirect()->route('customer#list')->with(['updateSuccess'=>'Customer Data Updated!']);


//confirm customer data................................

public function confirm()
{
    $data=Session::get('CUSTOMER_DATA');
    return view('customer.confirm')->with(['customer' =>$data]);
}

//real update customer data................................
public function realUpdate()
{
    $data = Session::get('CUSTOMER_DATA');
    $id =$data['id'];

    unset($data['id']);//remove id in data array
    Session::forget('CUSTOMER_DATA');

    Customer::where('customer_id', $id)->update($data);
    return redirect()->route('customer#list')->with(['updateSuccess'=>'Customer Updated!']);
}



//request customer data =>....................................................
private function getCustomerData($request)
{
    return[
            'name' => $request ->name ,
            'email' => $request ->email ,
            'address' => $request ->address ,
            'gender' => $request ->gender ,
            'date_of_birth' => $request ->dateOfBirth,
            'phone' => $request ->phoneNumber ,
        ];
    }
}
