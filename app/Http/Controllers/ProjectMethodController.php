<?php

namespace App\Http\Controllers;

use App\Http\Requests\Methods as Methods;
use App\Http\Resources\ProjectResource;
use App\Models\Methods\CompetitiveMethodCalculation;
use App\Models\Methods\CostMethodCalculation;
use App\Models\Methods\RevenueMethodCalculation;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectMethodController extends Controller
{
    /**
     * @param Project $project
     * @param Methods\CostMethodRequest $request
     * @return ProjectResource
     */
    public function costMethod(Project $project, Methods\CostMethodRequest $request): ProjectResource
    {
        DB::transaction(function () use (&$project, &$request) {
            /** @var CostMethodCalculation $costMethod */
            $costMethod = $project->costMethodCalculation()->updateOrCreate([], [
                'percentage_of_cost' => $request->get('percentage_of_cost')
            ]);
            $costMethod->values()->delete();
            $costMethod->values()->createMany(
                collect($request->get('sum'))->map(function ($value, $key) {
                    return compact('value', 'key');
                })
            );
        });

        $project->refresh();
        return ProjectResource::make($project);
    }

    /**
     * @param Project $project
     * @param Methods\RevenueMethodRequest $request
     * @return ProjectResource
     */
    public function revenueMethod(Project $project, Methods\RevenueMethodRequest $request): ProjectResource
    {
        DB::transaction(function () use (&$project, &$request) {
            /** @var RevenueMethodCalculation $revenueMethod */
            $revenueMethod = $project->revenueMethodCalculation()->updateOrCreate([], [
                'discount_rate' => $request->get('discount_rate')
            ]);
            $revenueMethod->periods()->delete();
            $revenueMethod->periods()->createMany(
                collect($request->get('periods'))->map(function ($data, $index) {
                    return array_merge($data, compact('index'));
                })
            );
        });

        $project->refresh();
        return ProjectResource::make($project);
    }

    /**
     * @param Project $project
     * @param Methods\CompetitiveMethodRequest $request
     * @return ProjectResource
     */
    public function competitiveMethod(Project $project, Methods\CompetitiveMethodRequest $request): ProjectResource
    {
        DB::transaction(function () use (&$project, &$request) {
            /** @var CompetitiveMethodCalculation $competitiveMethod */
            $competitiveMethod = $project->competitiveMethodCalculation()->updateOrCreate([]);

            $competitiveMethod->parameters()->delete();
            $competitiveMethod->parameters()->createMany(
                collect($request->get('parameters'))->map(function ($data, $index) {
                    return array_merge($data, compact('index'));
                })
            );

            $competitiveMethod->values()->delete();
            $competitiveMethod->values()->createMany(
                collect($request->get('values'))->map(function ($value, $key) {
                    return compact('value', 'key');
                })
            );
        });

        $project->refresh();
        return ProjectResource::make($project);
    }
}
