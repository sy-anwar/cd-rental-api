<?php

namespace App\Http\Controllers;

use App\CdCollection;
use App\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
    }
    /**
     * GET /rent
     * 
     * @return array
     */
    public function index(){
        $collection = Rent::all();
        return \response($collection);
    }

    public function show($id){
        $rent = Rent::where('id',$id)->get();
        if(!Rent::find($id)) return $this->errorResponse('Rent record not found!', 404);

        return \response($rent);
    }

    public function store(Request $request){

        //validate request parameters
        $this->validate($request, [
            'customer' => 'bail|required|max:50',
            'id_cd' => 'bail|required',
        ]);

        $rent = new Rent();
        $rent->customer = $request->input('customer');
        $id_cd = $request->input('id_cd');

        $cd_coll = CdCollection::where('id',$id_cd)->where('quantity', '>', 0)->first();

        $rent->id_cd = $id_cd;
        $rent->save();
        
        $cd_coll->quantity = $cd_coll->quantity - 1;
        $cd_coll->save();

        return \response($rent);
    }

    public function update($id, Request $request){

        // validate request parameters
        $this->validate($request, [
            'customer' => 'max:50',
        ]);

        // Return error 404 response if not found
        if(!Rent::find($id)) return $this->errorResponse('Rent record not found!', 404);

        $rent = Rent::find($id)->update($request->all());

        if($rent){
            // return updated data
            return \response($rent);
        }

        // Return error 400 response if updated was not successful        
        return $this->errorResponse('Failed to update Rent record!', 400);
    }

    public function destroy($id){
        
        // Return error 404 response if not found
        if(!Rent::find($id)) return $this->errorResponse('Rent record not found!', 404);

        // Return 410(done) success response if delete was successful
        if(Rent::find($id)->delete()){
            return $this->customResponse('rent deleted successfully!', 410);
        }

        //Return error 400 response if delete was not successful
        return $this->errorResponse('Failed to delete Rent record!', 400);
    }

    public function return($id, Request $request){

        // Return error 404 response if not found
        if(!Rent::find($id)) return $this->errorResponse('Rent record not found!', 404);

        $rent = new Rent();
        $rent->customer = $request->input('customer');
        $id_cd = $request->input('id_cd');

        $cd_coll = CdCollection::where('id',$id_cd);

        $rent->id_cd = $id_cd;
        $rent->save();
        $rent->quantity = $request->input('quantity');
        $price = date_diff($rent->updated_at, $rent->created_at)* $cd_coll->rate;
        $rent->price = $price;
        $rent->save();
        
        $cd_coll->quantity = $cd_coll->quantity + 1;
        $cd_coll->save();


        if($rent){
            // return updated data
            return \response($rent);
        }

        // Return error 400 response if updated was not successful        
        return $this->errorResponse('Failed to update Rent record!', 400);
    }

    public function errorResponse($message = 'success', $status = 200)
    {
        return response(['status' =>  $status, 'message' => $message], $status);
    }
}
