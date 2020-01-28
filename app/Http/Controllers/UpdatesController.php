<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use App\IptProject;
use App\IptUpdate;
use App\IptComponent;
use App\IptActivity;

class UpdatesController extends Controller
{
    public function index(IptProject $project) {
        $updates = IptUpdate::where('project_id', $project->id)->get();
        return view('updates.index', compact('project', 'updates'));
    }
    
    public function create(IptProject $project) {
        $last_update = [];
        $components = IptComponent::where('project_id', $project->id)->orderBy('order_no')->get();
        $updates = IptUpdate::where('project_id', $project->id)->orderBy('tracking_date', 'desc');
        if ($updates->count() > 0) {
            $update = $updates->first();
        }
        foreach ($components as $component) {
            $last_update[$component->id] = 0;
            if (isset($update)) {
                $component_updates = json_decode($update->component_updates, true);
                foreach ($component_updates as $component_update) {
                    if ($component_update['component_id'] == $component->id) {
                        $last_update[$component->id] = $component_update['percentage'];
                        break;
                    }
                }
            }
        }
        return view('updates.create', compact('project', 'last_update', 'components'));
    }
    
    public function store(IptProject $project) {
        $input = Input::all();
        $components = IptComponent::where('project_id', $project->id)->orderBy('order_no')->get();
        $component_updates = [];
        foreach ($components as $component) {
            array_push($component_updates, [
                'component_id' => $component->id,
                'description' => $component->description,
                'percentage' => $input[$component->id],
                'order_no' => $component->order_no
            ]);
            unset($input[$component->id]);
        }
        $input['component_updates'] = json_encode($component_updates);
        $input['project_id'] = $project->id;
        
        if (!isset($_SESSION)) session_start();
        $halo_user = $_SESSION['halo_user'];
        $input['employee_id'] = $halo_user->id;
        
        $update = IptUpdate::create($input);
        if ($update) {
            IptActivity::create([
                'employee_id' => $halo_user->id,
                'detail' => 'Update was created  for '.$project->name.'.',
                'source_ip' => $_SERVER['REMOTE_ADDR']
            ]);
            return Redirect::route('projects.updates.index', $project->slug())
                    ->with('success', '<strong>Successful!</strong><br />Update has been created.');
        } else {
            return Redirect::back()
                    ->with('error', '<strong>Unknown error!</strong><br />Please contact administrator.')
                    ->withInput();
        }
    }
}
