<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public $dataError = [
        "data" => null,
        "error" => "Invoice not found",
    ];

    public $dataSuccess = [
        "data" => null,
        "success" => "Invoice deleted successfully !",
    ];
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** 
     * @OA\Get(
     *   path="/api/v1/invoice",
     *   summary="All invoices",
     *   description="This route returns all invoices",
     *   tags={"Invoice"},
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
        return InvoiceResource::collection(Invoice::all());
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
            'organization_id'=>['required','exists:organizations,id'],
            'invoice_number'=>['required','exists:customers,id'],
            'invoice_date'=>['required'],
            'accept_by'=>['required','exists:users,id'],
            'payment_type'=>['required'],
            'total_price'=>['required']
        ]);

        $Invoice  = new Invoice();
        $Invoice->organization_id = $request->organization_id;
        $Invoice->invoice_number  = $request->invoice_number;
        $Invoice->invoice_date = $request->invoice_date;
        $Invoice->accept_by = $request->accept_by;
        $Invoice->payment_type = $request->payment_type;
        $Invoice->total_price = $request->total_price;
        $Invoice->save();
        return response()->json(new InvoiceResource($Invoice),200);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {
        $invoiceFind = Invoice::find($invoice);
        if($invoiceFind){
            return response()->json(new InvoiceResource($invoiceFind),200);
        }
        return response()->json($this->dataError,404);
    }

    /*
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$invoice)
    {
        $invoice = Invoice::find($invoice);
        if($invoice){
            $request->validate([
                'organization_id'=>['required','exists:organizations,id'],
                'invoice_number'=>['required','exists:customers,id'],
                'invoice_date'=>['required'],
                'accept_by'=>['required','exists:users,id'],
                'payment_type'=>['required'],
                'total_price'=>['required']
            ]);
            $invoice->organization_id = $request->organization_id;
            $invoice->invoice_number  = $request->invoice_number;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->accept_by = $request->accept_by;
            $invoice->payment_type = $request->payment_type;
            $invoice->total_price = $request->total_price;
            $invoice->save();
            return response()->json(new InvoiceResource($invoice),200);
      }
      return response()->json($this->dataError,404);

    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($invoice)
    {
        $deleteed = Invoice::find($invoice);
        if($deleteed){
            $deleteed->delete();
            return response()->json($this->dataSuccess,200);
        }
        return response()->json($this->dataError,404);
    }
}