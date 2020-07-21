<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\BaseClass;


class BaseClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BaseClass::orderBy("code", "desc")->paginate(50);//->links();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'code' => 'required',
            'class' => 'required',
            'values' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $entity = BaseClass::create([
            "code" => $request->code,
            "class" => $request->class,
            "values" => $request->values,
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'code' => 'required',
            'class' => 'required',
            'values' => 'required',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $entity = BaseClass::find( $id );
        $entity->update([
            "code" => $request->code,
            "class" => $request->class,
            "values" => $request->values,
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entity = BaseClass::find( $id );
        if( $entity == NULL )
            return response()->json([
                'status' => 'Record not found'
            ], 404);
        
        $entity->delete();    
        return response()->json(['status' => 'success'], 200);
    }
}
