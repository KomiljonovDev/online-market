<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\MorphMany;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Products';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('name'),
            Textarea::make('description'),
            Number::make('price'),
            Number::make('sale_price'),
            BelongsTo::make(
                'Category',
                'category',
                fn($item) => $item->id . '. ' . $item->name,
                CategoryResource::class
            ),
            Number::make('quantity'),
            BelongsTo::make(
                'Volume',
                'volume',
                fn ($item) => $item->id . '-' . $item->name,
                ProductVolumeResource::class),
            MorphMany::make('Images', 'images')
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('name'),
                Textarea::make('description'),
                Number::make('price'),
                Number::make('sale_price'),
                BelongsTo::make(
                    'Category',
                    'category',
                    fn($item) => $item->id . '. ' . $item->name,
                    CategoryResource::class
                ),
                Number::make('quantity'),
                BelongsTo::make(
                    'Volume',
                    'volume',
                    fn ($item) => $item->id . '-' . $item->name,
                    ProductVolumeResource::class),
                MorphMany::make('Images', 'images', )
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('name'),
            Textarea::make('description'),
            Number::make('price'),
            Number::make('sale_price'),
            BelongsTo::make(
                'Category',
                'category',
                fn($item) => $item->id . '. ' . $item->name,
                CategoryResource::class
            ),
            Number::make('quantity'),
            BelongsTo::make(
                'Volume',
                'volume',
                fn ($item) => $item->id . '-' . $item->name,
                ProductVolumeResource::class),
            MorphMany::make('Images', 'images')
        ];
    }

    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
