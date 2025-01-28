<?php

namespace App\Http\Controllers;

use App\SupplierAccreditation;
use App\User;
use App\SupplierEvaluation;
use App\SupplierEvaluationResult;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class EvaluationController extends Controller
{
    // List
    public function index(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $vendor = SupplierAccreditation::all();
        $users = User::where('status','Active')->pluck('name','id');
        $supplier_evaluation = SupplierEvaluation::when($start_date || $end_date, function($query) use ($start_date,$end_date){
                $query->whereBetween('created_at',[$start_date.' 00:00:01',$end_date.' 23:59:59']);
            })
            ->paginate(10);
            // dd($vendor->take(10));
        return view('supplier_evaluation.index', compact('supplier_evaluation', 'users','start_date','end_date', 'vendor'));
    }

    // Store
    public function store(Request $request)
    {
        $supplier_evaluation = new SupplierEvaluation;
        $supplier_evaluation->vendor_id = $request->vendor_id;
        $supplier_evaluation->name = $request->name;
        $supplier_evaluation->type = $request->type;
        $supplier_evaluation->address = $request->address;
        $supplier_evaluation->product_services = $request->product_services;
        $supplier_evaluation->contact1 = $request->contact1;
        $supplier_evaluation->contact2 = $request->contact2;
        $supplier_evaluation->position1 = $request->position1;
        $supplier_evaluation->position2 = $request->position2;
        $supplier_evaluation->telephone1 = $request->telephone1;
        $supplier_evaluation->telephone2 = $request->telephone2;
        $supplier_evaluation->mobile1 = $request->mobile1;
        $supplier_evaluation->mobile2 = $request->mobile2;
        $supplier_evaluation->comments = $request->comments;
        $supplier_evaluation->action = $request->action;
        $supplier_evaluation->status = "Pending";
        $supplier_evaluation->save();

        $supplier_result = new SupplierEvaluationResult;
        $supplier_result->evaluation_id = $supplier_evaluation->id;
        $supplier_result->result = $request->result;
        $supplier_result->rating1 = $request->rating1;
        $supplier_result->rating2 = $request->rating2;
        $supplier_result->rating3 = $request->rating3;
        $supplier_result->rating4 = $request->rating4;
        $supplier_result->rating5 = $request->rating5;
        $supplier_result->rating6 = $request->rating6;
        $supplier_result->rating7 = $request->rating7;
        $supplier_result->score1 = $request->score1;
        $supplier_result->score2 = $request->score2;
        $supplier_result->score3 = $request->score3;
        $supplier_result->score4 = $request->score4;
        $supplier_result->score5 = $request->score5;
        $supplier_result->score6 = $request->score6;
        $supplier_result->score7 = $request->score7;
        $supplier_result->remarks = $request->remarks;
        $supplier_result->remarks1 = $request->remarks1;
        $supplier_result->remarks2 = $request->remarks2;
        $supplier_result->remarks3 = $request->remarks3;
        $supplier_result->remarks4 = $request->remarks4;
        $supplier_result->total = $request->total;
        $supplier_result->save();

        Alert::success('Successfully Saved')->persistent('Dismiss');
        return back();
    }

    public function view($id)
    {
        $data = SupplierEvaluation::with('user', 'results')->findOrFail($id);
        $users = User::where('status','Active')->pluck('name','id');

        return view('supplier_evaluation.view', compact('data','users'));
    }

    public function update(Request $request, $id)
    {
        $supplier_evaluation = SupplierEvaluation::findOrFail($id);
        $supplier_evaluation->vendor_id = $request->vendor_id;
        $supplier_evaluation->name = $request->name;
        $supplier_evaluation->type = $request->type;
        $supplier_evaluation->address = $request->address;
        $supplier_evaluation->product_services = $request->product_services;
        $supplier_evaluation->contact1 = $request->contact1;
        $supplier_evaluation->contact2 = $request->contact2;
        $supplier_evaluation->position1 = $request->position1;
        $supplier_evaluation->position2 = $request->position2;
        $supplier_evaluation->telephone1 = $request->telephone1;
        $supplier_evaluation->telephone2 = $request->telephone2;
        $supplier_evaluation->mobile1 = $request->mobile1;
        $supplier_evaluation->mobile2 = $request->mobile2;
        $supplier_evaluation->comments = $request->comments;
        $supplier_evaluation->action = $request->action;

        $supplier_evaluation->update();

        Alert::success('Successfully Updated')->persistent('Dismiss');
        return back();
    }
    
}
