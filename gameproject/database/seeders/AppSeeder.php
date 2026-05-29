<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\App;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Hash;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed default Admin User
        User::updateOrCreate(
            ['email' => 'admin@yono.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Seed default Site Settings
        $settings = [
            'site_title' => 'All New Yono Apps',
            'site_tagline' => 'All Yono Games, Rummy Apps & Slots Games',
            'site_description' => 'Download All Yono Rummy, Slots & Teen Patti Apps from https://allnewyonoapps.com. Get ₹500–₹1500 Sign Up Bonus, Instant Withdraw & Secure Gaming 2026.',
            'site_keywords' => 'All New Yono Apps, Yono Rummy, Yono Slots, Yono Teen Patti, Yono VIP, Jaiho Rummy, Spin777, Rummy 365, All Yono Apps, Yono Download',
            'telegram_url' => 'https://t.me/+omGsOTOlwsY0NWRl',
            'logo_url' => 'https://allnewyonoapps.com/logo.jpg',
            'header_gradient_start' => '#fb3737',
            'header_gradient_end' => '#ff0000',
            'theme_color' => '#fb3737',
            'disclaimer_text' => 'All New Yono Apps.com is an independent platform. We don\'t own, manage, or operate any of the apps you see listed here. Our website is designed to help you discover and learn about different gaming options, but we don\'t control how those apps work or handle their services.

It\'s important to know that rummy apps can be addictive for some people. They also carry financial risks, especially if you\'re not careful with your spending. That\'s why we strongly recommend using these apps responsibly. If you choose to play, please set limits and stay aware of your habits.',
            'states_ban_alert' => 'Rummy, even as a skill-based game, is not legal everywhere. It is banned by the government in the following states: Andhra Pradesh, Sikkim, Nagaland, Assam, Arunachal Pradesh, Tamil Nadu, Odisha, and Telangana. If you live in any of these places, you should not download or play rummy apps.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::setValue($key, $value);
        }

        // 3. Seed popular gaming apps
        $apps = [
            // ================= NEW GAMES =================
            [
                'name' => 'Yono Bonus',
                'slug' => 'yono-bonus',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/yonogame.webp',
                'download_url' => 'https://indrummyvip20.com/?code=2BASP3EL2EL&t=1777380042',
                'bonus_amount' => '₹5000',
                'min_withdrawal' => '₹100',
                'rating' => 4.8,
                'votes' => '288K',
                'size' => '54MB',
                'is_new' => true,
                'intro_text' => 'Yono Bonus ek popular real cash gaming platform hai jahan users signup karte hi ₹5000 welcome bonus claim kar sakte hain. Is app me classic card matches aur spin wheels directly secure payment settings ke sath aate hain.',
                'about_text' => 'Yono Bonus stands at the peak of the Yono series, famous for massive signup rewards. It aggregates a highly engaging card catalog, exciting arcade machines, and fast transactions under one secure mobile platform.',
                'features' => [
                    'Welcome Bonus: Up to ₹5000 signup bonus instantly',
                    'Low Withdrawal: Minimum is ₹100 via Bank/UPI transfer',
                    'VIP Benefits: Daily spin code bonuses and point multipliers',
                ],
                'download_steps' => [
                    'Tap download to save the Yono Bonus APK.',
                    'Enable installations from Unknown Sources in system settings.',
                    'Open the file, complete the setup, register, and claim your ₹5000!'
                ]
            ],
            [
                'name' => 'Club INR',
                'slug' => 'club-inr',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/ClubINR.webp',
                'download_url' => 'https://clubinr4.top/?code=9VCNGTA5PGQ&t=1776245594',
                'bonus_amount' => '₹505',
                'min_withdrawal' => '₹100',
                'rating' => 4.4,
                'votes' => '554K',
                'size' => '59MB',
                'is_new' => true,
                'intro_text' => 'Club INR App ek popular real cash gaming platform hai jahan users signup karte hi ₹35 se ₹505 welcome bonus instantly claim kar sakte hain. Min. Withdraw ₹100.',
                'about_text' => 'Club INR delivers professional, secure, and fast card matching matches. Focused heavily on high-RTP returns and responsive designs, it provides competitive players with premium tables.',
                'features' => [
                    'Signup Reward: Dynamic welcome reward ranging from ₹35 to ₹505',
                    'Zero Latency: Optimized for extremely smooth mobile cards gameplay',
                ],
                'download_steps' => [
                    'Tap the download APK button above.',
                    'Enable Unknown Sources in device settings.',
                    'Install the app, register with OTP, and get your free cash.'
                ]
            ],
            [
                'name' => 'INR Rummy',
                'slug' => 'inr-rummy',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/inrrummy.webp',
                'download_url' => 'https://inrrummy4.top/?code=9VCNGTA5PGQ&t=1776245594',
                'bonus_amount' => '₹560',
                'min_withdrawal' => '₹100',
                'rating' => 4.5,
                'votes' => '664K',
                'size' => '48MB',
                'is_new' => true,
                'intro_text' => 'INR Rummy APK download karke ₹560 signup bonus instantly claim karein. Real cash rummy matches khele aur directly Bank/UPI me transfer karein.',
                'about_text' => 'INR Rummy delivers an authentic traditional card gaming arena, featuring Pool Rummy, Points Rummy, and Deals Rummy under extreme anti-cheat encryption protocols.',
                'features' => [
                    'Sign Up Bonus: Up to ₹560 free cash credited on OTP verification',
                    'Anti-Cheat: Fully certified RNG algorithm for fair cards distribution',
                ],
                'download_steps' => [
                    'Tap the download link above.',
                    'Allow installation from third-party developers in settings.',
                    'Open the file and hit install to start card battles.'
                ]
            ],
            [
                'name' => 'Rumble Rummy',
                'slug' => 'rumble-rummy',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/RumbleRummy.webp',
                'download_url' => 'https://rumblerummy.net',
                'bonus_amount' => '₹533',
                'min_withdrawal' => '₹100',
                'rating' => 4.6,
                'votes' => '102K',
                'size' => '51MB',
                'is_new' => true,
                'intro_text' => 'Rumble Rummy App provides new users with ₹533 instant signup bonus. Play multiplayer competitive cards and cash out fast!',
                'about_text' => 'Rumble Rummy matches card game lovers across India instantly on active high-speed servers. With zero latency gameplay and fast payouts, it stands out as a highly reliable card app.',
                'features' => [
                    'Signup Bonus: Get up to ₹533 welcome game coins',
                    'Smooth Gameplay: Fully optimized for 3G/4G connectivity',
                ],
                'download_steps' => [
                    'Download the rumble rummy APK.',
                    'Enable unknown source installations.',
                    'Log in and verify your mobile OTP.'
                ]
            ],
            [
                'name' => 'Bingo 101',
                'slug' => 'bingo-101',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/bingo101.webp',
                'download_url' => 'https://bingo101app.com',
                'bonus_amount' => '₹441',
                'min_withdrawal' => '₹100',
                'rating' => 4.7,
                'votes' => '212K',
                'size' => '39MB',
                'is_new' => true,
                'intro_text' => 'Bingo 101 APK offers classic bingo and board action with a clean interface and safe deposits. Get ₹441 signup bonus now.',
                'about_text' => 'Bingo 101 matches traditional board lovers into fast digital groups. Featuring secure, simple withdrawal channels and exciting bingo pools, it represents a top choice.',
                'features' => [
                    'Seeded Reward: ₹441 free board tokens',
                    'Instant Cashout: Minimum withdrawal ₹100 processed instantly',
                ],
                'download_steps' => [
                    'Tap download to grab the Bingo 101 APK.',
                    'Allow custom installations in phone parameters.',
                    'Install and sign up to access active boards.'
                ]
            ],
            [
                'name' => 'Spin101',
                'slug' => 'spin-101',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/spin101.webp',
                'download_url' => 'https://spin101.com',
                'bonus_amount' => '₹579',
                'min_withdrawal' => '₹100',
                'rating' => 4.6,
                'votes' => '165K',
                'size' => '42MB',
                'is_new' => true,
                'intro_text' => 'Spin101 (Yono) provides premium slot reels and spin wheels with exciting payouts. Get a ₹579 welcome bonus instantly.',
                'about_text' => 'Spin101 features hundreds of colorful slot designs and fast spin wheels with high RTP rates, making it an excellent platform for slot enthusiasts in India.',
                'features' => [
                    'Sign Up Bonus: ₹579 free gaming points',
                    'Variety of slots: Classic 3-reel, jackpot 5-reel, and wheel games',
                    'Instant Withdraw: Secure payments starting at ₹100',
                ],
                'download_steps' => [
                    'Download the Spin101 APK.',
                    'Enable unknown source installations.',
                    'Open the app, sign in, and enjoy your bonus spins.'
                ]
            ],
            [
                'name' => 'All Yono Games',
                'slug' => 'all-yono-games',
                'icon_url' => 'https://allnewyonoapps.com/all-yono-games.webp',
                'download_url' => 'https://allyonogamesapp.com',
                'bonus_amount' => '₹49',
                'min_withdrawal' => '₹100',
                'rating' => 4.9,
                'votes' => '136K',
                'size' => '50MB',
                'is_new' => true,
                'intro_text' => 'Download All Yono Games App to discover the absolute finest collection of the Yono series games under one fast shell!',
                'about_text' => 'All Yono Games is the ultimate collection app. It serves as a unified catalog allowing players to access card, slots, bingo, and arcade classics seamlessly, featuring custom daily cash bonuses.',
                'features' => [
                    'Unified dashboard: Switch between 80+ Yono apps easily',
                    'Exclusive codes: Weekly TG gift codes and direct discount options',
                ],
                'download_steps' => [
                    'Click to get the APK file.',
                    'Install the app after enabling unknown sources.',
                    'Open and access the entire library.'
                ]
            ],

            // ================= OTHER GAMES =================
            [
                'name' => 'Yono Games',
                'slug' => 'yono-games',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/yonogame.webp',
                'download_url' => 'https://yonogamesdownload.com',
                'bonus_amount' => '₹268',
                'min_withdrawal' => '₹100',
                'rating' => 4.5,
                'votes' => '28M',
                'size' => '54MB',
                'is_new' => false,
                'intro_text' => 'Claim your ₹268 signup bonus on Yono Games and start playing instantly. Enjoy a secure real-cash Rummy and casino gaming experience.',
                'about_text' => 'Yono Games is the legendary pioneer of mobile card gaming platforms in India. Trusted by millions, it provides stable servers, instant payouts, and safe real cash returns.',
                'features' => [
                    'Classic Trust: 5+ years of flawless operation and payout records',
                    'Instant Payments: Verified 24/7 bank withdrawals in minutes',
                ],
                'download_steps' => [
                    'Tap download to save the official Yono Games installer.',
                    'Confirm system prompt settings to install APK.',
                    'Sign in, insert your card details or UPI keys to claim your cash.'
                ]
            ],
            [
                'name' => 'Yono Slots',
                'slug' => 'yono-slots',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/yonoslots.webp',
                'download_url' => 'https://yonoslotsapp.top',
                'bonus_amount' => '₹281',
                'min_withdrawal' => '₹100',
                'rating' => 4.8,
                'votes' => '281K',
                'size' => '44MB',
                'is_new' => false,
                'intro_text' => 'Download Yono Slots APK today and claim your ₹281 signup bonus. Spin reels and cash out rewards securely.',
                'about_text' => 'Yono Slots is a high-return slot gaming environment featuring classic fruit machines, modern slot reels, and mega jackpots. It is celebrated for reliable transaction processing and stable servers.',
                'features' => [
                    'High RTP: Average RTP of 97.5% across all slot games',
                    'Secure Withdrawals: Instant withdrawal into Bank or UPI accounts',
                ],
                'download_steps' => [
                    'Download Yono Slots APK.',
                    'Install the file on your smartphone.',
                    'Register and spin the reels.'
                ]
            ],
            [
                'name' => 'Yono VIP',
                'slug' => 'yono-vip',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/yonovip.webp',
                'download_url' => 'https://yonovipapp.com',
                'bonus_amount' => '₹268',
                'min_withdrawal' => '₹100',
                'rating' => 4.7,
                'votes' => '195K',
                'size' => '52MB',
                'is_new' => false,
                'intro_text' => 'Install Yono VIP and activate your ₹268 welcome bonus instantly. Get VIP daily spins and high-end priority returns.',
                'about_text' => 'Yono VIP is designed for professional gaming enthusiasts who want special privileges like higher cashbacks, faster withdraw limits, dedicated VIP support, and high-stakes tables.',
                'features' => [
                    'VIP Benefits: Double daily cashbacks and VIP-only tables',
                    'Dedicated Manager: 24/7 priority customer support line',
                ],
                'download_steps' => [
                    'Tap download to get the premium APK.',
                    'Install and create your account using your mobile number.',
                    'Contact support to activate your VIP rank.'
                ]
            ],
            [
                'name' => 'INR SLOTS',
                'slug' => 'inr-slots',
                'icon_url' => 'https://allnewyonoapps.com/INR-SLOTS.webp',
                'download_url' => 'https://inrslotsapp.com',
                'bonus_amount' => '₹1500',
                'min_withdrawal' => '₹100',
                'rating' => 4.7,
                'votes' => '165K',
                'size' => '45MB',
                'is_new' => false,
                'intro_text' => 'Download INR Slots APK and enjoy exciting slot games with real money rewards. Claim ₹1500 welcome bonus instantly.',
                'about_text' => 'INR Slots provides dynamic slot games tailored with classic theme sets and megaways systems. Highly secure and engaging for slot lovers in India.',
                'features' => [
                    'Megaways: Win on hundreds of paylines',
                    'Fast UPI: Direct withdrawal processing into your UPI address',
                ],
                'download_steps' => [
                    'Save the APK to your mobile phone.',
                    'Confirm permissions, install, and open.',
                    'Register with your phone number to credit ₹1500.'
                ]
            ],
            [
                'name' => 'Yono Rummy',
                'slug' => 'yono-rummy',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/YonoRummy.webp',
                'download_url' => 'https://yonorummyapp.com',
                'bonus_amount' => '₹268',
                'min_withdrawal' => '₹100',
                'rating' => 4.5,
                'votes' => '2.5M',
                'size' => '50MB',
                'is_new' => false,
                'intro_text' => 'Official Yono Rummy APK download page. Get ₹268 signup bonus, secure multiplayer matching, and fast UPI cashouts.',
                'about_text' => 'Yono Rummy represents the gold standard of dynamic Rummy matches in India. Experience multiple tournaments and win real cash prize pools.',
                'features' => [
                    'Multiplayer: Play cards with 10L+ active users in real-time',
                    '24/7 support: Direct multi-language card support panel',
                ],
                'download_steps' => [
                    'Click above to download the APK.',
                    'Install, open, and enter your mobile OTP details.'
                ]
            ],
            [
                'name' => 'Yono Arcade',
                'slug' => 'yono-arcade',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/YonoArcade.webp',
                'download_url' => 'https://yonoarcade.com',
                'bonus_amount' => '₹200',
                'min_withdrawal' => '₹100',
                'rating' => 4.2,
                'votes' => '600K',
                'size' => '40MB',
                'is_new' => false,
                'intro_text' => 'Install Yono Arcade and claim your ₹200 signup bonus instantly. Play exciting arcade games and cash out fast!',
                'about_text' => 'Yono Arcade brings retro and modern mini-games together, featuring high-speed servers, daily check-in rewards, and verified UPI transaction systems.',
                'features' => [
                    'Retro matches: Play color prediction, mines, and classic arcade boards',
                    'Secure deposits: Safe, instant checkout systems',
                ],
                'download_steps' => [
                    'Tap download to get the installer.',
                    'Install the application on your smartphone.',
                    'Sign up and claim your ₹200 free credit!'
                ]
            ],
            [
                'name' => '567 Slots',
                'slug' => '567-slots',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/567slots.webp',
                'download_url' => 'https://567slotsapp.net',
                'bonus_amount' => '₹500',
                'min_withdrawal' => '₹100',
                'rating' => 4.6,
                'votes' => '180K',
                'size' => '48MB',
                'is_new' => false,
                'intro_text' => 'Download 567 Slots APK for a superior slot spinning experience. Get a ₹500 welcome bonus and cash out instantly.',
                'about_text' => '567 Slots packs beautiful graphical slots with high RTP payout ratios and stable, certified servers to create a highly profitable slot arena.',
                'features' => [
                    'High RTP: Certified slot reels with massive multipliers',
                    '24/7 Cashout: Withdraw into Bank or UPI at any time',
                ],
                'download_steps' => [
                    'Save the APK file to your device.',
                    'Install and open the slot lobby.',
                    'Register and activate your ₹500 sign-up bonus.'
                ]
            ],
            [
                'name' => 'MBM Bet',
                'slug' => 'mbm-bet',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/mbmbet.webp',
                'download_url' => 'https://mbmbetapp.com',
                'bonus_amount' => '₹100',
                'min_withdrawal' => '₹100',
                'rating' => 4.4,
                'votes' => '320K',
                'size' => '53MB',
                'is_new' => false,
                'intro_text' => 'MBM Bet provides premium sports betting, slots, and casino card games with ₹100 signup rewards and fast withdrawals.',
                'about_text' => 'MBM Bet delivers a top-class real money betting catalog in India, featuring stable gameplay, daily promotions, and trusted payment transactions.',
                'features' => [
                    'Sports book: Bet on global cricket and football leagues',
                    'Instant checkouts: Withdraw securely starting at ₹100',
                ],
                'download_steps' => [
                    'Save the installer to your phone.',
                    'Enable Unknown Sources and tap install.',
                    'Create an account to claim your ₹100!'
                ]
            ],
            [
                'name' => 'Game Rummy',
                'slug' => 'game-rummy',
                'icon_url' => 'https://allnewyonoapps.com/game-rummy-apk.webp',
                'download_url' => 'https://gamerummy.com',
                'bonus_amount' => '₹500',
                'min_withdrawal' => '₹100',
                'rating' => 4.3,
                'votes' => '90K',
                'size' => '42MB',
                'is_new' => false,
                'intro_text' => 'Join Game Rummy today and receive a bonus ranging from ₹35 to ₹500 instantly! Minimum withdrawal ₹100.',
                'about_text' => 'Game Rummy matches competitive card lovers instantly on active high-speed card tables, backed by standard anti-cheat algorithms.',
                'features' => [
                    'Dynamic welcome bonus: Get up to ₹500 instantly',
                    'Clean UI: Classic green felt card table design',
                ],
                'download_steps' => [
                    'Tap download to get the card app.',
                    'Enable phone install permissions and install.',
                    'Verify mobile details and start card battles!'
                ]
            ],
            [
                'name' => 'MkM Bet',
                'slug' => 'mkm-bet',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/mkmbet.webp',
                'download_url' => 'https://mkmbetapp.com',
                'bonus_amount' => '₹500',
                'min_withdrawal' => '₹100',
                'rating' => 4.5,
                'votes' => '210K',
                'size' => '55MB',
                'is_new' => false,
                'intro_text' => 'Download MKM Bet App and unlock a ₹500 welcome bonus for sports betting, cards, and slots.',
                'about_text' => 'MKM Bet is a highly profitable sports matching and casino platform, featuring high odds, instant UPI cashouts, and priority support.',
                'features' => [
                    'High Odds: Competitive cricket and soccer bet slips',
                    'Secure: Certified random audits and SSL protection',
                ],
                'download_steps' => [
                    'Save the APK and select install.',
                    'Register, explore the sportsbook, and get ₹500.'
                ]
            ],
            [
                'name' => 'Spin Lucky',
                'slug' => 'spin-lucky',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/spinlucky.webp',
                'download_url' => 'https://spinlucky.com',
                'bonus_amount' => '₹200',
                'min_withdrawal' => '₹100',
                'rating' => 4.6,
                'votes' => '115K',
                'size' => '38MB',
                'is_new' => false,
                'intro_text' => 'Install Spin Lucky APK and activate your ₹200 signup bonus instantly. Spin and win cash prizes daily.',
                'about_text' => 'Spin Lucky aggregates classic slot reels and lucky color wheels to create a highly entertaining mobile casino platform.',
                'features' => [
                    'Signup Bonus: ₹200 free card points',
                    'Lucky Wheels: Spin daily to win bonus coupons',
                ],
                'download_steps' => [
                    'Download and install the APK.',
                    'Verify with your mobile number to get the bonus points.'
                ]
            ],
            [
                'name' => 'MDM Bet',
                'slug' => 'mdm-bet',
                'icon_url' => 'https://allnewyonoapps.com/MDM-Bet-App-Logo.webp',
                'download_url' => 'https://mdmbet.com',
                'bonus_amount' => '₹300',
                'min_withdrawal' => '₹100',
                'rating' => 4.4,
                'votes' => '140K',
                'size' => '52MB',
                'is_new' => false,
                'intro_text' => 'Download MDM Bet (Yono) APK and enjoy real-cash betting and slot games with a ₹300 welcome bonus.',
                'about_text' => 'MDM Bet packages massive slots libraries, sports prediction boards, and fast withdraw settings inside a lightweight responsive wrapper.',
                'features' => [
                    'Sports & Slots: Massive catalog of mini-games and leagues',
                    'Safe Payouts: UPI processing inside 15 minutes',
                ],
                'download_steps' => [
                    'Get the APK installer above.',
                    'Install and open the MDM Bet lobby.',
                    'Register to claim your ₹300 free tokens.'
                ]
            ],
            [
                'name' => '789 Jackpot',
                'slug' => '789-jackpot',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/789jackpot.webp',
                'download_url' => 'https://789jackpotapp.com',
                'bonus_amount' => '₹1500',
                'min_withdrawal' => '₹100',
                'rating' => 4.7,
                'votes' => '380K',
                'size' => '47MB',
                'is_new' => false,
                'intro_text' => 'Claim ₹1500 welcome bonus on the latest 789 Jackpot APK. Spin premium progressive jackpot slots!',
                'about_text' => '789 Jackpot specializes in massive progressive slot machine jackpots, giving users a highly engaging environment to win life-changing multipliers.',
                'features' => [
                    'Progressive Jackpots: Pools growing in real-time',
                    'Mega Multipliers: Win up to 10,000x on spins',
                ],
                'download_steps' => [
                    'Save the installer to your device.',
                    'Install the slots app and create your credentials.',
                    'Verify phone details to activate your ₹1500 jackpot token!'
                ]
            ],
            [
                'name' => 'GoGo Rummy',
                'slug' => 'gogo-rummy',
                'icon_url' => 'https://allnewyonoapps.com/gogorummy.webp',
                'download_url' => 'https://gogorummyapp.com',
                'bonus_amount' => '₹200',
                'min_withdrawal' => '₹100',
                'rating' => 4.5,
                'votes' => '95K',
                'size' => '41MB',
                'is_new' => false,
                'intro_text' => 'GoGo Rummy offers ₹200 welcome bonus, clean card table controls, and instant UPI withdrawals from ₹100.',
                'about_text' => 'GoGo Rummy delivers high-speed Points and Deals card matches with active online players, offering card players a reliable platform.',
                'features' => [
                    'Lobby matching: Start card games in under 3 seconds',
                    'Verified Cashouts: Instant UPI withdraw processing',
                ],
                'download_steps' => [
                    'Save the GoGo Rummy installer.',
                    'Install the card client and open.',
                    'Register with OTP and claim your ₹200.'
                ]
            ],
            [
                'name' => 'Bet213',
                'slug' => 'bet-213',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/bet213.webp',
                'download_url' => 'https://bet213.com',
                'bonus_amount' => '₹500',
                'min_withdrawal' => '₹100',
                'rating' => 4.6,
                'votes' => '240K',
                'size' => '51MB',
                'is_new' => false,
                'intro_text' => 'Download Bet213 App and claim your ₹500 welcome bonus instantly. Play slots, card tables, and cricket betting.',
                'about_text' => 'Bet213 is a premier gaming and betting catalog, celebrated for stable server connectivity, massive promotions, and secure transactions.',
                'features' => [
                    'Welcome Cash: ₹500 free credit to start gaming',
                    '24/7 support: Priority live chat access',
                ],
                'download_steps' => [
                    'Tap download to get the installer.',
                    'Enable Unknown Sources, install, and open.',
                    'Register with OTP to claim your cash.'
                ]
            ],
            [
                'name' => 'Raja Luck',
                'slug' => 'raja-luck',
                'icon_url' => 'https://allnewyonoapps.com/RajaLuck.webp',
                'download_url' => 'https://rajaluck.com',
                'bonus_amount' => '₹150',
                'min_withdrawal' => '₹100',
                'rating' => 4.3,
                'votes' => '80K',
                'size' => '36MB',
                'is_new' => false,
                'intro_text' => 'Earn cash prediction points on Raja Luck APK. Get a ₹150 sign-up bonus and experience fast color matching boards.',
                'about_text' => 'Raja Luck packages fast color matching predictions and board mini-games under a modern, highly secure gaming system.',
                'features' => [
                    'Color predictions: Instant 1-minute prediction results',
                    'Referral program: Earn recurring commission points',
                ],
                'download_steps' => [
                    'Download Raja Luck APK and select install.',
                    'Register with OTP and claim your ₹150.'
                ]
            ],
            [
                'name' => 'Jai Club',
                'slug' => 'jai-club',
                'icon_url' => 'https://allnewyonoapps.com/JaiClub.jpg',
                'download_url' => 'https://jaiclub.com',
                'bonus_amount' => '₹100',
                'min_withdrawal' => '₹100',
                'rating' => 4.2,
                'votes' => '75K',
                'size' => '39MB',
                'is_new' => false,
                'intro_text' => 'Download Jai Club to enjoy active slots and color matching predictions with ₹100 welcome reward codes.',
                'about_text' => 'Jai Club is a newly launched prediction and gaming board, celebrated for daily gift codes and active customer support channels.',
                'features' => [
                    'Free gift codes: Active daily promo codes on TG channel',
                    'Fast Cashout: Direct withdraw starts from ₹100',
                ],
                'download_steps' => [
                    'Get the APK installer file.',
                    'Open the file, install, and register to claim ₹100.'
                ]
            ],
            [
                'name' => 'Svip 777',
                'slug' => 'svip-777',
                'icon_url' => 'https://allnewyonoapps.com/S-vip-download.jpeg',
                'download_url' => 'https://svip777.com',
                'bonus_amount' => '₹100',
                'min_withdrawal' => '₹100',
                'rating' => 4.4,
                'votes' => '130K',
                'size' => '44MB',
                'is_new' => false,
                'intro_text' => 'Install SVIP 777 APK today and enjoy premium slots and card games with ₹100 signup credit.',
                'about_text' => 'SVIP 777 delivers high-end slots and mini-games inside a secure mobile wrapper, featuring daily jackpots and stable transaction processors.',
                'features' => [
                    'VIP slots: Premium slots with double payout coefficients',
                    'Safe: Direct UPI and card checkout processors',
                ],
                'download_steps' => [
                    'Tap download to get SVIP 777 APK.',
                    'Install and create your account using OTP.'
                ]
            ],
            [
                'name' => 'My777',
                'slug' => 'my-777',
                'icon_url' => 'https://allnewyonoapps.com/MY-777-APK.webp',
                'download_url' => 'https://my777.com',
                'bonus_amount' => '₹1500',
                'min_withdrawal' => '₹100',
                'rating' => 4.6,
                'votes' => '220K',
                'size' => '49MB',
                'is_new' => false,
                'intro_text' => 'Download official My777 APK and claim ₹1500 welcome bonus. Play exciting 777 jackpot slots daily.',
                'about_text' => 'My777 bundles beautifully designed classic 777 casino slot lobbies, featuring massive welcome multipliers and fast cashout routes.',
                'features' => [
                    'Jackpot slots: Classic slots with progressive multipliers',
                    'UPI cashout: Direct, verified transaction methods',
                ],
                'download_steps' => [
                    'Save the My777 APK and select install.',
                    'Register with your phone number and OTP.'
                ]
            ],
            [
                'name' => 'Ind Bingo',
                'slug' => 'ind-bingo',
                'icon_url' => 'https://allnewyonoapps.com/indbingo.webp',
                'download_url' => 'https://indbingo.com',
                'bonus_amount' => '₹500',
                'min_withdrawal' => '₹100',
                'rating' => 4.7,
                'votes' => '170K',
                'size' => '41MB',
                'is_new' => false,
                'intro_text' => 'Play Ind Bingo and earn cash online. Claim ₹500 welcome bonus and access active board multiplayer games.',
                'about_text' => 'Ind Bingo combines traditional bingo cards with active mobile board multiplayer tables, offering verified instant payouts.',
                'features' => [
                    'Welcome Cash: ₹500 free board tokens',
                    'Anti-Cheat: Certified audits to verify fair card distribution',
                ],
                'download_steps' => [
                    'Get the APK installer file.',
                    'Install the board client, open, and register.'
                ]
            ],
            [
                'name' => 'Rummy 365',
                'slug' => 'rummy-365',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/rummy365.webp',
                'download_url' => 'https://rummy365.com',
                'bonus_amount' => '₹100',
                'min_withdrawal' => '₹100',
                'rating' => 4.5,
                'votes' => '1.2M',
                'size' => '52MB',
                'is_new' => false,
                'intro_text' => 'Rummy 365 (Yono) offers secure card gameplay, daily check-in rewards, and ₹100 sign-up bonus cash.',
                'about_text' => 'Rummy 365 delivers professional card battle tournaments, points cards, and deals tables with instant withdrawal processing.',
                'features' => [
                    'Active matching: Join rummy card tables inside 3 seconds',
                    'Anti-Cheat: Fully certified random card distributor',
                ],
                'download_steps' => [
                    'Tap download to save the card client.',
                    'Install, launch, and register with OTP.'
                ]
            ],
            [
                'name' => '101Z App',
                'slug' => '101z-app',
                'icon_url' => 'https://yonogamespro.com/wp-content/uploads/apps/101z.webp',
                'download_url' => 'https://101zapp.com',
                'bonus_amount' => '₹1500',
                'min_withdrawal' => '₹100',
                'rating' => 4.8,
                'votes' => '290K',
                'size' => '46MB',
                'is_new' => false,
                'intro_text' => 'Download 101Z APK to access exciting slot spins and card lobbies with a ₹1500 signup bonus.',
                'about_text' => '101Z packages beautiful fruit slot libraries and multiplayer color prediction mini-games under a stable, protected server.',
                'features' => [
                    'Signup Cash: Get ₹1500 free gaming points',
                    '24/7 Cashout: Direct withdraw starts from ₹100',
                ],
                'download_steps' => [
                    'Save the 101Z APK on your mobile phone.',
                    'Install and create your account using OTP.'
                ]
            ]
        ];

        foreach ($apps as $appData) {
            App::updateOrCreate(
                ['slug' => $appData['slug']],
                $appData
            );
        }
    }
}
