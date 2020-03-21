<?php

namespace App\Http\Controllers;

use App\CdCollection;
use Illuminate\Http\Request;

class CdCollectionController extends Controller
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
     * GET /products
     * 
     * @return array
     */
    public function index(){
        $collection = CdCollection::all();
        return \response($collection);
    }

    public function show($id){
        $cd = CdCollection::where('id',$id)->get();
        return \response($cd);
    }

    public function store(Request $request){

        //validate request parameters
        $this->validate($request, [
            'title' => 'bail|required|max:255',
            'rate' => 'bail|required',
            'category' => 'bail|required|max:255',
            'quantity' => 'bail|required',
        ]);

        $cd = CdCollection::create($request->all());
        return \response($cd);
    }

    public function update($id, Request $request){

        // validate request parameters
        $this->validate($request, [
            'title' => 'max:255',
        ]);

        // Return error 404 response if not found
        if(!CdCollection::find($id)) return $this->errorResponse('CD not found!', 404);

        $cd = CdCollection::find($id)->update($request->all());

        if($cd){
            // return updated data
            return \response($cd);
        }

        // Return error 400 response if updated was not successful        
        return $this->errorResponse('Failed to update CD!', 400);
    }

    public function destroy($id){
        
        // Return error 404 response if not found
        if(!CdCollection::find($id)) return $this->errorResponse('CD not found!', 404);

        // Return 410(done) success response if delete was successful
        if(CdCollection::find($id)->delete()){
            return $this->customResponse('CD deleted successfully!', 410);
        }

        //Return error 400 response if delete was not successful
        return $this->errorResponse('Failed to delete CD!', 400);
    }

    public function customResponse($message = 'success', $status = 200)
    {
        return response(['status' =>  $status, 'message' => $message], $status);
    }
}
