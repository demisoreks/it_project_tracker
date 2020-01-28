<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use Session;
use App\IptVendor;
use App\IptActivity;

class VendorsController extends Controller
{
    public function index() {
        $vendors = IptVendor::all();
        return view('vendors.index', compact('vendors'));
    }
    
    public function create() {
        return view('vendors.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        $existing_vendors = IptVendor::where('name', $input['name']);
        if ($existing_vendors->count() != 0) {
            $error .= "Vendor name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<strong>Oops!</strong><br />'.$error)
                    ->withInput();
        } else {
            $vendor = IptVendor::create($input);
            if ($vendor) {
                if (!isset($_SESSION)) session_start();
                $halo_user = $_SESSION['halo_user'];
                IptActivity::create([
                    'employee_id' => $halo_user->id,
                    'detail' => 'Vendor was created - '.$vendor->name.'.',
                    'source_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                return Redirect::route('vendors.index')
                        ->with('success', '<strong>Successful!</strong><br />Vendor has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<strong>Unknown error!</strong><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(IptVendor $vendor) {
        return view('vendors.edit', compact('vendor'));
    }
    
    public function update(IptVendor $vendor) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        $existing_vendors = IptVendor::where('name', $input['name'])->where('id', '<>', $vendor->id);
        if ($existing_vendors->count() != 0) {
            $error .= "Vendor name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<strong>Oops!</strong><br />'.$error)
                    ->withInput();
        } else {
            if ($vendor->update($input)) {
                if (!isset($_SESSION)) session_start();
                $halo_user = $_SESSION['halo_user'];
                IptActivity::create([
                    'employee_id' => $halo_user->id,
                    'detail' => 'Vendor was updated - '.$vendor->name.'.',
                    'source_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                return Redirect::route('vendors.index')
                        ->with('success', '<strong>Successful!</strong><br />Vendor has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<strong>Unknown error!</strong><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function disable(IptVendor $vendor) {
        $input['active'] = false;
        $vendor->update($input);
        if (!isset($_SESSION)) session_start();
        $halo_user = $_SESSION['halo_user'];
        IptActivity::create([
            'employee_id' => $halo_user->id,
            'detail' => 'Vendor was disabled - '.$vendor->name.'.',
            'source_ip' => $_SERVER['REMOTE_ADDR']
        ]);
        return Redirect::route('vendors.index')
                ->with('success', '<strong>Successful!</strong><br />Vendor has been disabled.');
    }
    
    public function enable(IptVendor $vendor) {
        $input['active'] = true;
        $vendor->update($input);
        if (!isset($_SESSION)) session_start();
        $halo_user = $_SESSION['halo_user'];
        IptActivity::create([
            'employee_id' => $halo_user->id,
            'detail' => 'Vendor was enabled - '.$vendor->name.'.',
            'source_ip' => $_SERVER['REMOTE_ADDR']
        ]);
        return Redirect::route('vendors.index')
                ->with('success', '<strong>Successful!</strong><br />Vendor has been enabled.');
    }
}
