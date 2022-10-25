<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\ProductJoinInvoiceResource;
use App\Models\ProductJoinInvoice;
use Illuminate\Http\Request;

class ProductJoinInvoiceController extends Controller
{

    
    public $dataError = [
        "data" => null,
        "error" => "Product Join invoice not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Product join invoice deleted successfully !",
    ];

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/productjoininvoice",
     *   summary="All product join invoices",
     *   description="This route returns all product join invoices",
     *   tags={"Product Join Invoice"},
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1), 
     *              @OA\Property(property="name", type="text", example="Altenwerth, Koelpin and Breitenberg"),
     *              @OA\Property(property="address", type="text", example="12720 Kuphal Green\nCristfort, CO 08458"), 
     *              @OA\Property(property="description", type="text", example="Veniam aut officiis molestiae magnam. Necessitatibus assumenda quod adipisci nostrum totam est doloribus. Delectus quis quaerat numquam neque nisi laboriosam sit. Minima voluptatum sed commodi aperiam ut."),
     *              @OA\Property(property="created_at", type="text", example="2022-10-18T14:57:16.000000Z"),
     *              @OA\Property(property="updated_at", type="text", example="2022-10-18T14:57:16.000000Z")
     *          )
     *      )
     * )
     */
    public function index()
    {
        return ProductJoinInvoiceResource::collection(ProductJoinInvoice::all());
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','exists:products,id'],
            'invoice_id'=>['required','exists:invoices,id'],
            'series'=>['required'],
            'deadline'=>['required'],
            'amount'=>['required'],
            'base_price'=>['required'],
            'base_price_percent'=>['required'],
            'trade_discount'=>['required'],
            'delivery_cost'=>['required'],
            'vat'=>['required'],
            'certificate'=>['required'],
            'price'=>['required']
        ]);
        $ProductJC = new ProductJoinInvoice();
        $ProductJC->product_id = $request->product_id;
        $ProductJC->invoice_id = $request->invoice_id;
        $ProductJC->series = $request->series;
        $ProductJC->deadline = $request->deadline;
        $ProductJC->amount = $request->amount;
        $ProductJC->base_price = $request->base_price;
        $ProductJC->base_price_percent = $request->base_price_percent;
        $ProductJC->trade_discount = $request->trade_discount;
        $ProductJC->delivery_cost = $request->delivery_cost;
        $ProductJC->vat = $request->vat;
        $ProductJC->certificate = $request->certificate;
        $ProductJC->price = $request->price;
        $ProductJC->save();
        return response()->json(new ProductJoinInvoiceResource($ProductJC),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\ProductJoinInvoice  $productJoinInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($productJoinInvoice)
    {
        $productInvoice = ProductJoinInvoice::find($productJoinInvoice);
        if($productInvoice){
            return response()->json(new ProductJoinInvoiceResource($productInvoice),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductJoinInvoice  $productJoinInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductJoinInvoice $productJoinInvoice)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductJoinInvoice  $productJoinInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$productJoinInvoice)
    {
        $ProductJC = ProductJoinInvoice::find($productJoinInvoice);
        if($ProductJC){
            $request->validate([
                'product_id'=>['required','exists:products,id'],
                'invoice_id'=>['required','exists:invoices,id'],
                'series'=>['required'],
                'deadline'=>['required'],
                'amount'=>['required'],
                'base_price'=>['required'],
                'base_price_percent'=>['required'],
                'trade_discount'=>['required'],
                'delivery_cost'=>['required'],
                'vat'=>['required'],
                'certificate'=>['required'],
                'price'=>['required']
            ]);
            $ProductJC->product_id = $request->product_id;
            $ProductJC->invoice_id = $request->invoice_id;
            $ProductJC->series = $request->series;
            $ProductJC->deadline = $request->deadline;
            $ProductJC->amount = $request->amount;
            $ProductJC->base_price = $request->base_price;
            $ProductJC->base_price_percent = $request->base_price_percent;
            $ProductJC->trade_discount = $request->trade_discount;
            $ProductJC->delivery_cost = $request->delivery_cost;
            $ProductJC->vat = $request->vat;
            $ProductJC->certificate = $request->certificate;
            $ProductJC->price = $request->price;
            $ProductJC->save();
            return response()->json(new ProductJoinInvoiceResource($ProductJC),200);
      }
      return response()->json($this->dataError,404);        
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductJoinInvoice  $productJoinInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($productJoinInvoice)
    {
        $ProductJC = ProductJoinInvoice::find($productJoinInvoice);
        if($ProductJC){
            $ProductJC->delete();
            return response()->json($this->dataSuccess,200);
      }
      return response()->json($this->dataError,404);
    }
}