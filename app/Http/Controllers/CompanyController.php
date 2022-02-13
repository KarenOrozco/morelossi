<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    protected $workSchedules = [];

    public function index() {
        $companies = Company::where('status', 2)->get();

        return view('companies.index', compact('companies'));
    }

    public function show(Category $category, Company $company = null) {

        if($company){
            $this->getSchedules($company);
            $workSchedules = $this->workSchedules;
            return view('companies.show', compact('company', 'workSchedules'));
        }

        return redirect('directory');
    }

    public function create(Company $company) {
        return view('companies.create', compact('company'));
    }

    public function getSchedules(Company $store) {
        $wschedules =  $store->workSchedules;
        foreach ($wschedules as $value) {
            $schedules = [
                'startTime' => $value->start_time,
                'finishTime' => $value->finish_time,
                'id' => $value->id,
            ];
            $this->getWorkShedulesList($value->day, $schedules);
        }
    }

    public function getWorkShedulesList($day, $schedules) {
        switch ($day) {
            case 1:
                $dayName = 'Lunes';
                break;
            case 2:
                $dayName = 'Martes';
                break;
            case 3:
                $dayName = 'Miércoles';
                break;
            case 4:
                $dayName = 'Jueves';
                break;
            case 5:
                $dayName = 'Viernes';
                break;
            case 6:
                $dayName = 'Sábado';
                break;
            case 7:
                $dayName = 'Domingo';
                break;
            default:
                # code...
                break;
        }

        if(!isset($this->workSchedules[$day])){
            $this->workSchedules[$day] = [
                'dayNumber' => $day,
                'dayName' => $dayName,
                'schedules' => [],
            ];
        }            
        array_push($this->workSchedules[$day]['schedules'],$schedules);
    }

    public function files(Request $request) {
        $url = Storage::put('companies', $request->file('file'));
        //$this->emitTo('afiliation-company','addBanner',$url);

        return $url;
    }
}
