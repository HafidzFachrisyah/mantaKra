<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Manajemen Talenta Local Tools - Sistem pemetaan jabatan dan manajemen talenta ASN oleh BKPSDM Karanganyar">
    <title><?= esc($title ?? 'Dashboard') ?> — Manajemen Talenta Local Tools</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png') ?>">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#172554',
                        },
                        surface: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'slide-down': 'slideDown 0.3s ease-out',
                        'scale-in': 'scaleIn 0.3s ease-out',
                        'pulse-soft': 'pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideDown: {
                            '0%': { opacity: '0', transform: 'translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' },
                        },
                        pulseSoft: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '.7' },
                        },
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* Glass morphism */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #1d4ed8 0%, #7c3aed 50%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Smooth transitions */
        * { transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }

        /* Animated gradient background */
        .animated-bg {
            background: linear-gradient(-45deg, #eff6ff, #f0f9ff, #f5f3ff, #faf5ff);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Hover lift effect */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        /* Badge pulse */
        .badge-pulse {
            position: relative;
        }
        .badge-pulse::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            animation: pulseSoft 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        /* Modal backdrop */
        .modal-backdrop {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
        }

        /* Table row hover */
        .table-row-hover:hover {
            background: rgba(59, 130, 246, 0.04);
        }
    </style>
</head>
<body class="animated-bg min-h-screen font-sans text-surface-800 antialiased">

    <!-- Sidebar + Main Content Layout -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 z-40 h-screen w-72 glass border-r border-white/40 shadow-xl flex flex-col" id="sidebar">
            <!-- Logo Section -->
            <div class="px-6 py-6 border-b border-white/30">
                <div class="flex items-center gap-3">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="flex-shrink-0 w-11 h-11 object-cover rounded-xl">
                    <div>
                        <h1 class="text-sm font-bold gradient-text leading-tight">Manajemen Talenta</h1>
                        <p class="text-[10px] font-semibold text-primary-500/80 uppercase tracking-wider">Local Tools</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <p class="px-3 mb-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Menu Utama</p>
                
                <!-- Pemetaan Jabatan - Active -->
                <a href="/manajementalenta/public/pemetaan" 
                   class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-primary-50/80 text-primary-700 font-medium text-sm border border-primary-100/60 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25a2.25 2.25 0 0 1-2.25-2.25v-2.25Z" />
                    </svg>
                    <span>Pemetaan Jabatan</span>
                </a>

                <p class="px-3 mt-6 mb-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Segera Hadir</p>

                <!-- Coming soon items -->
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 text-sm cursor-not-allowed opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    <span>Talent Pool</span>
                    <span class="ml-auto text-[9px] bg-slate-100 text-slate-400 px-1.5 py-0.5 rounded-full font-medium">Soon</span>
                </div>
                <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 text-sm cursor-not-allowed opacity-60">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                    </svg>
                    <span>Pengembangan</span>
                    <span class="ml-auto text-[9px] bg-slate-100 text-slate-400 px-1.5 py-0.5 rounded-full font-medium">Soon</span>
                </div>
            </nav>

            <!-- Footer -->
            <div class="px-6 py-4 border-t border-white/30">
                <div class="flex flex-col items-start gap-2">
                    <img src="<?= base_url('assets/images/bkpsdm.png') ?>" alt="Logo BKPSDM" class="w-[35%] h-auto object-contain object-left">
                    <div>
                        <p class="text-[9px] text-slate-400">&copy; 2026 oleh BKPSDM Kab. Karanganyar</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-72">
            <!-- Top Bar -->
            <header class="sticky top-0 z-30 glass border-b border-white/30 shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800"><?= esc($title ?? 'Dashboard') ?></h2>
                        <p class="text-sm text-slate-500 mt-0.5">Manajemen Talenta Local Tools</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-400 bg-white/50 px-3 py-1.5 rounded-lg border border-slate-200/50"><?= date('d F Y') ?></span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
