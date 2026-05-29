<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Review;
use App\Models\SiteSetting;
use App\Models\ContactQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Show the glassmorphic login screen.
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Authenticate the admin credentials.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the admin.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    /**
     * Show the dashboard summary page.
     */
    public function dashboard()
    {
        $totalApps    = App::count();
        $newApps      = App::newGames()->count();
        $otherApps    = App::otherGames()->count();
        $pendingReviews = Review::pending()->count();

        $recentApps = App::orderBy('updated_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('totalApps', 'newApps', 'otherApps', 'pendingReviews', 'recentApps'));
    }

    /**
     * List all apps in a searchable/filterable table.
     */
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $category = $request->input('category');

        $query = App::query();

        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
        }

        if ($category === 'new') {
            $query->where('is_new', true);
        } elseif ($category === 'other') {
            $query->where('is_new', false);
        }

        $apps = $query->orderBy('id', 'desc')->paginate(15)->withQueryString();

        return view('admin.apps.index', compact('apps', 'search', 'category'));
    }

    /**
     * Show form to create a new application.
     */
    public function create()
    {
        return view('admin.apps.form', [
            'app'          => new App(),
            'title'        => 'Add New Gaming App',
            'featuresText' => '',
            'stepsText'    => ''
        ]);
    }

    /**
     * Save a new application into the database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:apps,slug',
            'icon_url'        => 'nullable|url',
            'download_url'    => 'required|url',
            'bonus_amount'    => 'required|string|max:100',
            'min_withdrawal'  => 'required|string|max:100',
            'rating'          => 'required|numeric|min:0|max:5',
            'votes'           => 'required|string|max:50',
            'size'            => 'required|string|max:50',
            'intro_text'      => 'nullable|string',
            'about_text'      => 'nullable|string',
            'features_raw'    => 'nullable|string',
            'steps_raw'       => 'nullable|string',
            'is_new'          => 'boolean',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords'    => 'nullable|string',
            'promo_code'      => 'nullable|string|max:50',
        ]);

        // Process text area strings to structured JSON arrays
        $data['features']       = $this->parseTextareaToArray($request->input('features_raw'));
        $data['download_steps'] = $this->parseTextareaToArray($request->input('steps_raw'));
        $data['is_new']         = $request->has('is_new');

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $app = App::create($data);

        // Auto-post to Telegram Bot if configured
        $this->sendTelegramNotification($app);

        return redirect()->route('admin.apps.index')->with('success', 'App added successfully!');
    }

    /**
     * Show form to edit an existing application.
     */
    public function edit($id)
    {
        $app = App::findOrFail($id);

        $featuresText = is_array($app->features)       ? implode("\n", $app->features)       : '';
        $stepsText    = is_array($app->download_steps) ? implode("\n", $app->download_steps) : '';

        return view('admin.apps.form', [
            'app'          => $app,
            'title'        => 'Edit Game App: ' . $app->name,
            'featuresText' => $featuresText,
            'stepsText'    => $stepsText
        ]);
    }

    /**
     * Save updates to an existing application.
     */
    public function update(Request $request, $id)
    {
        $app = App::findOrFail($id);

        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:apps,slug,' . $id,
            'icon_url'        => 'nullable|url',
            'download_url'    => 'required|url',
            'bonus_amount'    => 'required|string|max:100',
            'min_withdrawal'  => 'required|string|max:100',
            'rating'          => 'required|numeric|min:0|max:5',
            'votes'           => 'required|string|max:50',
            'size'            => 'required|string|max:50',
            'intro_text'      => 'nullable|string',
            'about_text'      => 'nullable|string',
            'features_raw'    => 'nullable|string',
            'steps_raw'       => 'nullable|string',
            'is_new'          => 'boolean',
            'seo_title'       => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords'    => 'nullable|string',
            'promo_code'      => 'nullable|string|max:50',
        ]);

        $data['features']       = $this->parseTextareaToArray($request->input('features_raw'));
        $data['download_steps'] = $this->parseTextareaToArray($request->input('steps_raw'));
        $data['is_new']         = $request->has('is_new');

        $app->update($data);

        return redirect()->route('admin.apps.index')->with('success', 'App updated successfully!');
    }

    /**
     * Remove an application from the database.
     */
    public function destroy($id)
    {
        $app = App::findOrFail($id);
        $app->delete();

        return redirect()->route('admin.apps.index')->with('success', 'App deleted successfully!');
    }

    /**
     * View site-wide parameters.
     */
    public function settings()
    {
        $settings = [
            'site_title'             => SiteSetting::getValue('site_title', ''),
            'site_tagline'           => SiteSetting::getValue('site_tagline', ''),
            'site_description'       => SiteSetting::getValue('site_description', ''),
            'site_keywords'          => SiteSetting::getValue('site_keywords', ''),
            'telegram_url'           => SiteSetting::getValue('telegram_url', ''),
            'telegram_bot_token'     => SiteSetting::getValue('telegram_bot_token', ''),
            'telegram_chat_id'       => SiteSetting::getValue('telegram_chat_id', ''),
            'logo_url'               => SiteSetting::getValue('logo_url', ''),
            'whatsapp_number'        => SiteSetting::getValue('whatsapp_number', ''),
            'header_gradient_start'  => SiteSetting::getValue('header_gradient_start', '#fb3737'),
            'header_gradient_end'    => SiteSetting::getValue('header_gradient_end', '#ff0000'),
            'theme_color'            => SiteSetting::getValue('theme_color', '#fb3737'),
            'disclaimer_text'        => SiteSetting::getValue('disclaimer_text', ''),
            'states_ban_alert'       => SiteSetting::getValue('states_ban_alert', ''),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Save dynamic site settings and passwords.
     */
    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'site_title'            => 'required|string|max:255',
            'site_tagline'          => 'required|string|max:255',
            'site_description'      => 'nullable|string',
            'site_keywords'         => 'nullable|string',
            'telegram_url'          => 'required|url',
            'telegram_bot_token'    => 'nullable|string|max:200',
            'telegram_chat_id'      => 'nullable|string|max:100',
            'logo_url'              => 'nullable|url',
            'whatsapp_number'       => 'nullable|string|max:50',
            'header_gradient_start' => 'required|string|max:20',
            'header_gradient_end'   => 'required|string|max:20',
            'theme_color'           => 'required|string|max:20',
            'disclaimer_text'       => 'nullable|string',
            'states_ban_alert'      => 'nullable|string',
            'new_password'          => 'nullable|string|min:6|confirmed',
        ]);

        // Update settings in database
        foreach ($data as $key => $value) {
            if ($key !== 'new_password' && $key !== 'new_password_confirmation') {
                SiteSetting::setValue($key, $value);
            }
        }

        // Handle Admin Password update if requested
        if (!empty($request->input('new_password'))) {
            $user           = Auth::user();
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return back()->with('success', 'Site settings updated successfully!');
    }

    /**
     * Parse text-area lines into a simple array.
     */
    private function parseTextareaToArray($text)
    {
        if (empty($text)) {
            return [];
        }

        $lines = explode("\n", str_replace("\r", "", $text));

        return array_values(array_filter(array_map('trim', $lines)));
    }

    /**
     * List all contact form inquiries in admin panel.
     */
    public function queries()
    {
        $queries = ContactQuery::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.queries.index', compact('queries'));
    }

    /**
     * Delete a contact query inquirer record.
     */
    public function destroyQuery($id)
    {
        $query = ContactQuery::findOrFail($id);
        $query->delete();

        return redirect()->route('admin.queries.index')->with('success', 'Contact query deleted successfully!');
    }

    /**
     * List all reviews (pending + approved) for admin moderation.
     */
    public function reviews()
    {
        $pending  = Review::with('app')->pending()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'pending');
        $approved = Review::with('app')->approved()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'approved');

        return view('admin.reviews.index', compact('pending', 'approved'));
    }

    /**
     * Approve a pending review.
     */
    public function approveReview($id)
    {
        $review         = Review::findOrFail($id);
        $review->status = 'approved';
        $review->save();

        return redirect()->route('admin.reviews.index')->with('success', 'Review approved successfully!');
    }

    /**
     * Delete a review.
     */
    public function destroyReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully!');
    }

    /**
     * Auto-post new app notification to configured Telegram Bot channel.
     */
    private function sendTelegramNotification(App $app)
    {
        $botToken = SiteSetting::getValue('telegram_bot_token');
        $chatId   = SiteSetting::getValue('telegram_chat_id');

        if (empty($botToken) || empty($chatId)) {
            return; // Not configured – skip silently
        }

        $appUrl  = url('/' . $app->slug);
        $message = "🎮 *New App Added!*\n\n"
            . "*" . $app->name . "*\n"
            . "💰 Bonus: " . $app->bonus_amount . "\n"
            . "💳 Min Withdrawal: " . $app->min_withdrawal . "\n"
            . "⭐ Rating: " . $app->rating . "/5\n"
            . "📦 Size: " . $app->size . "\n\n"
            . "🔗 [Download Now](" . $app->download_url . ")\n"
            . "📄 [View Details](" . $appUrl . ")";

        try {
            Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id'    => $chatId,
                'text'       => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Exception $e) {
            // Fail silently – don't block app creation
        }
    }
}
