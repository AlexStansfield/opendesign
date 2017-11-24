<?php

namespace App\Http\Controllers;

use App\Services\GitHubService;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(Request $request)
    {
        // Get Code from Request
        $code = $request->input('code');

        // Convert Code to Access Token
        $accessToken = $this->gitHubService->obtainAccessToken($code);

        // Get User Details from GitHub
        $this->gitHubService->setAccessToken($accessToken);
        $gitHubUser = $this->gitHubService->getUser();

        // Search for Existing User
        $user = User::where('github_id', $gitHubUser->id)->first();

        // Create User if not exist
        if (null === $user) {
            $user = new User();
            $user->username = $gitHubUser->login;
            $user->github_id = $gitHubUser->id;
        }

        // Update Token and Save
        $user->github_token = $accessToken;
        $user->save();

        // Oauth Stuff
        $token = $user->createToken('AuthToken')->accessToken;

        // Return OAuth Token
        return response()->json(['access_token' => $token], 201);
    }

    public function test()
    {
        return response()->json(['success' => 'fuck yes!']);
    }
}
