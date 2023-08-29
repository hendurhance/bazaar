<?php

namespace App\Http\Controllers\API;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function getSubCategories(string $slug)
    {
        return response()->json([
            'categories' => $this->categoryRepository->getSubCategories($slug),
        ]);
    }
}
