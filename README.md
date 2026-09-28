# Enerix Solutions - Integrated Engineering & Renewable Energy Web Application

An enterprise-grade Laravel 13 web application built for **Enerix Solutions**, delivering dynamic content management for integrated engineering, solar power, civil & architectural design, high-voltage electrical distribution, IT datacenters, and AI surveillance systems.

---

## 🚀 Key Features & Highlights

- **Dynamic Homepage Matching Reference Design**:
  - Hero Section with category tagline, highlight typography, dual CTAs, and a 4-panel dynamic visual collage.
  - **Our Solutions**: 6 core engineering solutions with icons, image cards, and bullet-point capabilities.
  - **Why Enerix Solutions?**: Dark navy tech banner with 5 feature badges and live metrics (50+ Projects, 20+ Partners, 24/7 Support).
  - **Industries We Serve**: 7 photorealistic industry sector cards with label pills.
  - **Featured Projects**: Portfolio showcase with capacity specs and geographical locations.
  - **Call to Action (CTA) Ribbon**: Direct consultation button and quick communication channels (Phone, WhatsApp, Email).
  - **Full-featured Dark Navy Footer**: Brand identity, quick links, directory, and social channels.

- **Dynamic Admin Panel**:
  - Full CRUD for **Solutions** (`/admin/services`) with Bootstrap icon classes, line-by-line bullet points, and featured toggle.
  - Full CRUD for **Projects** (`/admin/projects`) with specifications, locations, categories, and case study details.
  - Full CRUD for **Industries** (`/admin/industries`) with subtitles, icons, and sector overviews.
  - General & Hero Settings (`/admin/settings`) allowing real-time customization of primary/secondary/accent colors, hero headline/tagline, and direct image uploads for all 4 collage panels.
  - Page Content Management (`/admin/page-content`) for mission, vision, history, and CTA ribbon copy.

- **Frontend Pages Built & Redesigned**:
  - Home (`/`)
  - About Us (`/about`)
  - Solutions Directory & Details (`/solutions`, `/solutions/{slug}`)
  - Projects Directory & Case Studies (`/projects`, `/projects/{slug}`)
  - Industries Directory & Details (`/industries`, `/industries/{slug}`)
  - Equipment & Products Catalog (`/products`, `/products/{slug}`)
  - Contact Us & Consultation Quote (`/contact`, `/quote`)

---

## 🛠️ Technology Stack

- **Backend**: Laravel 13 (PHP 8.3)
- **Frontend**: Blade Templating, Bootstrap 5.3, Bootstrap Icons, Google Fonts (Plus Jakarta Sans), AOS (Animate on Scroll)
- **Database**: MySQL / SQLite
- **Security & RBAC**: Spatie Laravel-Permission (Role-based access control)

---

## 🔑 Admin Credentials

- **URL**: `/admin/login`
- **Email**: `admin@admin.com`
- **Password**: `12345678`

---

## 📦 Setup & Deployment

1. **Clone repository**:
   ```bash
   git clone <repository-url>
   cd Enerix_solutions
   ```

2. **Install Composer dependencies**:
   ```bash
   composer install
   ```

3. **Configure Environment**:
   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seed Enerix Data**:
   ```bash
   php artisan migrate --force
   php artisan db:seed
   ```

5. **Link Storage**:
   ```bash
   php artisan storage:link
   ```

6. **Serve Application**:
   ```bash
   php artisan serve
   ```
