<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Building;
use App\BuildingImage;
use DataTables;
use Redirect;
use PDF;

class BuildingController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Building::select('*');
            
            return Datatables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', function($dat){
                return '<div class="d-flex"><a href="'.route('edit',$dat->id).'" class="btn btn-primary mr-2">Edit</a><a href="'.route('delete',$dat->id).'" class="btn btn-danger pr-2">Delete</a></div>';
            })
    
            ->rawColumns(['action'])
            ->make(true);
            
            }


        return view('building.index');
    }

    

    public function create(){
        return view('building.add');
    }

    public function edit($id){
        $building=Building::find($id);
        return view('building.edit')->with(['building'=>$building]);
    }
    public function delete($id){
        Building::where('id',$id)->delete();
        BuildingImage::where('building_id',$id)->delete();
        return Redirect::route('home')->withErrors(['msg' => 'Building Deleted Successfully']);
    }

    public function store(Request $request){

        $data=$request->input();
        $validator = Validator::make($data,[
                'name'=>'required|string',
                'monthly_consumption'=>'required|numeric',
                'location_details'=>'required|string',
                'images.*'=>'required|mimes:jpg,jpeg,png,gif',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            
            $building=Building::create([
                'name'=>$data['name'],
                'monthly_consumption'=>$data['monthly_consumption'],
                'location_details'=>$data['location_details'],
            ]);

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imagePath=$image->store('building_images');
                $building->images()->create([
                    'image_name'=>$imagePath
                ]);
            }
        }

        return Redirect::back()->withErrors(['msg' => 'Building Saved Successfully']);
    }

    public function exportpdf(){
        $buildings=Building::get();
        foreach($buildings as $col=>$build){
            $images=BuildingImage::where('building_id',$build->id)->get();
            $buildings[$col]->images=$images;
        }
        $pdf = PDF::loadView('pdf', compact('buildings'));
        return $pdf->download('buildings.pdf');
    }

    public function update(Request $request){


        $data=$request->input();
        $validator = Validator::make($data,[
                'id'=>'required',
                'name'=>'required|string',
                'monthly_consumption'=>'required|numeric',
                'location_details'=>'required|string',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            
            $building=Building::where('id',$data['id'])->update([
                'name'=>$data['name'],
                'monthly_consumption'=>$data['monthly_consumption'],
                'location_details'=>$data['location_details'],
            ]);

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imagePath=$image->store('building_images');
                $building->images()->create([
                    'image_name'=>$imagePath
                ]);
            }
        }

        return Redirect::back()->withErrors(['msg' => 'Building Updated Successfully']);
    }
}
