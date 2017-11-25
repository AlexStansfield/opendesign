<?php

namespace App\Http\Controllers;

use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Project;
use App\Services\GitHubService;
use Illuminate\Http\Request;

/**
 * Class ProjectController
 * @package App\Http\Controllers\
 */
class ProjectController extends Controller
{
    /**
     * @var GitHubService
     */
    private $gitHubService;

    /**
     * AuthController constructor.
     * @param GitHubService $gitHubService
     */
    public function __construct(GitHubService $gitHubService)
    {
        $this->gitHubService = $gitHubService;
    }

    /**
     * @param Request $request
     * @return Project|\Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'repo' => 'required|regex:/\S+\/\S+/'
        ]);

        // Go Get the Repo
        $gitHubRepo = $this->gitHubService->getRepo($request->input('repo'));

        // Check it's not null (we got a 40x)
        if (null === $gitHubRepo) {
            return response()->json(['message' => 'GitHub Repo Not Found'], 400);
        }

        // Check it doesn't already exist
        $existingProject = Project::where('github_id', $gitHubRepo->id)->first();
        if (null !== $existingProject) {
            return response()->json(['message' => 'Project already exists'], 400);
        }

        // Create the Project
        $project = new Project();
        $project->github_id = $gitHubRepo->id;
        $project->name = $gitHubRepo->full_name;
        $project->avatar = $gitHubRepo->owner->avatar_url;
        $project->repo = $gitHubRepo->html_url;
        $project->description = $gitHubRepo->description;
        $project->type = 'web';
        $project->link = $gitHubRepo->html_url;
        $project->save();


        ProjectResource::withoutWrapping();
        return response()->json(new ProjectResource($project), 201);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, Application');
        return new ProjectCollection(Project::all());
    }

    /**
     * @param $id
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getOne($id)
    {
        $project = Project::find($id);

        if (null === $project) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        ProjectResource::withoutWrapping();
        return new ProjectResource($project);
    }
}
