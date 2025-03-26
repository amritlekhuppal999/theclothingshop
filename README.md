

#### Names for my site
    + TheClothingShop
    + DressCraft Depo
    + The Urban Wearhouse
    + Desi Threads



# New Tasks

## Components for product/category card 
make it dynamic as per need so later DB integration becomes easy.

Pass some data like current URI to customize how it will appear, like size, color, information, etc.

Pages they appear different in: home, category, wishlist

Create an array of objects that holds data for individual products that are currently displayed on the website
>Lets complete it by 26th OCT 2024

## Make the home page categories as components aswell
All these sections like best selling, new addition should be their independent sections integrated 

## Category Page

### Add Search Bar Component (means you gotta make one)

### Component for sorting options BTN

### Filters Component
Sub Category, theme, size, price
Now this filters part can be dynamic, meaning sections could differ so make sure it is developed accordingly



## Cart Page

### Items component



## Orders Page
Components for 
- Order Type Filter
- Order items section
- Searchbar 
- Order Filter BTN

### View Order Details
Develop the page or section

### Track Order
Develop the page or section

### Modify Order details
>[!info]
>This may take a lot of time and work as we will need the delivery service backend aswell.


## Checkout Page
Development pending

## Payment Gateway Integration
Development pending

## Thankyou for shopping with us, Redirecting PAGE
Development pending

## 404! Page Not Found Page
Development pending




# Database Integration

# Entire Backend :'-)
## Customer Analytics
### Use kaggle dummy data for customer analtics








# Product, Variant and attribute schema for adding and mapping them
```
Since you have a **product variants table**, we need to adjust the schema to link attributes to variants rather than directly to products.  

---

### **Schema Design with Variants**

#### **1. Products Table (`products`)**  
- `id` (PK)  
- `name`  
- `description`  
- `price` *(base price, if applicable)*  
- Other general details  

#### **2. Product Variants Table (`product_variants`)** *(Each row represents a unique combination of attributes for a product)*  
- `id` (PK)  
- `product_id` (FK → `products.id`)  
- `sku` *(optional, for inventory tracking)*  
- `price` *(variant-specific price, if different from base price)*  
- `stock` *(if managing inventory per variant)*  

#### **3. Attributes Table (`attributes`)**  
- `id` (PK)  
- `name` *(e.g., "Color", "Size", "Material")*  

#### **4. Attribute Values Table (`attribute_values`)**  
- `id` (PK)  
- `attribute_id` (FK → `attributes.id`)  
- `value` *(e.g., "Red", "Blue", "Large", "Cotton")*  

#### **5. Variant Attributes Table (`variant_attributes`)** *(Links each variant to its specific attribute values)*  
- `id` (PK)  
- `variant_id` (FK → `product_variants.id`)  
- `attribute_value_id` (FK → `attribute_values.id`)  

---

### **Explanation**
1. **`products`** stores general product info.  
2. **`product_variants`** represents unique combinations of attributes for a product.  
3. **`attributes` & `attribute_values`** define available attributes.  
4. **`variant_attributes`** maps each variant to its specific attributes.  
5. **Frontend Filtering:**  
   - Retrieve `attributes` and `attribute_values` for filtering.  
   - Query `product_variants` using `variant_attributes` to find matching products.  

---

This structure ensures:  
✅ **Efficient filtering & querying**  
✅ **Scalability** (New attributes can be added anytime)  
✅ **Flexibility** (Each product can have different attribute combinations)  
✅ **Better inventory management** (Track stock at the variant level)  
```