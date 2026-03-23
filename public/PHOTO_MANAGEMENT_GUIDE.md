# Photo Management System for Excel Import

## Overview

This system allows admins to bulk import product and user photos through Excel spreadsheets. Photos are organized in a dedicated folder structure for easy management.

## Folder Structure

```
PkStop/
├── storage/
│   └── app/
│       └── private/
│           └── product-images/          ← Place product images here
│               ├── category-name/        (organize by category)
│               │   ├── booster_pack.jpg
│               │   ├── trading_cards.jpg
│               │   └── rare_card.jpg
│               ├── pikachu_plush.jpg
│               ├── charizard_figure.jpg
│               └── ...
│
├── public/
│   └── storage/
│       └── products/                     ← Auto-generated (production storage)
│           ├── 507f191e_pikachu.jpg
│           ├── 507f192a_charizard.jpg
│           └── ...
```

## Step 1: Prepare Your Images

### Option A: Flat Structure (Easiest)
Place all images directly in `storage/app/private/product-images/`:
```
storage/app/private/product-images/
├── booster_pack.jpg
├── pikachu_plush.jpg
├── charizard_figure.jpg
└── pokedex_device.jpg
```

### Option B: Organized by Category
```
storage/app/private/product-images/
├── Cards/
│   ├── booster_pack.jpg
│   └── mewtwo_card.jpg
├── Toys/
│   ├── pikachu_plush.jpg
│   └── eevee_set.jpg
└── Electronics/
    └── pokedex_device.jpg
```

In Excel, reference them as:
- Flat: `booster_pack.jpg`
- By category: `Cards/booster_pack.jpg`

## Step 2: Update Excel Template

Add an `image_path` column (optional) with filenames:

```
name,category,price,stock,brand,type,description,is_active,image_path
Pikachu Plush Toy,Toys,350,30,Official Pokémon,Plush,Soft cuddly Pikachu,1,pikachu_plush.jpg
Charizard Figure,Collectibles,550,20,Bandai,Figure,Detailed figure,1,Collectibles/charizard_figure.jpg
Booster Pack,Cards,450,50,The Pokémon Company,Booster,Random cards,1,Cards/booster_pack.jpg
```

## Step 3: Upload Process

### Phase 1: Prepare Images
1. Copy product image files to `storage/app/private/product-images/`
2. Organize by category if desired (create subfolders)
3. Use simple filenames (no spaces, lowercase preferred)

### Phase 2: Excel Template
1. Download updated template from Admin > Products
2. Fill in product info
3. Add image filenames in `image_path` column
4. Leave blank for products without images

### Phase 3: Import
1. Navigate to Admin Panel > Products
2. Click "Import Excel" button
3. Select your Excel file
4. Click Upload
5. System will:
   - Create/update products
   - Copy images from `storage/app/private/product-images/` to `public/storage/products/`
   - Link images to products automatically

## File Types Supported

- ✅ **Recommended**: JPG, PNG, GIF, WebP
- ✅ **Also works**: BMP, TIFF
- ❌ **Not supported**: SVG (needs conversion)

**File Size Limits**:
- Max 5MB per image (recommended)
- Total import: Handle up to 100 images per session

## Image Naming Best Practices

✅ **Good**:
- `pikachu_plush.jpg`
- `card_booster_set.png`
- `electronic_pokedex.jpg`

❌ **Avoid**:
- `My Photo (1).jpg` (spaces & parentheses)
- `Pikachu_2023_NEW_VERSION.png` (too long)
- `image.jpg` (not descriptive)

## Column Reference

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| name | Text | ✅ | Product name |
| category | Text | ✅ | Will auto-create if missing |
| price | Number | ✅ | In Philippine Pesos |
| stock | Number | ❌ | Quantity (default: 0) |
| brand | Text | ❌ | Brand name (default: "Unknown") |
| type | Text | ❌ | Product type (default: "General") |
| description | Text | ❌ | Product details |
| is_active | Number | ❌ | 1 = active, 0 = inactive (default: 1) |
| **image_path** | Text | ❌ | **NEW: Image filename** |

## Workflow Example

### Before Import
```
storage/app/private/product-images/
├── pikachu.jpg
├── charizard.jpg
└── eevee.jpg
```

### Excel File
```csv
name,category,price,is_active,image_path
Pikachu Figure,Collectibles,500,1,pikachu.jpg
Charizard Figure,Collectibles,550,1,charizard.jpg
Eevee Figure,Collectibles,480,1,eevee.jpg
```

### After Import
```
public/storage/products/
├── 507f191e_pikachu.jpg
├── 507f192a_charizard.jpg
└── 507f192b_eevee.jpg
```

Product table linked with unique IDs ✅

## Troubleshooting

### "Image not found" during import
- ✓ Check filename spelling matches exactly
- ✓ Verify file exists in `storage/app/private/product-images/`
- ✓ Check file extension (.jpg vs .png)
- ✓ File permission issue? Ensure readable

### Image uploaded but not showing
- ✓ Hard refresh browser (Ctrl+Shift+R)
- ✓ Clear Laravel cache: `php artisan optimize:clear`
- ✓ Check image path actual exist in `public/storage/`

### File size too large
- ✓ Compress images to 1-2MB before import
- ✓ Use tools: TinyPNG, ImageOptim, or Photoshop
- ✓ Recommended: 800x800px to 1200x1200px

## Advanced: Cleanup Unused Images

After importing, remove staging images:
```bash
rm -rf storage/app/private/product-images/*
```

Or keep them as backup (uses ~500MB per 100 images).

## Security Notes

- Images stored in `/storage/app/private/` are **not public by default**
- After import, images moved to `/public/storage/products/`
- Only uploaded files can be imported (no URL fetch)
- Filenames sanitized to prevent injection attacks

## Quick Start Checklist

- [ ] Create `/storage/app/private/product-images/` folder
- [ ] Copy your product images there
- [ ] Download template from Admin > Products
- [ ] Add `image_path` column with filenames
- [ ] Fill product data rows
- [ ] Save as `.xlsx` file
- [ ] Upload via Admin > Products > "Import Excel"
- [ ] Verify products and images imported ✅

---

**Need help?** Check the admin panel documentation or contact support.
