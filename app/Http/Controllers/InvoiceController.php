<?php

namespace App\Http\Controllers;
use App\Repositories\Invoice\InvoiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\SaveInvoiceRequest;

class InvoiceController extends Controller
{   

	protected $invoice;

	public function __construct(InvoiceInterface $invoice)
	{
		$this->invoice = $invoice;
	}

    public function getInvoiceNo()
    {
    	$invoiceNo = $this->invoice->invoiceNo();
    	return $invoiceNo;
    }

    public function invoiceInfo(Request $request)
    {
    	$invoiceInfo = $this->invoice->invoiceInfo($request);
    	return $invoiceInfo;
    }

    public function saveInvoice(SaveInvoiceRequest $request)
    {
    	$saveInvoice = $this->invoice->saveInvoice($request);
    	return $saveInvoice;
    }

    public function invoiceLists(Request $request)
    {
        $invoices = $this->invoice->invoiceLists($request)->latest()->paginate(10);
        return response()->json([
                'success' => $invoices->total() > 0,
                'message' => $invoices->total() > 0 ? 'Data found' : 'No data found',
                'total' => count($invoices),
                'data' => $invoices
        ]);
    }

    public function invoiceDetails(Request $request)
    {
    	$invoiceDetails = $this->invoice->invoiceDetails($request);
    	return $invoiceDetails;
    }
}
