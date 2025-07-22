# Professional WordPress Image Preparation & Theme Documentation

## Table of Contents

1. [Image Preparation Workflow](#image-preparation-workflow)
2. [Andrew Hinton Portfolio Theme](#andrew-hinton-portfolio-theme)
3. [Setup & Configuration](#setup--configuration)
4. [Content Management](#content-management)
5. [Development Notes](#development-notes)

---

## Image Preparation Workflow

### The Core Question

**Should you resize a 3024x3024px image before uploading to WordPress?**

**Answer:** Yes, resize it, but more importantly, **control the crop**.

### The Problem: WordPress's "Dumb" Cropping

WordPress automatically creates multiple image sizes:

- Square thumbnails for portfolio grids
- Rectangular images for homepage mosaics
- Various other contextual sizes

**Issue:** WordPress uses simple "center crop" - finds the middle and crops outward. This can cut out important parts of off-center artwork with no user control.

### The Solution: Professional 3-Step Workflow

#### Step 1: Create Master Web Version

1. **Optimal size:** ~2000px for largest version (lightbox)
2. **Process:**
   - Open 3024x3024px image in editor (Preview, Photoshop, etc.)
   - Resize to 2000x2000px
   - Save as "master" web version
   - **Example:** `red-lobster-full.jpeg`

#### Step 2: Upload Master as Featured Image

1. Upload 2000x2000px master as Featured Image
2. **Results:**
   - **Portfolio Grid:** Creates perfect 600x600px square thumbnail
   - **Lightbox:** Uses high-quality 2000px version

#### Step 3: Manual Crops for Special Cases

1. **Homepage mosaic** uses rectangular images (1200x800px)
2. **For square artwork on homepage:**
   - Return to 2000x2000px master
   - Manually crop to 1200x800px rectangle
   - Frame most interesting artwork section
   - Save as separate file: `red-lobster-mosaic.jpeg`
   - Upload to specific ACF homepage field

### Benefits

- ✅ Perfect composition for every thumbnail
- ✅ Optimized performance
- ✅ Creative control over all crops
- ✅ Consistent high quality across site

---

## Andrew Hinton Portfolio Theme

### Overview

Custom WordPress theme for multimedia artist Andrew Hinton featuring:

- Clean, minimalist design
- Performance optimization
- Professional aesthetic
- Intuitive content management

### Core Features

#### Custom Post Types & Taxonomies

- **"Artworks" CPT:** Dedicated portfolio management
- **"Mediums" Taxonomy:** Custom categorization system

#### Interactive Elements

- **AJAX Portfolio Filter:** Dynamic filtering without page reloads
- **Homepage Mosaic Grid:** Editable masonry layout via custom fields
- **Live Instagram Feed:** Real-time Instagram integration

#### Specialized Templates

- **Artist Statement & CV:** Two-column with sticky photo
- **Journal/Blog:** Dedicated layout with sticky events sidebar

#### Admin Features

- **Centralized Site Settings:** Global data management
- **ACF Integration:** Powers all custom content fields

---

## Setup & Configuration

### Required Plugins

#### Essential

1. **Advanced Custom Fields (ACF)** - Free

   - Powers all custom content fields
   - ⚠️ **Critical for functionality**

2. **Hinton Portfolio Functionality** - Custom

   - Registers CPT, taxonomy, AJAX handlers

3. **Smash Balloon Social Photo Feed** - Free

   - Instagram API connection

4. **FooGallery** - Free

   - Image galleries for artwork series

5. **WPForms Lite**
   - Contact forms (shortcode: `[wpforms id="71"]`)

#### Recommended

- **Smush:** Image compression
- **Regenerate Thumbnails:** Development essential

### Initial Setup Steps

1. **Install & Activate**

   - Install theme + all required plugins

2. **Configure Reading Settings**

   - Settings → Reading
   - Set "Static page" for homepage
   - Select Front Page for "Homepage"
   - Select Journal for "Posts page"

3. **Create Site Settings Page**

   - Pages → Add New
   - Title: "Site Settings" (exact)
   - Fill "Site Details" fields
   - Acts as central data hub

4. **Set Permalinks**
   - Settings → Permalinks
   - Structure: "Post name"
   - ⚠️ **Required for CPT URLs**

---

## Content Management

### Managing Artworks

#### Creating New Artwork

1. **Artworks → Add New**
2. **Add title**
3. **Select "Mediums" category**
4. **Upload master image** as Featured Image
5. **Fill "Artwork Details":**
   - Description
   - Year
   - Dimensions
6. **For videos:** Paste YouTube link in content editor

#### Creating Artwork Series

1. **FooGallery → Add Gallery**
2. **Add title** (e.g., "Red Lobster Series")
3. **Upload all series images**
4. **Copy shortcode** (e.g., `[foogallery id="123"]`)
5. **Edit artwork → Paste in "Artwork Gallery Shortcode" field**

#### Updating Homepage Grid

1. **Edit Front Page**
2. **Use "Front Page Selected Works" fields**
3. **Select artworks or upload videos**

### Image Preparation Best Practices

#### File Naming Conventions

- **Use lowercase only**
- **Replace spaces with hyphens**
- **Include artist name + year**

**Examples:**

- ❌ `Red Lobster.JPEG`
- ✅ `red-lobster.jpeg`
- ✅ `andrew-hinton-red-lobster-2023.jpeg`

#### Size Guidelines

- **Master images:** 2000px longest edge
- **Homepage crops:** 1200x800px (3:2 ratio)
- **Quality:** 80-90% JPEG compression

---

## Development Notes

### Technical Specs

- **Function Prefix:** `hinton_portfolio_`
- **CSS Framework:** Tailwind CSS
- **Compiled CSS:** `/assets/css/main.css`

### Custom Image Sizes

| Size              | Dimensions   | Usage                   |
| ----------------- | ------------ | ----------------------- |
| `portfolio-thumb` | 600×600      | Portfolio grid squares  |
| `mosaic-large`    | 1200×800     | Homepage large tiles    |
| `mosaic-small`    | 600×400      | Homepage small tiles    |
| `artist-photo`    | 800×flexible | Artist statement page   |
| `journal-thumb`   | 400×400      | Journal/blog thumbnails |

### Key Files Structure

\`\`\`
hinton-portfolio/
├── assets/
│ └── css/
│ └── main.css
├── functions.php
├── index.php
└── [template files]
\`\`\`

---

## Quick Reference

### Essential Workflow Checklist

- [ ] Resize original to 2000px master
- [ ] Upload master as Featured Image
- [ ] Create manual crops for homepage if needed
- [ ] Use descriptive, web-friendly filenames
- [ ] Test across all display contexts

### Support Resources

- **ACF Documentation:** [advancedcustomfields.com](https://advancedcustomfields.com)
- **WordPress Codex:** [codex.wordpress.org](https://codex.wordpress.org)
- **Tailwind CSS:** [tailwindcss.com](https://tailwindcss.com)
  \`\`\`

I've created two comprehensive documents:

1. **Google Docs Version** - Formatted with clear headings, numbered steps, and structured for easy reading in Google Docs
2. **Markdown Version** - Complete with markdown formatting, tables, checkboxes, code blocks, and proper linking structure

Both documents compile all the information you provided, organizing the duplicated content and presenting it in a logical, professional format. The markdown version includes additional features like tables, code blocks, and a table of contents for better navigation.
