<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Lava;
use App\IptProject;
use App\IptUpdate;

use App\Charts\StatusChart;
use App\Charts\CostChart;

class WelcomeController extends Controller
{
    public function index() {
        /*$project_status_data = Lava::DataTable();
        $project_status_data->addStringColumn('Overdue/On Track')
                ->addNumberColumn('Number of Projects');
        
        $project_status_data->addRow(["On Track", IptProject::where('status', 'A')->where('end_date', '>=', date('Y-m-d'))->count()]);
        $project_status_data->addRow(["Overdue", IptProject::where('status', 'A')->where('end_date', '<', date('Y-m-d'))->count()]);
        
        Lava::PieChart('PSD', $project_status_data, [
            'is3D' => true
        ]);
        
        $project_cost_data = Lava::DataTable();
        $project_cost_data->addStringColumn('Project');
        $project_cost_data->addNumberColumn('Budget');
        $project_cost_data->addNumberColumn('Spent');
        
        foreach (IptProject::where('status', 'A')->get() as $project) {
            $project_cost_data->addRow([$project->name, $project->budget, IptUpdate::where('project_id', $project->id)->sum('amount_spent')]);
        }
        
        Lava::ColumnChart('PCD', $project_cost_data, [
            
        ]);*/
        
        $status = new StatusChart();
        $status->labels(['On Track', 'Overdue']);
        $project_status = [
            IptProject::where('status', 'A')->where('end_date', '>=', date('Y-m-d'))->count(),
            IptProject::where('status', 'A')->where('end_date', '<', date('Y-m-d'))->count()
        ];
        $status_colors = [
            '#4285f4',
            '#ff4444'
        ];
        $status->dataset('On Track/Overdue', 'doughnut', $project_status)->backgroundColor($status_colors);
        
        $cost = new CostChart();
        $cost_labels = [];
        $cost_budget = [];
        $cost_spent = [];
        $i = 0;
        foreach (IptProject::where('status', 'A')->get() as $project) {
            $cost_labels[$i] = $project->name;
            $cost_budget[$i] = $project->budget;
            $cost_spent[$i] = IptUpdate::where('project_id', $project->id)->sum('amount_spent');
            $i ++;
        }
        $cost->labels($cost_labels);
        $cost->dataset('Budget', 'bar', $cost_budget)->color('#0d47a1')->backgroundColor('#4285f4');
        $cost->dataset('Spent', 'bar', $cost_spent)->color('#cc0000')->backgroundColor('#ff4444');
        $cost->title('Project Expense Performance');
        
        return view('index', compact('status', 'cost'));
    }
    
    static function checkAccess() {
        if (!isset($_SESSION)) session_start();
        if (isset($_SESSION['halo_user'])) {
            return true;
        } else {
            return false;
        }
    }
}
