<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Attribute;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::query()
            ->with('parameters')
            //->paginate(20);
            ->get();

        return response()->json([
            'data' => $projects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return ProjectResource
     */
    public function store(ProjectRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var Project $project */
        $project = $user->projects()
            ->create([
                'name' => $request->get('name'),
                'description' => $request->get('description', ''),
            ]);

        $project->parameters()
            ->sync($this->getParameters($request));

        $project->refresh();

        return ProjectResource::make((object)[
            'parameters' => Attribute::all(),
            'project' => $project,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return ProjectResource
     */
    public function show(Project $project)
    {
        return ProjectResource::make((object)[
            'parameters' => Attribute::all(),
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return ProjectResource
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update([
            'name' => $request->get('name'),
            'description' => $request->get('description', '')
        ]);

        $project->parameters()
            ->sync($this->getParameters($request));

        $project->refresh();

        return ProjectResource::make((object)[
            'parameters' => Attribute::all(),
            'project' => $project,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response(null, 204);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    protected function getParameters(Request $request)
    {
        return collect($request->get('parameters'))
            ->keyBy('id')
            ->map(function ($item) {
                return [
                    'value' => $item['value']
                ];
            });
    }
}
