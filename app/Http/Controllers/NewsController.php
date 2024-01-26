<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsIndexRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    const FILTERED_FIELDS = [
        'id',
        'search',
        'title',
        'description',
        'author',
        'category',
        'status',
        'start_date',
        'end_date',
        'main',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(NewsIndexRequest $request): JsonResponse
    {
        $filters = $request->only(self::FILTERED_FIELDS);
        $sortBy = $request->input('sort_by', News::DEFAULT_SORT_FIELD);
        $sortOrder = $request->input('sort_order', News::DEFAULT_SORT_DIRECTION);
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);

        $query = News::query();

        $this->applyFilters($query, $filters);
        $query->orderBy($sortBy, $sortOrder);

        $query->limit($limit);
        $query->offset(($page - 1) * $limit);

        $newsItems = $query->get()->each(function (News $news) {
            $news->image = asset($news->image);
        });

        $paginator = new LengthAwarePaginator(
            $newsItems,
            $newsItems->count(),
            $limit,
            $page
        );


        return response()->json($paginator, 200);
    }

    /**
     * Применить фильтры к запросу новостей.
     *
     * @param Builder $query
     * @param array $filters
     * @return void
     */
    private function applyFilters(Builder $query, array $filters): void
    {
        foreach ($filters as $field => $value) {
            if (!in_array($field, self::FILTERED_FIELDS)) {
                continue;
            }
            switch ($field) {
                case 'start_date':
                    $query->whereDate('created_at', '>=', $value);
                    break;
                case 'end_date':
                    $query->whereDate('created_at', '<=', $value);
                    break;
                case 'search':
                    $this->applySearchFilter($query, $value);
                    break;
                default:
                    $query->where($field, $value);
            }
        }
    }

    /**
     * Применить фильтр поиска к запросу новостей.
     *
     * @param Builder $query
     * @param string $searchTerm
     * @return void
     */
    private function applySearchFilter(Builder $query, string $searchTerm): void
    {
        $query->where(function ($subQuery) use ($searchTerm) {
            $subQuery->where('title', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('content', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Обработка изображения, если оно загружено
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $data['image'] = $imagePath;
        }

        $news = News::create($data);

        return response()->json(['data' => $news], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): JsonResponse
    {
        return response()->json(['data' => $news], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news): JsonResponse
    {
        $data = $request->validated();

        // Обработка изображения, если оно загружено
        if ($request->hasFile('image')) {
            // Удаление предыдущего изображения, если оно существует
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            $imagePath = $request->file('image')->store('news_images', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        return response()->json(['data' => $news], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        // Удаление изображения, если оно существует
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return response()->json([], 204); // No Content
    }
}
