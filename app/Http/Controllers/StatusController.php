<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Company;
use App\Models\Person;
use App\Models\Status;
use App\Models\Pivot;

class StatusController extends Controller
{    

    public function update(Request $request, Project $project)
    {  
        $inputs = $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'person_id' => 'required|exists:people,id'
        ]);

        Pivot::where('project_id', $project->id)
                    ->where('person_id', $inputs['person_id'])
                    ->update(['status_id' => $inputs['status_id']]);

        return back()->with('message', '進捗状況を更新しました');
    }
}
