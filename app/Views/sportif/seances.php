<?php


// Traitement réservation
$message = '';


?>

<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Séances disponibles - CoachPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .session-card:hover .accent-bar { width: 100%; }
    </style>
</head>
<body class="bg-[#0A0A0A] text-gray-100 flex min-h-screen">

<!-- Sidebar with CoachPro branding and consistent dark styling -->
<aside class="w-72 bg-[#111111] border-r border-white/5 flex flex-col p-8 shrink-0 sticky top-0 h-screen">
    <div class="flex items-center gap-3 mb-12">
        <div class="w-10 h-10 bg-[#640D5F] rounded-xl flex items-center justify-center shadow-lg shadow-[#640D5F]/20">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <h2 class="text-xl font-bold tracking-tight">CoachPro</h2>
    </div>
    
    <nav class="flex-1 space-y-2">
        <a href="/sportif/dashbord" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Dashboard
        </a>
        <a href="/sportif/seances" class="flex items-center gap-3 bg-[#640D5F] text-white px-4 py-3 rounded-xl transition-all font-medium shadow-lg shadow-[#640D5F]/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Séances
        </a>
    </nav>

    <div class="mt-auto pt-6 border-t border-white/5">
        <a href="/logout" class="flex items-center gap-3 text-red-400/80 hover:text-red-400 hover:bg-red-400/10 px-4 py-3 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Déconnexion
        </a>
    </div>
</aside>

<!-- Main content with glassmorphism cards and purple accents -->
<main class="flex-1 p-12 overflow-y-auto relative">
    <!-- Decorative Orbs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#640D5F]/10 blur-[120px] rounded-full -z-10"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-blue-500/5 blur-[100px] rounded-full -z-10"></div>

    <header class="flex justify-between items-end mb-12">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">Séances disponibles</h1>
            <p class="text-gray-400">Trouvez et réservez votre prochaine séance d'entraînement.</p>
        </div>
    </header>

    <?php if ($message): ?>
        <div class="mb-8 p-4 rounded-2xl glass-card border-white/5 flex items-center gap-3 shadow-xl <?= str_contains($message, 'succès') ? 'text-green-400' : 'text-red-400' ?>">
            <span class="w-2 h-2 rounded-full <?= str_contains($message, 'succès') ? 'bg-green-500' : 'bg-red-500' ?> animate-pulse"></span>
            <p class="font-medium"><?= htmlspecialchars($message) ?></p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($seances as $s): ?>
            <div class="glass-card rounded-[2rem] p-8 session-card relative overflow-hidden group hover:scale-[1.02] transition-all duration-300 shadow-xl">
                <div class="accent-bar absolute top-0 left-0 w-0 h-1 bg-[#640D5F] transition-all duration-500"></div>
                
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#640D5F] to-purple-600 flex items-center justify-center font-bold text-white shadow-lg text-xl">
                        <?= strtoupper(substr($s['prenom'], 0, 1)) ?>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-lg">
                            <?= htmlspecialchars($s['prenom'] . ' ' . $s['nom']) ?>
                        </h3>
                        <span class="text-xs text-purple-400 font-bold uppercase tracking-widest">Expert Coach</span>
                    </div>
                </div>

                <div class="space-y-4 mb-8">
                    <div class="flex items-center gap-3 text-gray-300">
                        <span class="text-xl"></span>
                        <span class="font-medium italic"><?= $s['date'] ?></span>
                    </div>
                    <div class="flex items-center gap-3 text-gray-300">
                        <span class="text-xl"></span>
                        <span class="font-bold text-[#640D5F] bg-[#640D5F]/10 px-3 py-1 rounded-lg">
                            <?= $s['heure_debut'] ?> - <?= $s['heure_fin'] ?>
                        </span>
                    </div>
                </div>

                <form method="POST" action="/sportif/seances" >
                    <input type="hidden" name="seance_id" value="<?= $s['id'] ?>">
                    <input type="hidden" name="coach_id" value="<?= $s['coach_id'] ?>">
                    <button class="w-full bg-white/5 border border-white/10 hover:bg-[#640D5F] hover:border-[#640D5F] hover:text-white py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-lg group-hover:shadow-[#640D5F]/20">
                        Réserver maintenant
                    </button>
                </form>
            </div>
        <?php endforeach; ?>

        <?php if (empty($seances)): ?>
            <div class="col-span-full py-20 text-center glass-card rounded-[2.5rem] border-dashed border-2 border-white/5">
                <div class="text-5xl opacity-20 mb-4">🏋️‍♂️</div>
                <p class="text-gray-500 font-bold uppercase tracking-widest text-sm">Aucune séance disponible pour le moment</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-12">
        <a href="/sportif/dashbord" class="inline-flex items-center gap-2 text-gray-500 hover:text-purple-400 font-bold transition-all group uppercase text-xs tracking-widest">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span>
            Retour au Dashboard
        </a>
    </div>
</main>
</body>
</html>
