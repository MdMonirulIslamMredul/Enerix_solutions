<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Blog;
use App\Models\Counter;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HomepageCarousel;
use App\Models\Industry;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Ensure storage directories exist and deploy bundled Enerix assets
        $storageDisk = \Illuminate\Support\Facades\Storage::disk('public');
        $imgMap = [
            'settings/hero_main.jpg' => 'hero_main.jpg',
            'settings/hero_top.jpg' => 'hero_top.jpg',
            'settings/hero_mid.jpg' => 'hero_mid.jpg',
            'settings/hero_bot.jpg' => 'hero_bot.jpg',
            'settings/logo.svg' => 'logo.svg',
            'services/solution_solar.jpg' => 'solution_solar.jpg',
            'services/solution_civil.jpg' => 'solution_civil.jpg',
            'services/solution_electrical.jpg' => 'solution_electrical.jpg',
            'services/solution_it.jpg' => 'solution_it.jpg',
            'services/solution_security.jpg' => 'solution_security.jpg',
            'services/solution_consultancy.jpg' => 'solution_consultancy.jpg',
            'industries/industry_residential.jpg' => 'industry_residential.jpg',
            'industries/industry_commercial.jpg' => 'solution_civil.jpg',
            'industries/industry_industrial.jpg' => 'industry_industrial.jpg',
            'industries/industry_hospitals.jpg' => 'industry_hospitals.jpg',
            'industries/industry_educational.jpg' => 'industry_educational.jpg',
            'industries/industry_government.jpg' => 'industry_government.jpg',
            'industries/industry_realestate.jpg' => 'solution_civil.jpg',
            'projects/project_commercial_solar.jpg' => 'solution_solar.jpg',
            'projects/project_industrial_solar.jpg' => 'hero_main.jpg',
            'projects/project_it.jpg' => 'solution_it.jpg',
            'projects/project_hospital.jpg' => 'industry_hospitals.jpg',
        ];

        foreach ($imgMap as $dest => $src) {
            $srcPath = public_path('images/enerix/' . $src);
            if (file_exists($srcPath) && !$storageDisk->exists($dest)) {
                $dir = dirname($dest);
                if (!$storageDisk->exists($dir)) {
                    $storageDisk->makeDirectory($dir);
                }
                $storageDisk->put($dest, file_get_contents($srcPath));
            }
        }

        $adminUser = User::updateOrCreate(['email' => 'admin@admin.com'], [
            'name' => 'Admin User',
            'password' => '12345678',
            'is_admin' => true,
        ]);

        $permissions = [
            'access admin panel',
            'view',
            'create',
            'edit',
            'delete',
            'manage users',
            'manage roles',
            'manage permissions',
            'manage products',
            'manage services',
            'manage projects',
            'manage industries',
            'manage team members',
            'manage blogs',
            'manage galleries',
            'Web_Settings',
            'manage branches',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        $superAdminRole->syncPermissions($permissions);
        $adminRole->syncPermissions($permissions);

        $adminUser->assignRole($superAdminRole);

        // Settings for Enerix Solutions
        Setting::updateOrCreate(['id' => 1], [
            'site_name' => 'Enerix Solutions',
            'meta_title' => 'Enerix Solutions - Integrated Engineering, Solar Energy & IT Solutions',
            'meta_description' => 'Enerix Solutions is an integrated engineering and technology solutions company delivering reliable Solar, Electrical, Civil, Architectural and IT solutions for residential, commercial and industrial clients.',
            'seo_keywords' => 'engineering, solar energy, electrical engineering, IT solutions, civil engineering, CCTV security, Bangladesh',
            'hero_tagline' => 'ENGINEERING | SOLAR | IT | REAL ESTATE',
            'hero_title' => 'Engineering Tomorrow.',
            'hero_highlight' => 'Powering Possibilities.',
            'hero_subtitle' => 'Powering Possibilities.',
            'hero_description' => 'Integrated Engineering, Solar Energy & IT Solutions for Homes, Businesses and Industries.',
            'hero_image_main' => 'settings/hero_main.jpg',
            'hero_image_top' => 'settings/hero_top.jpg',
            'hero_image_mid' => 'settings/hero_mid.jpg',
            'hero_image_bot' => 'settings/hero_bot.jpg',
            'primary_color' => '#0072ce',
            'secondary_color' => '#07132b',
            'accent_color' => '#00c6ff',
            'text_color' => '#1e293b',
            'bg_color' => '#ffffff',
            'company_intro' => 'Enerix Solutions is an integrated engineering and technology solutions company delivering reliable Solar, Electrical, Civil, Architectural and IT solutions for residential, commercial and industrial clients.',
            'why_title' => 'Why Enerix Solutions?',
            'why_subtitle' => 'Your trusted partner for sustainable, efficient and future-ready solutions.',
            'cta_title' => 'Have a Project in Mind?',
            'cta_text' => 'Talk to our engineering team and discover the right solution for your project.',
            'cta_button_text' => 'Get a Free Consultation',
            'cta_button_link' => '/contact',
            'contact_email' => 'info@enerixbd.com',
            'contact_phone' => '+880 1234 567890',
            'whatsapp_number' => '+880 1234 567890',
            'contact_address' => 'Dhaka, Bangladesh',
            'logo_path' => 'settings/logo.svg',
            'google_map_embed' => 'https://maps.google.com/maps?q=Dhaka%20Bangladesh&t=&z=13&ie=UTF8&iwloc=&output=embed',
            'social_links' => [
                'facebook' => 'https://facebook.com',
                'linkedin' => 'https://linkedin.com',
                'youtube' => 'https://youtube.com',
            ],
        ]);

        // About Us
        About::updateOrCreate(['id' => 1], [
            'title' => 'About Enerix Solutions',
            'page_details' => '<p>Enerix Solutions is an integrated engineering and technology solutions company delivering reliable Solar, Electrical, Civil, Architectural and IT solutions for residential, commercial and industrial clients.</p>',
            'details1' => '<p>Our multidisciplinary team handles complete lifecycle project execution from concept feasibility and design engineering to turnkey construction and ongoing maintenance.</p>',
            'details2' => '<p>We combine cutting-edge green technology with robust engineering standards, ensuring our solar and electrical infrastructures deliver maximum efficiency and longevity.</p>',
            'details3' => '<p>From enterprise IT datacenter setups and AI surveillance systems to residential and commercial architectural structures, we engineer future-ready solutions tailored to every client.</p>',
            'details4' => '<p>With 24/7 dedicated support and a proven track record across nationwide projects, Enerix Solutions is your trusted partner in engineering tomorrow.</p>',
            'key_values' => ['Engineering Excellence', 'Sustainable Energy', 'Uncompromising Safety', 'Customer Partnership'],
            'years_experience' => 15,
            'establishment_year' => 2011,
            'banner_image' => 'settings/hero_main.jpg',
            'image1' => 'services/solution_civil.jpg',
            'image2' => 'services/solution_solar.jpg',
        ]);

        // Clean old demo services
        Service::where('slug', 'like', 'solar-service-%')->delete();

        // Solutions (Services)
        $solutionsData = [
            [
                'title' => 'Solar Energy Solutions',
                'slug' => 'solar-energy-solutions',
                'short_description' => 'Comprehensive renewable power systems designed for efficiency, resilience, and maximum energy savings.',
                'description' => '<p>We design, engineer, and deploy high-performance solar photovoltaic systems for residential rooftops, commercial complexes, and utility-scale industrial facilities.</p><ul><li>On-Grid, Off-Grid & Hybrid Solar Systems</li><li>Energy Storage Systems (ESS) & Lithium Battery Banks</li><li>Engineering, Procurement & Construction (EPC)</li><li>Preventive Maintenance & Remote Monitoring</li></ul>',
                'image' => 'services/solution_solar.jpg',
                'icon' => 'bi-sun-fill',
                'features' => [
                    'On-Grid, Off-Grid & Hybrid',
                    'ESS & Battery Solutions',
                    'Design, Supply & Installation',
                    'Consultancy & Maintenance',
                ],
                'sort_order' => 1,
            ],
            [
                'title' => 'Civil & Architectural Engineering',
                'slug' => 'civil-architectural-engineering',
                'short_description' => 'Modern structural design, sustainable building construction, and urban real estate master planning.',
                'description' => '<p>Delivering state-of-the-art architectural design and structural engineering solutions for residential high-rises, commercial buildings, and industrial facilities.</p><ul><li>Architectural 3D Modeling & Master Planning</li><li>Reinforced Concrete & Steel Structure Construction</li><li>Real Estate Development & Interior Finishing</li><li>Turnkey Project Management & Quality Inspection</li></ul>',
                'image' => 'services/solution_civil.jpg',
                'icon' => 'bi-buildings',
                'features' => [
                    'Design & Planning',
                    'Building Construction',
                    'Real Estate Development',
                    'Project Management',
                ],
                'sort_order' => 2,
            ],
            [
                'title' => 'Electrical Engineering',
                'slug' => 'electrical-engineering',
                'short_description' => 'Industrial-grade electrical design, transmission networks, substation commissioning, and safety audits.',
                'description' => '<p>Specialized high, medium, and low-voltage electrical engineering solutions ensuring uncompromised power reliability and regulatory safety.</p><ul><li>Substation Design & High Voltage Transformers</li><li>Switchgear & Power Distribution Networks</li><li>Electrical Load Audits & Surge Protection</li><li>Testing, Commissioning & Safety Certification</li></ul>',
                'image' => 'services/solution_electrical.jpg',
                'icon' => 'bi-lightning-charge-fill',
                'features' => [
                    'Substation Design',
                    'Power Distribution',
                    'Electrical Design & Installation',
                    'Testing & Commissioning',
                ],
                'sort_order' => 3,
            ],
            [
                'title' => 'IT & Technology Solutions',
                'slug' => 'it-technology-solutions',
                'short_description' => 'Enterprise server architecture, structured cabling, cybersecurity, and hardware infrastructure maintenance.',
                'description' => '<p>End-to-end information technology infrastructure setup, data centers, network routing, and hardware diagnostics.</p><ul><li>Enterprise Data Center & Server Infrastructure</li><li>High-Speed Structured Fiber Optic Cabling</li><li>PCB Board Repair & Component Diagnostics</li><li>Enterprise Network Security & Managed IT Support</li></ul>',
                'image' => 'services/solution_it.jpg',
                'icon' => 'bi-pc-display',
                'features' => [
                    'Server & Network Solutions',
                    'Hardware & Software Support',
                    'PCB Board Repair',
                    'IT Infrastructure & Maintenance',
                ],
                'sort_order' => 4,
            ],
            [
                'title' => 'Security & Surveillance',
                'slug' => 'security-surveillance',
                'short_description' => 'Advanced video management systems, AI biometric access control, and smart integrated perimeter security.',
                'description' => '<p>Intelligent security ecosystems designed for mission-critical surveillance, perimeter monitoring, and access verification.</p><ul><li>Commercial CCTV & High-Resolution IP Camera Systems</li><li>Biometric & RFID Access Control Infrastructure</li><li>Centralized Video Management Software (VMS)</li><li>Smart AI Alarm & Intrusion Detection Systems</li></ul>',
                'image' => 'services/solution_security.jpg',
                'icon' => 'bi-shield-check',
                'features' => [
                    'CCTV & IP Camera Systems',
                    'Access Control',
                    'Video Management',
                    'Smart Security Solutions',
                ],
                'sort_order' => 5,
            ],
            [
                'title' => 'Engineering Consultancy',
                'slug' => 'engineering-consultancy',
                'short_description' => 'Specialized techno-economic feasibility studies, compliance assessments, and end-to-end project supervision.',
                'description' => '<p>Expert technical consultancy providing strategic guidance, cost optimization, and regulatory compliance for complex infrastructure initiatives.</p><ul><li>Techno-Economic Feasibility & ROI Modeling</li><li>Independent Engineering Assessment & Safety Audits</li><li>Engineering Design Review & Blueprint Approval</li><li>Contractor Supervision & Implementation Oversight</li></ul>',
                'image' => 'services/solution_consultancy.jpg',
                'icon' => 'bi-people-fill',
                'features' => [
                    'Feasibility Study',
                    'Technical Assessment',
                    'Design & Project Management',
                    'Implementation Support',
                ],
                'sort_order' => 6,
            ],
        ];

        foreach ($solutionsData as $sol) {
            Service::updateOrCreate(
                ['slug' => $sol['slug']],
                array_merge($sol, ['is_featured' => true, 'status' => true])
            );
        }

        // Counters
        Counter::truncate();
        Counter::create(['title' => 'Projects', 'value' => '50+', 'icon' => 'bi-check2-circle', 'status' => true]);
        Counter::create(['title' => 'Technical Partners', 'value' => '20+', 'icon' => 'bi-diagram-3', 'status' => true]);
        Counter::create(['title' => 'Support', 'value' => '24/7', 'icon' => 'bi-headset', 'status' => true]);

        // Industries
        $industriesData = [
            [
                'title' => 'Residential',
                'slug' => 'residential',
                'subtitle' => 'Smart Homes & Eco-Living',
                'image' => 'industries/industry_residential.jpg',
                'icon' => 'bi-house-door',
                'sort_order' => 1,
                'short_description' => 'Tailored solar energy, architectural upgrades, and smart home automation for residential owners.',
            ],
            [
                'title' => 'Commercial',
                'slug' => 'commercial',
                'subtitle' => 'Corporate Offices & Complexes',
                'image' => 'industries/industry_commercial.jpg',
                'icon' => 'bi-building',
                'sort_order' => 2,
                'short_description' => 'Integrated engineering and energy-saving solutions for corporate offices, shopping centers, and commercial hubs.',
            ],
            [
                'title' => 'Industrial',
                'slug' => 'industrial',
                'subtitle' => 'Manufacturing & Heavy Processing',
                'image' => 'industries/industry_industrial.jpg',
                'icon' => 'bi-gear-wide-connected',
                'sort_order' => 3,
                'short_description' => 'High-voltage power substations, heavy-duty electrical distribution, and megawatt solar plants.',
            ],
            [
                'title' => 'Hospitals',
                'slug' => 'hospitals',
                'subtitle' => 'Healthcare & Critical Medical Infrastructure',
                'image' => 'industries/industry_hospitals.jpg',
                'icon' => 'bi-hospital',
                'sort_order' => 4,
                'short_description' => 'Zero-downtime electrical reliability, uninterruptible power systems, and specialized medical facility engineering.',
            ],
            [
                'title' => 'Educational Institutions',
                'slug' => 'educational-institutions',
                'subtitle' => 'Universities, Colleges & Campuses',
                'image' => 'industries/industry_educational.jpg',
                'icon' => 'bi-mortarboard',
                'sort_order' => 5,
                'short_description' => 'Campus-wide solar arrays, network server backbones, and smart campus security monitoring.',
            ],
            [
                'title' => 'Government & Infrastructure',
                'slug' => 'government-infrastructure',
                'subtitle' => 'Civic Facilities & Public Utilities',
                'image' => 'industries/industry_government.jpg',
                'icon' => 'bi-bank',
                'sort_order' => 6,
                'short_description' => 'Public sector infrastructure projects adhering to international safety and engineering regulations.',
            ],
            [
                'title' => 'Real Estate',
                'slug' => 'real-estate',
                'subtitle' => 'High-Rise Towers & Urban Developments',
                'image' => 'industries/industry_realestate.jpg',
                'icon' => 'bi-buildings',
                'sort_order' => 7,
                'short_description' => 'Structural engineering, MEP design, and architectural execution for premier real estate developments.',
            ],
        ];

        foreach ($industriesData as $ind) {
            Industry::updateOrCreate(
                ['slug' => $ind['slug']],
                array_merge($ind, ['status' => true])
            );
        }

        // Projects
        $projectsData = [
            [
                'title' => 'Commercial Rooftop Solar Project',
                'slug' => 'commercial-rooftop-solar-project',
                'spec_subtitle' => '10 kW Hybrid System',
                'location' => 'Dhaka, Bangladesh',
                'category' => 'Solar Energy Solutions',
                'image' => 'projects/project_commercial_solar.jpg',
                'short_description' => 'Turnkey 10 kW hybrid solar rooftop system with battery backup for seamless corporate power security.',
                'description' => '<p>Full engineering, procurement, and installation of a 10 kW hybrid solar system on a corporate headquarters rooftop in Dhaka. Included smart hybrid inverter, battery storage, and real-time app telemetry.</p>',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Industrial Solar Project',
                'slug' => 'industrial-solar-project',
                'spec_subtitle' => '500 kW On-Grid System',
                'location' => 'Chattogram, Bangladesh',
                'category' => 'Solar Energy Solutions',
                'image' => 'projects/project_industrial_solar.jpg',
                'short_description' => '500 kW utility-scale on-grid solar plant driving substantial cost reduction for a textile manufacturing unit.',
                'description' => '<p>Engineered and commissioned a 500 kW industrial grid-tied solar photovoltaic array in the industrial belt of Chattogram. Features high-efficiency monocrystalline PERC panels and grid synchronizing inverters.</p>',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'IT Infrastructure Project',
                'slug' => 'it-infrastructure-project',
                'spec_subtitle' => 'Server & Network Setup',
                'location' => 'Dhaka, Bangladesh',
                'category' => 'IT & Technology Solutions',
                'image' => 'projects/project_it.jpg',
                'short_description' => 'Tier-3 data center rack layout, high-density structured cabling, redundant power, and firewall protection.',
                'description' => '<p>Designed and deployed an enterprise data center with redundant routing switches, structured fiber optic backbone, climate-controlled server racks, and AI environmental monitoring.</p>',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Hospital Electrical Project',
                'slug' => 'hospital-electrical-project',
                'spec_subtitle' => 'Electrical Design & Installation',
                'location' => 'Cumilla, Bangladesh',
                'category' => 'Electrical Engineering',
                'image' => 'projects/project_hospital.jpg',
                'short_description' => 'Comprehensive medical facility electrical distribution, emergency backup integration, and substation testing.',
                'description' => '<p>Delivered complete electrical MEP engineering for a 200-bed modern hospital in Cumilla, including dual transformer substation, automatic transfer switches (ATS), and isolated power for operating theaters.</p>',
                'is_featured' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($projectsData as $proj) {
            Project::updateOrCreate(
                ['slug' => $proj['slug']],
                array_merge($proj, ['status' => true])
            );
        }

        // Clean old demo products
        Product::where('slug', 'like', 'solar-product-%')->delete();

        // Products (Sample products matching Enerix catalog)
        $productsData = [
            ['title' => 'Monocrystalline Solar Panel 550W Tier-1', 'slug' => 'monocrystalline-solar-panel-550w', 'price' => 180, 'short_description' => 'High-efficiency monocrystalline solar module with half-cut cell technology.'],
            ['title' => 'Hybrid Solar Inverter 10kW Three-Phase', 'slug' => 'hybrid-solar-inverter-10kw', 'price' => 2400, 'short_description' => 'Intelligent three-phase hybrid inverter with integrated MPPT charge controllers.'],
            ['title' => 'LiFePO4 Lithium Battery Rack 15kWh', 'slug' => 'lifepo4-lithium-battery-rack-15kwh', 'price' => 3200, 'short_description' => 'Long-life lithium iron phosphate energy storage module with built-in BMS.'],
            ['title' => 'Enterprise 48-Port Gigabit PoE+ Managed Switch', 'slug' => 'enterprise-48-port-gigabit-poe-switch', 'price' => 850, 'short_description' => 'Layer 2+ managed Gigabit switch engineered for high-performance data centers.'],
            ['title' => '4K Ultra-HD AI IP Bullet Surveillance Camera', 'slug' => '4k-ultra-hd-ai-ip-bullet-camera', 'price' => 220, 'short_description' => 'Weatherproof IP67 smart camera with face recognition and night vision.'],
            ['title' => 'High-Voltage Transformer 500kVA Substation', 'slug' => 'high-voltage-transformer-500kva', 'price' => 8500, 'short_description' => 'Industrial step-down power distribution transformer with high thermal capacity.'],
        ];

        foreach ($productsData as $i => $prod) {
            Product::updateOrCreate(['slug' => $prod['slug']], [
                'title' => $prod['title'],
                'short_description' => $prod['short_description'],
                'description' => '<p>' . $prod['short_description'] . ' Certified for commercial and industrial deployment by Enerix Solutions.</p>',
                'price' => $prod['price'],
                'is_featured' => true,
                'status' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
