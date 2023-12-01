<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * 
     * @return void
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * Get the categories with sub categories.
     * 
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubCategories(string $slug): JsonResponse
    {
        return $this->response('categories', $this->categoryRepository->getSubCategories($slug));
    }
}
