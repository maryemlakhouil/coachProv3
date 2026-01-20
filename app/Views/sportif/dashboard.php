<?php

/** @var \App\Models\Utilisateur $user */
?>


<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sportif - CoachPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="bg-[#0A0A0A] text-gray-100 flex min-h-screen">

<!-- Sidebar -->
<aside class="w-72 bg-[#111111] border-r border-white/5 flex flex-col p-8 shrink-0">
    <div class="flex items-center gap-3 mb-12">
        <div class="w-10 h-10 bg-[#640D5F] rounded-xl flex items-center justify-center shadow-lg shadow-[#640D5F]/20">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <h2 class="text-xl font-bold tracking-tight">CoachPro</h2>
    </div>
    
    <nav class="flex-1 space-y-2">
        <a href="#" class="flex items-center gap-3 bg-[#640D5F] text-white px-4 py-3 rounded-xl transition-all font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            Dashboard
        </a>
        <a href="index.php?page=mes_reservations" class="flex items-center gap-3 text-gray-400 hover:text-white hover:bg-white/5 px-4 py-3 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Mes réservations
        </a>
    </nav>

    <div class="mt-auto pt-6 border-t border-white/5">
        <a href="index.php?page=auth.logout" class="flex items-center gap-3 text-red-400/80 hover:text-red-400 hover:bg-red-400/10 px-4 py-3 rounded-xl transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Déconnexion
        </a>
    </div>
</aside>

<!-- Content -->
<main class="flex-1 p-12 overflow-y-auto relative">
    <!-- Decorative Orbs -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#640D5F]/10 blur-[120px] rounded-full -z-10"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-blue-500/5 blur-[100px] rounded-full -z-10"></div>

    <header class="flex justify-between items-end mb-12">
        <div>
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">Dashboard Sportif</h1>
            <p class="text-gray-400">Trouvez votre coach et gérez vos séances.</p>
        </div>
        <div class="flex items-center gap-3 px-4 py-2 glass-card rounded-2xl border-white/5 text-sm">
            <span class="flex h-2 w-2 rounded-full bg-green-500 animate-ping"></span>
            Session Active
        </div>
    </header>

    <!-- Stats -->
    <div class="grid md:grid-cols-2 gap-8 mb-16">
        <div class="glass-card p-8 rounded-[2.5rem] relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 blur-3xl rounded-full transition-all group-hover:scale-150"></div>
            <div class="relative">
                <p class="text-gray-400 font-medium mb-1">Séances réservées</p>
                <div class="flex items-baseline gap-3">
                    <p class="text-6xl font-black text-white"><?= $stats['reserved'] ?></p>
                    <span class="text-green-500 text-sm font-bold bg-green-500/10 px-2 py-1 rounded-lg">Confirmées</span>
                </div>
            </div>
        </div>

        <div class="glass-card p-8 rounded-[2.5rem] relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/10 blur-3xl rounded-full transition-all group-hover:scale-150"></div>
            <div class="relative">
                <p class="text-gray-400 font-medium mb-1">Demandes en attente</p>
                <div class="flex items-baseline gap-3">
                    <p class="text-6xl font-black text-white"><?= $stats['pending'] ?></p>
                    <span class="text-yellow-500 text-sm font-bold bg-yellow-500/10 px-2 py-1 rounded-lg">En révision</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des coachs -->
    <section>
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold tracking-tight">Coachs disponibles</h2>
            <div class="h-px flex-1 bg-white/5 mx-6"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach ($coachs as $coach): ?>
                <div class="glass-card rounded-[2.5rem] overflow-hidden group transition-all hover:-translate-y-2 hover:border-[#640D5F]/30 hover:shadow-2xl hover:shadow-[#640D5F]/10">
                    <div class="p-8 pb-0 text-center">
                        <div class="relative inline-block mb-6">
                            <div class="absolute inset-0 bg-gradient-to-tr from-[#640D5F] to-transparent rounded-full blur-md opacity-20 group-hover:opacity-40 transition-opacity"></div>
                            <img
                                src="<?= !empty($coach['photo']) 
                                    ? htmlspecialchars($coach['photo']) 
                                    : 'https://via.placeholder.com/150?text=Coach' ?>"
                                class="w-32 h-32 rounded-full mx-auto object-cover relative ring-4 ring-[#1A1A1A] group-hover:ring-[#640D5F]/20 transition-all"
                                alt="<?= htmlspecialchars($coach['prenom'] ?? 'Coach') ?>"
                            >
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">
                            <?= htmlspecialchars($coach['prenom'].' '.$coach['nom']) ?>
                        </h3>
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <span class="text-xs font-semibold bg-white/5 text-gray-400 px-3 py-1 rounded-full border border-white/5">
                                <?= $coach['experience'] ?> ans d'exp.
                            </span>
                        </div>
                        <p class="text-gray-400 text-sm mt-2">
                            <?= !empty($coach['biographie'])
                                ? htmlspecialchars(substr($coach['biographie'], 0, 80)) . '...'
                                : 'Biographie non renseignée.' ?>
                        </p>
                        </div>
                    
                    <div class="p-4 bg-white/5 border-t border-white/5">
                        <a href="index.php?page=seances&coach_id=<?= $coach['id'] ?>"
                           class="flex items-center justify-center gap-2 w-full bg-white text-black font-bold py-4 rounded-2xl transition-all hover:bg-[#640D5F] hover:text-white group/btn">
                            Voir disponibilités
                            <svg class="w-5 h-5 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4-4m4 4H3"/></svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
</body>
</html>
