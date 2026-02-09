<table>
    <thead>
        <?php $i=0; ?>
        @if (count($job->job_requirements)>0)
        @foreach ($job->job_requirements as $jr)
        <?php $i++; ?>
        @endforeach
        @endif
        <tr>
            <th colspan="{{11+$i}}">{{$job->name}} <small>(Created on {{date('M d, Y', strtotime($job->created_at))}})</small></th>
        </tr>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Type</th>
        <th>Address</th>
        <th>CAC Number</th>
        <th>Ownership Type</th>
        <th>Directors</th>
        <th>Vat Number</th>
        <th>Previous Jobs</th>
        <th>Document Submitted</th>
        <th>Date Submitted</th>
        @if (count($job->job_requirements)>0)
        @foreach ($job->job_requirements as $jr)
            <th>
                {{$jr->sys_requirement->name}}
            </th>
        @endforeach
        @endif
    </tr>
    <tr></tr>
    </thead>
    <tbody>
        @if (count($applications) > 0)
        <?php $num=1; ?>
        @foreach ($applications as $app)
        <tr>
            <td>{{$num}}</td>
            <?php $num++; ?>
            <td>{{$app->applicant->name}}</td>
            <td>{{$app->applicant->email}}</td>
            <td>{{$app->applicant->phone}}</td>
            <td>{{$app->applicant->type}}</td>
            <td>{{$app->applicant->address}}</td>
            <td>{{$app->applicant->cac_number ?? "Null"}}</td>
            <td>{{$app->applicant->ownership_type ?? "Null"}}</td>
            <td>
                @if (count($app->applicant->directors)>0)
                    @foreach ($app->applicant->directors as $d)
                        <p class="mb-2">{{$d->name}}, </p>
                    @endforeach
                @else
                  <span>No Directors</span>
                @endif
            </td>
            <td>{{$app->applicant->ownership_type ?? "Null"}}</td>
            <td>
                @if (count($app->applicant->experiences)>0)
                    @foreach ($app->applicant->experiences as $e)
                        <dl class="row">
                            <dd class="col-sm-4">{{$e->name}}</dd>
                            <dd class="col-sm-8">{{date('M d, Y', strtotime($e->start))}} - {{date('M d, Y', strtotime($e->stop))}}</dd>
                        </dl>@endforeach
                @else
                  <span>No Experience</span>
                @endif
            </td>
            <td>
                @if (count($app->application_documents)>0)
                        @foreach ($app->application_documents as $app_doc)
                            <a href="{{route('download_doc', ['id'=>$app_doc->id])}}" target="blank" class="btn btn-primary">{{route('download_doc', ['id'=>$app_doc->id])}}</a><br>
                        @endforeach
                @endif
            </td>
            <td>{{date('M d, Y - h:ma', strtotime($app->created_at))}}</td>
            @if (count($job->job_requirements)>0)
            @foreach ($job->job_requirements as $jr)
                @if (count($app->app_requirements)>0)
                    @foreach ($app->app_requirements as $ar)
                        @if ($ar->sys_id == $jr->sys_id)
                            <td>
                                @if ($ar->type == "Yes/No")
                                    @if ($ar->value == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                @elseif($ar->type == "CheckBox")
                                {{$ar->value == null ? "Not checked":"Checked"}}
                                @else
                                {{$ar->value}}
                                @endif
                            </td>
                        @endif
                    @endforeach
                @else
                <td>nill</td>
                @endif
            @endforeach
            @endif
            {{-- <td></td> --}}

        </tr>
        @endforeach
        @else
        <tr>
            <td>No application found for this job.</td>
        </tr>
        @endif
    </tbody>
</table>