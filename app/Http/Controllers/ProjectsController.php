<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use Redirect;
use Session;
use Lava;
use App\IptProject;
use App\IptActivity;
use App\IptComponent;
use App\IptUpdate;

class ProjectsController extends Controller
{
    public function index() {
        $projects = IptProject::all();
        return view('projects.index', compact('projects'));
    }
    
    public function create() {
        return view('projects.create');
    }
    
    public function store() {
        $input = Input::all();
        $error = "";
        $existing_projects = IptProject::where('name', $input['name']);
        if ($existing_projects->count() != 0) {
            $error .= "Project name already exists.<br />";
        }
        if ($input['end_date'] < $input['start_date']) {
            $error .= "Specified end date is before the start date.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<strong>Oops!</strong><br />'.$error)
                    ->withInput();
        } else {
            $project = IptProject::create($input);
            if ($project) {
                if (!isset($_SESSION)) session_start();
                $halo_user = $_SESSION['halo_user'];
                IptActivity::create([
                    'employee_id' => $halo_user->id,
                    'detail' => 'Project was created - '.$project->name.'.',
                    'source_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                return Redirect::route('projects.index')
                        ->with('success', '<strong>Successful!</strong><br />Project has been created.');
            } else {
                return Redirect::back()
                        ->with('error', '<strong>Unknown error!</strong><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function edit(IptProject $project) {
        return view('projects.edit', compact('project'));
    }
    
    public function update(IptProject $project) {
        $input = array_except(Input::all(), '_method');
        $error = "";
        $existing_projects = IptProject::where('name', $input['name'])->where('id', '<>', $project->id);
        if ($existing_projects->count() != 0) {
            $error .= "Project name already exists.<br />";
        }
        if ($error != "") {
            return Redirect::back()
                    ->with('error', '<strong>Oops!</strong><br />'.$error)
                    ->withInput();
        } else {
            if ($project->update($input)) {
                if (!isset($_SESSION)) session_start();
                $halo_user = $_SESSION['halo_user'];
                IptActivity::create([
                    'employee_id' => $halo_user->id,
                    'detail' => 'Project was updated - '.$project->name.'.',
                    'source_ip' => $_SERVER['REMOTE_ADDR']
                ]);
                return Redirect::route('projects.index')
                        ->with('success', '<strong>Successful!</strong><br />Project has been updated.');
            } else {
                return Redirect::back()
                        ->with('error', '<strong>Unknown error!</strong><br />Please contact administrator.')
                        ->withInput();
            }
        }
    }
    
    public function summary() {
        return view('projects.summary');
    }
    
    public function breakdown(IptProject $project) {
        $total_weight = 0;
        $total_score = 0;
        $weighted_average = 0;
        $updates1 = IptUpdate::where('project_id', $project->id)->orderBy('tracking_date', 'desc');
        if ($updates1->count() > 0) {
            $last_update = $updates1->first();
            $component_updates = json_decode($last_update->component_updates, true);
            foreach ($component_updates as $component_update) {
                $component = IptComponent::whereId($component_update['component_id'])->first();
                $last_score = $component_update['percentage'];
                $score = ($last_score/100)*$component->weight;
                $total_score += $score;
                $total_weight += $component->weight;
            }
            if ($total_weight > 0) {
                $weighted_average = number_format(($total_score/$total_weight)*100);
            }
        }
        
        /*$percent_data = Lava::DataTable();
        $percent_data->addStringColumn('Percentage');
        $percent_data->addNumberColumn('Value');
        
        $percent_data->addRow(['%', $weighted_average]);
        
        Lava::GaugeChart('PD', $percent_data, [
            'yellowFrom' => 0,
            'yellowTo' => 79,
            'greenFrom' => 80,
            'greenTo' => 100,
            'majorTicks' => [
                'Start',
                'End'
            ]
        ]);*/
        
        $updates = IptUpdate::where('project_id', $project->id)->get();
        
        return view('projects.breakdown', compact('project', 'updates', 'weighted_average'));
    }
}
