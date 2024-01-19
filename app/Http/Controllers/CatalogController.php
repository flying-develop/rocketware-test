<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Symfony\Component\HttpFoundation\JsonResponse;

class CatalogController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $products = Product::query()
            ->with('properties')
            ->filtered()
            ->paginate(40);

        return new JsonResponse($products);

    }
}