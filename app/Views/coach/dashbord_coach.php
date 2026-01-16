
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Panel | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for specific elements while leveraging Tailwind */
        body { font-family: 'Inter', sans-serif; }
        .bg-card-custom { background-color: #1a1a1a; }
        .border-subtle { border-color: #2a2a2a; }
        .text-muted-custom { color: #a1a1aa; }
        .brand-purple { background-color: #640d5f; }
        .brand-purple-text { color: #640d5f; }
    </style>
</head>

<body class="bg-[#0f0f0f] text-[#f4f4f5] min-h-screen flex selection:bg-purple-500/30">

    <!-- Sidebar -->
    <aside class="w-72 border-r border-subtle flex flex-col fixed h-full bg-[#0f0f0f] z-20 transition-all duration-300">
        <div class="p-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-10 h-10 brand-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="m3.34 19 1.4-1.4"/><path d="m19 3.34-1.4 1.4"/><circle cx="12" cy="12" r="10"/><path d="m8 10 4 4"/></svg>
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-white">Coach<span class="text-purple-400">Hub</span></h2>
            </div>
            
            <nav class="space-y-1.5">
                <a href="/coach/dashbord" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl bg-purple-600/10 text-purple-400 border border-purple-500/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Dashboard
                </a>
                <a href="/coach/profile"class="flex items-center gap-3.5 px-4 py-3 text-sm font-medium text-muted-custom hover:text-white hover:bg-white/5 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Mon Profil
                </a>
                <a href="/coach/reservations" class="flex items-center gap-3.5 px-4 py-3 text-sm font-medium text-muted-custom hover:text-white hover:bg-white/5 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Réservations
                </a>
            </nav>
        </div>

        <div class="mt-auto p-8 border-t border-subtle">
            <a href="Views/auth/logout" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold text-red-400/80 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Déconnexion
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-72 p-12 max-w-[1400px] mx-auto w-full">
        <header class="mb-14 flex justify-between items-end">
            <div>
                <p class="text-[11px] font-bold text-purple-400 mb-2 uppercase tracking-[0.2em]">Vue d'ensemble</p>
                <h1 class="text-4xl font-extrabold tracking-tight text-white">Dashboard Coach</h1>
            </div>
            <div class="text-right flex flex-col items-end">
                <div class="flex items-center gap-2 mb-1">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-green-400">Live Status</span>
                </div>
                <p class="text-sm font-medium text-muted-custom"><?= date('l, d F Y') ?></p>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid md:grid-cols-3 gap-8 mb-14">
            <div class="bg-card-custom border border-subtle p-8 rounded-[2rem] relative overflow-hidden group hover:border-purple-500/40 transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-500/5 rounded-full blur-2xl group-hover:bg-purple-500/10 transition-all"></div>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-11 h-11 rounded-2xl bg-purple-500/10 flex items-center justify-center text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                    </div>
                    <p class="text-xs font-bold text-muted-custom uppercase tracking-wider">Attente</p>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-black text-white"><?= $stats['pending'] ?></p>
                    <span class="text-xs font-semibold text-purple-400/60 lowercase">demandes</span>
                </div>
            </div>

            <div class="bg-card-custom border border-subtle p-8 rounded-[2rem] relative overflow-hidden group hover:border-green-500/40 transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/5 rounded-full blur-2xl group-hover:bg-green-500/10 transition-all"></div>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-11 h-11 rounded-2xl bg-green-500/10 flex items-center justify-center text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <p class="text-xs font-bold text-muted-custom uppercase tracking-wider">Aujourd'hui</p>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-black text-white"><?= $stats['today'] ?></p>
                    <span class="text-xs font-semibold text-green-400/60 lowercase">séances</span>
                </div>
            </div>

            <div class="bg-card-custom border border-subtle p-8 rounded-[2rem] relative overflow-hidden group hover:border-blue-500/40 transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-500/5 rounded-full blur-2xl group-hover:bg-blue-500/10 transition-all"></div>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-11 h-11 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <p class="text-xs font-bold text-muted-custom uppercase tracking-wider">Demain</p>
                </div>
                <div class="flex items-baseline gap-2">
                    <p class="text-5xl font-black text-white"><?= $stats['tomorrow'] ?></p>
                    <span class="text-xs font-semibold text-blue-400/60 lowercase">séances</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-12">
            <!-- Availability Management -->
            <div class="lg:col-span-3 space-y-10">
                <section class="bg-card-custom border border-subtle rounded-[2.5rem] overflow-hidden shadow-2xl shadow-black/40">
                    <div class="p-10 border-b border-subtle flex justify-between items-center bg-white/[0.01]">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-1">Disponibilités</h2>
                            <p class="text-xs text-muted-custom">Gérez vos créneaux horaires libres pour vos élèves.</p>
                        </div>
                        <button onclick="document.getElementById('add-dispo-form').classList.toggle('hidden')" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-500 text-white text-[11px] font-bold uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-purple-600/20 active:scale-95">
                            Nouveau Créneau
                        </button>
                    </div>
                    
                    <div id="add-dispo-form" class="p-10 bg-[#212121] border-b border-subtle hidden animate-in slide-in-from-top duration-300">
                        <form method="POST" class="grid md:grid-cols-3 gap-6">
                            <input type="hidden" name="add_dispo">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em]">Date de séance</label>
                                <input type="date" name="date" required class="w-full bg-[#121212] border border-subtle rounded-xl p-4 text-sm text-white focus:ring-2 focus:ring-purple-500/40 outline-none transition-all cursor-pointer">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em]">Heure Début</label>
                                <input type="time" name="heure_debut" required class="w-full bg-[#121212] border border-subtle rounded-xl p-4 text-sm text-white focus:ring-2 focus:ring-purple-500/40 outline-none transition-all cursor-pointer">
                            </div>
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em]">Heure Fin</label>
                                <input type="time" name="heure_fin" required class="w-full bg-[#121212] border border-subtle rounded-xl p-4 text-sm text-white focus:ring-2 focus:ring-purple-500/40 outline-none transition-all cursor-pointer">
                            </div>
                            <div class="md:col-span-3 pt-4">
                                <button class="w-full brand-purple text-white font-bold py-4 rounded-xl hover:brightness-125 transition-all shadow-xl shadow-purple-900/40 active:scale-[0.98]">
                                    Ajouter à mon calendrier
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-white/5 text-muted-custom text-[10px] font-black uppercase tracking-[0.2em]">
                                    <th class="px-10 py-6">Date</th>
                                    <th class="px-10 py-6">Créneau</th>
                                    <th class="px-10 py-6">Statut</th>
                                    <th class="px-10 py-6 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-subtle">
                                <?php foreach ($dispos as $d): ?>
                                <tr class="group hover:bg-white/[0.02] transition-colors">
                                    <td class="px-10 py-7 text-sm font-semibold text-white"><?= date('d.m.Y', strtotime($d['date'])) ?></td>
                                    <td class="px-10 py-7 text-sm font-medium text-muted-custom">
                                        <span class="text-white"><?= substr($d['heure_debut'], 0, 5) ?></span> 
                                        <span class="mx-2 text-muted-custom/40">→</span> 
                                        <span class="text-white"><?= substr($d['heure_fin'], 0, 5) ?></span>
                                    </td>
                                    <td class="px-10 py-7">
                                        <?php if ($d['status'] === 'libre'): ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-green-500/10 text-green-400 border border-green-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                                Disponible
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                                Réserve
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-10 py-7 text-right">
                                        <?php if ($d['status'] === 'libre'): ?>
                                            <a href="?delete_dispo=<?= $d['id'] ?>" class="text-[11px] font-bold text-red-400/80 hover:text-red-400 uppercase tracking-widest transition-colors hover:underline underline-offset-8 decoration-2">
                                                Supprimer
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted-custom/20 text-xs">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($dispos)): ?>
                                <tr>
                                    <td colspan="4" class="px-10 py-20 text-center text-muted-custom text-sm font-medium italic opacity-60">
                                        Vous n'avez aucun créneau enregistré pour le moment.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Next Session Card -->
                <div class="bg-card-custom border border-subtle p-10 rounded-[2.5rem] relative shadow-xl shadow-black/20 overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 brand-purple/5 blur-3xl rounded-full"></div>
                    <div class="flex items-center gap-4 mb-10 relative">
                        <div class="w-11 h-11 rounded-2xl bg-purple-500/10 flex items-center justify-center text-purple-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/><path d="M8 18h.01"/><path d="M12 18h.01"/><path d="M16 18h.01"/></svg>
                        </div>
                        <h2 class="text-xl font-bold text-white">Prochaine séance</h2>
                    </div>

                    <?php if ($stats['next']): ?>
                        <div class="space-y-8 relative">
                            <div class="flex items-center gap-6 p-6 bg-white/[0.03] rounded-[2rem] border border-subtle">
                                <div class="w-16 h-16 rounded-2xl brand-purple flex items-center justify-center text-xl font-black text-white shadow-lg shadow-purple-900/30">
                                    <?= strtoupper(substr($stats['next']['prenom'], 0, 1) . substr($stats['next']['nom'], 0, 1)) ?>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-lg font-extrabold text-white leading-tight"><?= htmlspecialchars($stats['next']['prenom'] . ' ' . $stats['next']['nom']) ?></p>
                                    <p class="text-xs font-bold text-purple-400 uppercase tracking-widest"><?= date('d F Y', strtotime($stats['next']['date'])) ?></p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between px-6">
                                <div class="flex items-center gap-3 text-sm font-semibold text-muted-custom">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <span class="text-white"><?= substr($stats['next']['heure_debut'], 0, 5) ?> - <?= substr($stats['next']['heure_fin'], 0, 5) ?></span>
                                </div>
                                <button class="text-[10px] font-black uppercase tracking-widest text-purple-400 hover:text-white transition-colors">Détails</button>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="py-12 border-2 border-dashed border-subtle rounded-[2rem] text-center px-6">
                            <p class="text-sm font-medium text-muted-custom/60 italic leading-relaxed">Aucun élève n'a réservé pour le moment.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Coach Tip -->
                <div class="bg-gradient-to-br from-purple-600/20 to-transparent border border-purple-500/20 p-10 rounded-[2.5rem] relative overflow-hidden group">
                    <div class="absolute -right-12 -bottom-12 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl group-hover:bg-purple-500/20 transition-all duration-700"></div>
                    <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center text-purple-400 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Conseil de visibilité</h3>
                    <p class="text-sm text-muted-custom leading-relaxed font-medium">
                        Les coachs qui ajoutent au moins <span class="text-white font-bold">5 créneaux</span> par semaine ont <span class="text-green-400 font-bold">40% de réservations</span> en plus.
                    </p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
