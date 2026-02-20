<?php

namespace App\Exports;

use App\Models\Bid;
use App\Models\Job;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BidExport implements FromView
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $applications = Bid::with(['applicant', 'app_requirements', 'application_documents'])
            ->where('tender_id', '=', $this->id)
            ->get();
        $job = Job::find($this->id);

        return view('exports.apps', [
            'applications' => $applications,
            'job' => $job,
        ]);
    }
}
