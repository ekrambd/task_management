<?php
 namespace App\Repositories\Invoice;
 use App\Repositories\Project\ProjectInterface;
 use App\Models\Invoice;
 use App\Models\Project;
 use Auth;

 class InvoiceRepository implements InvoiceInterface
 {
 	public function invoiceNo()
 	{
 		try
 		{
 			$count = Invoice::count();
 			$count+=1;
            $invoice_no = "INV-".date('y')."00".$count;
 			return response()->json(['success'=>true, 'invoice_no'=>$invoice_no]);
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function invoiceInfo($request)
 	{
 		try
 		{      
 			   $projects = Project::where('client_id', $request->client_id)
                            ->whereNotIn('status', ['Pending', 'Cancel'])
                            ->get();

                return response()->json([
                    'success' => count($projects) > 0,
                    'subtotal' => invoiceSubTotal($request), 
                    'message' => count($projects) > 0 ? 'Data found' : 'No data found',
                    'total_projects' => count($projects),
                    'data' => $projects
                ]);

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

 	public function saveInvoice($request)
 	{
 		try
 		{
 			$invoice = new Invoice();
 			$invoice->user_id = Auth::user()->id;
 			$invoice->client_id = $request->client_id;
 			$invoice->invoice_no = $request->invoice_no;
 			$invoice->invoice_date = $request->invoice_date;
 			$invoice->subtotal = $request->subtotal;
 			$invoice->discount = $request->has('discount')?$request->discount:0;
 			$invoice->total = $request->total;
 			$invoice->pay = $request->pay;
 			$invoice->due = $request->due;
 			$invoice->save();

 			return response(['success'=>true, 'message'=>'Successfully an invoice has been save']);

 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}

    public function invoiceLists($request)
    {
        try
        {
            $query = Invoice::query();

            if($request->has('search') && !empty($request->search))
            {
                $search = $request->search;
                $query->where('invoices.invoice_no', 'LIKE', "%$search%");
            }

            if($request->has('start_date') && $request->has('end_date'))
            {
                $query->whereBetween('invoices.invoice_date', [$request->start_date, $request->end_date]);
            }

            if($request->has('start_date'))
            {
                $query->where('invoices.date', '>=', $request->start_date);
            }

            if($request->has('end_date'))
            {
                $query->where('invoices.date', '<=', $request->end_date);
            }

            if($request->has('client_id'))
            {
                $query->where('client_id',$request->client_id);
            }

            $invoices = $query->with('client')->select('*');

            return $invoices;

        }catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
    }

 	public function invoiceDetails($request)
 	{
 		try
 		{
 			$invoice = Invoice::with('client.projects')->findorfail($request->invoice_id);
 			return response()->json(['success'=>true, 'data'=>$invoice]);
 			
 		}catch(Exception $e){

            $code = $e->getCode();           
            return response()->json(['message'=>'Something went wrong', 'execption_code'=>$code]);
        }
 	}
 }

