<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\SiteSetting;
use App\Models\ContactQuery;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the dynamic homepage with sorted gaming apps.
     */
    public function index()
    {
        $newGames = App::newGames()->orderBy('id', 'asc')->get();
        $otherGames = App::otherGames()->orderBy('id', 'asc')->get();

        // Top 5 apps by rating for leaderboard carousel
        $topApps = App::orderBy('rating', 'desc')->take(5)->get();

        $settings = $this->getSiteSettings();

        return view('home', compact('newGames', 'otherGames', 'topApps', 'settings'));
    }

    /**
     * Display details for a specific Yono App.
     */
    public function detail($slug)
    {
        $app = App::where('slug', $slug)->firstOrFail();

        // Fetch up to 6 other related games for recommendations
        $relatedGames = App::where('id', '!=', $app->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        // Approved reviews for this app
        $reviews = Review::where('app_id', $app->id)->approved()->orderBy('created_at', 'desc')->get();

        $settings = $this->getSiteSettings();

        return view('detail', compact('app', 'relatedGames', 'reviews', 'settings'));
    }

    /**
     * Display the About page.
     */
    public function about()
    {
        $settings = $this->getSiteSettings();
        return view('about', compact('settings'));
    }

    /**
     * Display the Contact page.
     */
    public function contact()
    {
        $settings = $this->getSiteSettings();
        return view('contact', compact('settings'));
    }

    /**
     * Handle public contact queries and save to database.
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'email'      => 'required|email|max:120',
            'subject'    => 'required|string|max:150',
            'message'    => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,pdf|max:5120',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('contact_attachments', 'public');
        }

        ContactQuery::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'subject'         => $request->subject,
            'message'         => $request->message,
            'attachment_path' => $attachmentPath,
        ]);

        return redirect()->back()->with('success', 'Thank you for reaching out! Your query has been received and sent to the administrator panel successfully.');
    }

    /**
     * Handle public user review submission for an app.
     */
    public function submitReview(Request $request)
    {
        $request->validate([
            'app_id'  => 'required|exists:apps,id',
            'name'    => 'required|string|max:80',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:600',
        ]);

        Review::create([
            'app_id'  => $request->app_id,
            'name'    => $request->name,
            'rating'  => $request->rating,
            'comment' => $request->comment,
            'status'  => 'pending',
        ]);

        return redirect()->back()->with('review_success', 'Thank you for your review! It will be visible after admin approval.');
    }

    /**
     * Display the Disclaimer and Legal States page.
     */
    public function disclaimer()
    {
        $settings = $this->getSiteSettings();
        return view('disclaimer', compact('settings'));
    }

    /**
     * Generate dynamic sitemap.xml for better SEO indexing.
     */
    public function sitemap()
    {
        $apps = App::orderBy('updated_at', 'desc')->get();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Static routes
        $staticRoutes = [
            'home' => '1.0',
            'about' => '0.8',
            'contact' => '0.8',
            'disclaimer' => '0.5'
        ];
        
        foreach ($staticRoutes as $routeName => $priority) {
            $xml .= '<url>';
            $xml .= '<loc>' . route($routeName) . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>' . $priority . '</priority>';
            $xml .= '</url>';
        }
        
        // Dynamic App routes
        foreach ($apps as $app) {
            $xml .= '<url>';
            $xml .= '<loc>' . route('game.detail', $app->slug) . '</loc>';
            $xml .= '<lastmod>' . $app->updated_at->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.9</priority>';
            $xml .= '</url>';
        }
        
        $xml .= '</urlset>';
        
        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Fetch all site settings key-values as a unified helper array.
     */
    private function getSiteSettings()
    {
        return [
            'site_title'              => SiteSetting::getValue('site_title', 'All New Yono Apps'),
            'site_tagline'            => SiteSetting::getValue('site_tagline', 'All Yono Games, Rummy Apps & Slots Games'),
            'site_description'        => SiteSetting::getValue('site_description', ''),
            'site_keywords'           => SiteSetting::getValue('site_keywords', ''),
            'telegram_url'            => SiteSetting::getValue('telegram_url', '#'),
            'whatsapp_number'         => SiteSetting::getValue('whatsapp_number', ''),
            'logo_url'                => SiteSetting::getValue('logo_url', '/logo.jpg'),
            'header_gradient_start'   => SiteSetting::getValue('header_gradient_start', '#fb3737'),
            'header_gradient_end'     => SiteSetting::getValue('header_gradient_end', '#ff0000'),
            'theme_color'             => SiteSetting::getValue('theme_color', '#fb3737'),
            'disclaimer_text'         => SiteSetting::getValue('disclaimer_text', ''),
            'states_ban_alert'        => SiteSetting::getValue('states_ban_alert', ''),
        ];
    }
}
