<?php

namespace App\Exports;

use App\Models\Applicant;
use App\Models\Bid;
use App\Models\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicationExport implements FromView
{
    public $id;

    public function __construct($id) {
        $this->id = $id;
    }
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection()
    // {
    //     return Application::all();
    // }
    public function view(): View
    {
        $applications = Bid::where('tender_id', '=', $this->id)->get();
        $job = Job::find($this->id);

        return view('exports.apps', [
            'applications' => $applications,
            'job' => $job,
        ]);
    }
}
