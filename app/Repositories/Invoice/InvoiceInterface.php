<?php
 namespace App\Repositories\Invoice;

 interface InvoiceInterface
 {
 	public function invoiceNo();
 	public function invoiceInfo($request); 
 	public function saveInvoice($request);
 	public function invoiceLists($request);
 	public function invoiceDetails($request);
 }