# Product Import Guide

## Excel Sheet Template

To bulk import products into the admin panel, use the following format:

### Column Headers (First Row Required):
```
name | category | price | stock | brand | type | description | is_active | image_path
```

### Column Details:

| Column | Type | Required | Notes |
|--------|------|----------|-------|
| **name** | Text | ✅ Yes | Product name (e.g., "Pikachu Plush Toy") |
| **category** | Text | ✅ Yes | Category name - will auto-create if doesn't exist (e.g., "Toys", "Cards") |
| **price** | Number | ✅ Yes | Price in Philippine Pesos (e.g., 350, 1200.50) |
| **stock** | Number | ❌ No | Quantity available (default: 0) |
| **brand** | Text | ❌ No | Brand name (default: "Unknown") |
| **type** | Text | ❌ No | Product type/subtype (default: "General") |
| **description** | Text | ❌ No | Product description, can include details |
| **is_active** | Number | ❌ No | 1 for active, 0 for inactive (default: 1) |
| **image_path** | Text | ❌ No | **NEW: Image filename from staging folder** |

## Example Data:

```
name,category,price,stock,brand,type,description,is_active,image_path
Pokémon Trading Card Booster Pack,Cards,450,50,The Pokémon Company,Booster Pack,Sealed booster pack with 10 cards,1,booster_pack.jpg
Pikachu Plush Toy,Toys,350,30,Official Pokémon,Plush,Soft cuddly Pikachu collectible,1,pikachu_plush.jpg
Charizard Figurine,Collectibles,550,20,Bandai,Figure,Detailed Charizard action figure,1,charizard_figure.jpg
Pokédex Electronic Device,Electronics,1200,15,Hasbro,Electronic Device,Interactive Pokédex,1,pokedex_device.jpg
Eevee Evolution Set,Collectibles,800,25,Official Pokémon,Figure Set,Complete Eevee collection,1,eevee_set.jpg
```

## How to Create Excel File:

### Option 1: Using the Template (Easy)
1. Download template from: `/products_import_template.csv`
2. Open in Excel
3. Add your products
4. Save as `.xlsx` file
5. Upload in Admin Panel → Products → "Import Excel" button

### Option 2: Create from Scratch
1. Open Excel/Google Sheets
2. Create columns with headers from above
3. Fill in your product data
4. Save as `.xlsx` or `.csv` file
5. Upload in Admin Panel

### Option 3: Edit Template CSV
1. Open `products_import_template.csv` in Excel
2. Delete example rows
3. Add your own products
4. Save as Excel file (`.xlsx`)

## 📸 Photo Management

### Photo Workflow:
1. **Prepare images** → Place in `storage/app/private/product-images/`
2. **Organization** → Optional: organize by category in subfolders
3. **Reference in Excel** → Add filename in `image_path` column
4. **Import** → System auto-copies images from staging to public storage
5. **Cleanup** → Optional: delete staging images after import

### Photo Directory Structure:
```
storage/app/private/product-images/
├── booster_pack.jpg
├── pikachu_plush.jpg
├── Cards/
│   ├── mewtwo_card.jpg
│   └── rare_holo.jpg
└── Electronics/
	└── pokedex_device.jpg
```

### Photo Naming Tips:
- ✅ **Use simple names:** `pikachu.jpg`, `charizard.png`
- ❌ **Avoid spaces:** Don't use `My Photo.jpg`
- ❌ **Avoid special chars:** Don't use `img(1).jpg`
- **Formats:** JPG, PNG, GIF, WebP (5MB max per image)

### Reference in Excel:
```csv
name,image_path
Pikachu Plush,pikachu_plush.jpg
Mewtwo Card,Cards/mewtwo_card.jpg
Pokedex Device,Electronics/pokedex_device.jpg
```

---

## Important Notes:

- ✅ **Required Columns:** name, category, price
- ✅ **Optional:** image_path (leave blank to skip images)
- ✅ **Categories auto-create** if they don't exist
- ✅ **Products auto-update** if name already exists
- ✅ **Images auto-copy** from staging to production folder
- ⚠️ **No special characters** in category/brand (stick to letters, numbers, spaces)
- ⚠️ **Prices** should be numeric only (no ₱ symbol)
- ⚠️ **First row must be headers** - use exact column names
- 📝 Leave cells empty for optional fields (they'll use defaults)

## Example Products to Add:

### Cards Category:
- Pokémon Trading Card Booster Pack, ₱450
- Pokémon Theme Deck, ₱320
- Rare Holographic Card, ₱2500

### Toys Category:
- Pikachu Plush Toy, ₱350
- Squirtle Action Figure, ₱280
- Misty Doll Collectible, ₱420

### Accessories Category:
- Pikachu Drawstring Bag, ₱280
- Jigglypuff Keychain, ₱120
- Pokémon Enamel Pins Set, ₱250

### Electronics:
- Pokédex Device, ₱1200
- Pokémon Electronic Game Console, ₱2800

## Upload Steps:

1. Go to **Admin Panel** → **Products**
2. Click **"Import Excel"** button
3. Select your `.xlsx` file
4. Click **Upload**
5. Products will be added/updated automatically ✅

## Troubleshooting:

- **File not accepted?** Make sure it's `.xlsx` or `.csv` format
- **Products not showing?** Check if category name is correct (case-sensitive preferable)
- **Price issues?** Use numbers only (e.g., 450, not "450 pesos")
- **Duplicates?** If product name exists, it will **update** the existing product
- **Image not importing?** Check filename matches exactly, file exists in staging folder
- **Need help?** See `PHOTO_MANAGEMENT_GUIDE.md` for detailed photo setup

Download the template and fill it with your products!
