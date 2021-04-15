<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ProjectResource::collection(
            Project::query()->paginate(25)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return ProjectResource
     */
    public function show(Project $project): ProjectResource
    {
        return ProjectResource::make($project);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return ProjectResource
     */
    public function store(ProjectRequest $request): ProjectResource
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Project $project */
        $project = DB::transaction(function () use ($request, $user) {
            /** @var Project $project */
            $project = $user->projects()->create($request->validated());
            $project->costMethodCalculation()->create();
            $project->competitiveMethodCalculation()->create();
            $project->revenueMethodCalculation()->create();
            return $project;
        });

        return ProjectResource::make($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return ProjectResource
     */
    public function update(ProjectRequest $request, Project $project): ProjectResource
    {
        $project->update($request->validated());
        return ProjectResource::make($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Response
     * @throws Exception
     */
    public function destroy(Project $project): Response
    {
        $project->delete();
        return response(null, 204);
    }
}
