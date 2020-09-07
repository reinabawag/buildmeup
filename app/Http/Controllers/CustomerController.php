<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Session;
use Auth;
use Carbon;
use DB;

class CustomerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (Auth::user()->hasAnyRole('approver')) {
			if (Auth::user()->department->name == 'Treasury') {
				$customers = Customer::whereIn('status', ['final'])->where(function($query) {
					$query->where('treasury_user_id', Auth::id())->orWhere('treasury_user_id', null);
				})->get();
			} else {
				$customers = Customer::whereIn('status', ['final'])->where(function($query) {
					$query->where('credit_user_id', Auth::id())->orWhere('credit_user_id', null);
				})->get();
			}

			foreach($customers as $customer) {
				if (Auth::user()->department->name == 'Treasury') 
					$customer->status = $customer->treasury_is_approved && ($customer->treasury_user_id == Auth::id()) ? 'approved' : 'for approval';
				else 
					$customer->status = $customer->credit_is_approved && ($customer->credit_user_id == Auth::id()) ? 'approved' : 'for approval';
			}

			if (Auth::user()->department->name == 'Treasury') 
				$approvedCustomers = Customer::where('treasury_user_id', Auth::id())->get();
			else
				$approvedCustomers = Customer::where('credit_user_id', Auth::id())->get();		

			return view('customer.index')->with(['customers' => $customers, 'approvedCustomers' => $approvedCustomers]);
		}
		
		$customer = Customer::whereIn('status', ['final', 'draft'])->where(function($query) {
			$query->where('treasury_user_id', null)->orWhere('credit_user_id', null);
		})->where('user_id', Auth::id())->get();		
		
		$approvedCustomers = Customer::where('user_id', Auth::id())->where('treasury_user_id', '!=', null)->where('credit_user_id', '!=', null)->get();

		return view('customer.index')->with(['customers' => $customer, 'approvedCustomers' => $approvedCustomers]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('customer.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CustomerRequest $request)
	{
		$customer = new Customer;

		$customer->code				= $request->code;
		$customer->name 			= $request->name;
		$customer->addr1 			= $request->addr1;
		$customer->addr2			= $request->addr2;
		$customer->addr3 			= $request->addr3;
		$customer->addr4			= $request->addr4;
		$customer->city 			= $request->city;
		$customer->zip				= $request->zip;
		$customer->region 			= $request->region;
		$customer->industry			= $request->industry;
		$customer->slsman			= $request->slsman;
		$customer->terms 			= $request->terms;
		$customer->overdue_days		= $request->overdue_days;
		$customer->overdue_amt		= $request->overdue_amt;
		$customer->terms_days		= $request->terms_days;
		$customer->order_contact	= $request->order_contact;
		$customer->contact_phone	= $request->contact_phone;
		$customer->fax				= $request->fax;
		$customer->billing_contact	= $request->billing_contact;
		$customer->billing_phone	= $request->billing_phone;
		$customer->vat_code			= $request->vat_code;
		$customer->ewt_code			= $request->ewt_code;
		$customer->tin_code			= $request->tin_code;
		$customer->remarks			= $request->remarks;
		$customer->user_id			= Auth::id();
		$customer->status			= $request->status;

		$customer->save();

		return redirect()->route('customer.index')->withSuccess('Customer buildup created!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Customer  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function show(Customer $customer)
	{
		dd($customer);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Customer  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Customer $customer)
	{
		return view('customer.edit')->withCustomer($customer);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Customer  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function update(CustomerRequest $request, Customer $customer)
	{
		if ($request->is_approved) {
			if (Auth::user()->check_if_department(['Treasury'])) {
				$customer->treasury_is_approved = true;
				$customer->treasury_user_id = Auth::id();
				$customer->treasury_approved_at = Carbon\Carbon::now();
			} else {
				$customer->credit_is_approved = true;
				$customer->credit_user_id = Auth::id();
				$customer->credit_approved_at = Carbon\Carbon::now();
			}

			if ($customer->treasury_is_approved && $customer->credit_is_approved) {
				$customer->status = 'approved';
			}
			
			$customer->save();

			return redirect()->route('customer.index')->withSuccess("Customer $customer->name approved!");
		}

		$customer->code				= $request->code;
		$customer->name 			= $request->name;
		$customer->addr1 			= $request->addr1;
		$customer->addr2			= $request->addr2;
		$customer->addr3 			= $request->addr3;
		$customer->addr4			= $request->addr4;
		$customer->city 			= $request->city;
		$customer->zip				= $request->zip;
		$customer->region 			= $request->region;
		$customer->industry			= $request->industry;
		$customer->slsman			= $request->slsman;
		$customer->terms 			= $request->terms;
		$customer->overdue_days		= $request->overdue_days;
		$customer->overdue_amt		= $request->overdue_amt;
		$customer->terms_days		= $request->terms_days;
		$customer->order_contact	= $request->order_contact;
		$customer->contact_phone	= $request->contact_phone;
		$customer->fax				= $request->fax;
		$customer->billing_contact	= $request->billing_contact;
		$customer->billing_phone	= $request->billing_phone;
		$customer->vat_code			= $request->vat_code;
		$customer->ewt_code			= $request->ewt_code;
		$customer->tin_code			= $request->tin_code;
		$customer->remarks			= $request->remarks;
		$customer->status			= $request->status;

		$customer->save();

		return redirect()->route('customer.index')->withSuccess('Customer updated!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Customer  $customer
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Customer $customer)
	{
		$customer->delete();

		// $customer = Customer::withTrashed()->where('id', 1)->find();
		// $customer->restore();

		return redirect()->back()->withSuccess('Customer removed!');
	}
}
