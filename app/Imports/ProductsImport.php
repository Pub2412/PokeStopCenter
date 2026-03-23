<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            if (empty($row['name']) || empty($row['category']) || empty($row['price'])) {
                continue;
            }

            $category = Category::firstOrCreate(
                ['name' => trim((string) $row['category'])],
                ['description' => null]
            );

            $product = Product::updateOrCreate(
                ['name' => trim((string) $row['name'])],
                [
                    'category_id' => $category->id,
                    'description' => (string) ($row['description'] ?? ''),
                    'price' => (float) ($row['price'] ?? 0),
                    'stock' => (int) ($row['stock'] ?? 0),
                    'brand' => (string) ($row['brand'] ?? 'Unknown'),
                    'type' => (string) ($row['type'] ?? 'General'),
                    'is_active' => (bool) ($row['is_active'] ?? true),
                ]
            );

            $imagePaths = $this->parseImagePaths((string) ($row['image_path'] ?? ''));
            if (empty($imagePaths)) {
                continue;
            }

            $uploadedPaths = [];
            foreach ($imagePaths as $imagePath) {
                $sourceFile = $this->resolveSourceFile($imagePath);
                if ($sourceFile === null) {
                    continue;
                }

                $filename = basename($sourceFile);
                $destinationPath = 'product-images/' . uniqid('', true) . '_' . $filename;
                Storage::disk('public')->put($destinationPath, file_get_contents($sourceFile));
                $uploadedPaths[] = $destinationPath;
            }

            // Only replace existing photos when at least one image was successfully imported.
            if (empty($uploadedPaths)) {
                continue;
            }

            $existingPhotos = $product->photos()->get();
            foreach ($existingPhotos as $existingPhoto) {
                if (Storage::disk('public')->exists($existingPhoto->photo_path)) {
                    Storage::disk('public')->delete($existingPhoto->photo_path);
                }
                $existingPhoto->delete();
            }

            foreach ($uploadedPaths as $index => $destinationPath) {
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo_path' => $destinationPath,
                    'is_primary' => $index === 0,
                ]);
            }
        }
    }

    private function parseImagePaths(string $imagePathCell): array
    {
        if (trim($imagePathCell) === '') {
            return [];
        }

        $normalized = str_replace([';', ','], '|', $imagePathCell);
        $parts = array_map('trim', explode('|', $normalized));
        return array_values(array_filter($parts));
    }

    private function resolveSourceFile(string $imagePath): ?string
    {
        $normalizedPath = str_replace('\\', '/', ltrim(trim($imagePath), '/\\'));
        if ($normalizedPath === '') {
            return null;
        }

        $candidates = [
            storage_path('app/private/product-images/' . $normalizedPath),
            storage_path('app/public/product-images/' . $normalizedPath),
            public_path('product-images/' . $normalizedPath),
        ];

        foreach ($candidates as $candidate) {
            if (is_file($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
