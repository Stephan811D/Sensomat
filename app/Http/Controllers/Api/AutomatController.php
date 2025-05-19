<?php

namespace App\Http\Controllers\Api;

use App\Models\Automat;
use App\Models\Shaft;
use App\Http\Resources\Dashboard\DashboardAutomatResource;
use App\Http\Resources\Automat\BasicAutomatResource;
use App\Http\Resources\Automat\DetailedAutomatResource;

use \Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AutomatController extends Controller
{
    public function index($id){
        return new BasicAutomatResource(Automat::findOrFail($id));
    }
    public function indexStatus()
    {
        //return Automat::where('active', 1)->get();
        //return Automat::all();
        return DashboardAutomatResource::collection(Automat::with('shaft', 'product')->where('active', 1)->get());
    }
    public function indexBasic()
    {
        return BasicAutomatResource::collection(Automat::all()->where('active', 1));
    }
    public function indexDetailed($id)
    {
        return new DetailedAutomatResource(Automat::with('shaft', 'product')->where('active', 1)->findOrFail($id));
    }

    public function show($id)
    {
        //return Automat::with('shaft','product')->findOrFail($id);
        return new DashboardAutomatResource(
            //Product::with('productType', 'automat')->where('active', 1)->get()
            Automat::with('shaft', 'product')->findOrFail($id)
        );
    }

    public function storeShaftProducts(Request $request)
    {
        $this->validate($request, [
            'data' => 'required',
        ]);

        $updateData = $request->json()->all()['data'];
        $newDataCollection = collect($updateData);

        $newDataCollection->each(function ($item) {
            Shaft::where('id', $item["shaft_id"])
                ->update(['product_id' => $item["product_id"]]);
        });

        return response()->json([
            'message' => 'Shafts updated successfully'
        ]);
    }

    public function storeShaftConfigs(Request $request)
    {
        $this->validate($request, [
            'data' => 'required',
        ]);

        $updateData = $request->json()->all()['data'];
        $newDataCollection = collect($updateData);

        $newDataCollection->each(function ($item) {
            if (isset($item["measuredShaftLength"])) {
                Shaft::where('id', $item["shaft_id"])
                    ->update(['measuredShaftLength' => $item["measuredShaftLength"]]);
            }
            if (isset($item["capacity"])) {
                Shaft::where('id', $item["shaft_id"])
                    ->update(['capacity' => $item["capacity"]]);
            }
        });

        return response()->json([
            'message' => 'Shafts updated successfully'
        ]);
    }

    public function getFillingLevel($id)
    {

        return Automat::findOrFail($id)->getCurrentState();
    }
    public function getAutomatNames()
    {
        return Automat::all()->where('active', 1);
    }

    public function getShaftStates($id)
    {
        $hallo = $id;
        $test = Shaft::select('shaft_id', 'product_id', 'capacity', 'level')->with('product:id,productName,color')->where('automat_id', $id)->get(); //->where('active', 1)->findOrFail($id)->get();
        return $test;

        //Product::with('productType', 'automat')->where('active', 1)->get()

    }
    public function getNetworkState($id)
    {
        return Automat::select('id', 'ipAddress', 'macAddress', 'SSID', 'channel', 'encryption', 'signalStrength', DB::raw('unix_timestamp(updated_at) * 1000 as lastUpdate'))->where('id', $id)->get();
    }

    public function getDoorState($id)
    {
        return Automat::select('id', 'doorStateOpen', DB::raw('unix_timestamp(lastDoorState) * 1000 as lastDoorState'))->where('id', $id)->get();
    }

    //CLASSIC FUNCTIONS
    public function store(Request $request)
    {
        $this->validate($request, [
            'automatId' => 'required',
            'automatName' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => 'required',
            'zipCode' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
        ]);

        $automat = Automat::create([
            'automatId' => $request['automatId'],
            'automatName' => $request['automatName'],
            'addressLine1' => $request['addressLine1'],
            'addressLine2' => $request['addressLine2'],
            'zipCode' => $request['zipCode'],
            'city' => $request['city'],
            'region' => $request['region'],
            'country' => $request['country'],
        ]);

        for ($i = 1; $i <= $request['shaftAmount']; $i++) {
            $shaft = Shaft::create([
                'shaft_id' => $i,
                'automat_id' => $automat->id,
                'product_id' => null,
                'measuredShaftLength' => 0,
                'capacity' => 0,
            ]);
        }

        return response()->json([
            'message' => 'Automat stored successfully'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'automatId' => 'required',
            'automatName' => 'required',
            'addressLine1' => 'required',
            'addressLine2' => 'required',
            'zipCode' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
        ]);

        Automat::findOrFail($id)->update($request->all());

        return response()->json([
            'message' => 'Automat updated successfully'
        ]);
    }

    //public function show($id)
    //{
    //    return new ProductResource(Product::with('productType', 'automat')->findOrFail($id));
    //}

    public function destroy($id)
    {
        $automat = Automat::findOrFail($id);
        $automat->active = false; 
        $automat->shaft()->update(array('active' => false));
        $automat->save();

        return response()->json([
            'message' => 'Automat deleted successfully'
        ]);
    }
}
