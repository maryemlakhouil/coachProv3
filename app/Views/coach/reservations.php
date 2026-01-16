
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Hub | Réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-card-custom { background-color: #1a1a1a; }
        .border-subtle { border-color: #2a2a2a; }
        .text-muted-custom { color: #a1a1aa; }
        .brand-purple { background-color: #640d5f; }
    </style>
</head>

<body class="bg-[#0f0f0f] text-[#f4f4f5] min-h-screen flex selection:bg-purple-500/30">

    <!-- Sidebar (Consistent with Dashboard and Profile) -->
    <aside class="w-72 border-r border-subtle flex flex-col fixed h-full bg-[#0f0f0f] z-20">
        <div class="p-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-10 h-10 brand-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="m3.34 19 1.4-1.4"/><path d="m19 3.34-1.4 1.4"/><circle cx="12" cy="12" r="10"/><path d="m8 10 4 4"/></svg>
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-white">Coach<span class="text-purple-400">Hub</span></h2>
            </div>
            
            <nav class="space-y-1.5">
                <a href="dashbord_coach.php" class="flex items-center gap-3.5 px-4 py-3 text-sm font-medium text-muted-custom hover:text-white hover:bg-white/5 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Dashboard
                </a>
                <a href="profile.php" class="flex items-center gap-3.5 px-4 py-3 text-sm font-medium text-muted-custom hover:text-white hover:bg-white/5 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Mon Profil
                </a>
                <a href="reservations.php" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl bg-purple-600/10 text-purple-400 border border-purple-500/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Réservations
                </a>
            </nav>
        </div>
        
        <div class="mt-auto p-8 border-t border-subtle">
            <a href="/logout.php" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold text-red-400/80 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Déconnexion
            </a>
        </div>
    </aside>

    <main class="flex-1 ml-72 p-12 max-w-[1400px] mx-auto w-full">
        <header class="mb-14">
            <p class="text-[11px] font-bold text-purple-400 mb-2 uppercase tracking-[0.2em]">Gestion de planning</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white">Réservations en attente</h1>
        </header>

        <section class="bg-card-custom border border-subtle rounded-[2.5rem] overflow-hidden shadow-2xl shadow-black/40">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white/5 text-muted-custom text-[10px] font-black uppercase tracking-[0.2em]">
                            <th class="px-10 py-6">Sportif</th>
                            <th class="px-10 py-6">Date</th>
                            <th class="px-10 py-6">Heure</th>
                            <th class="px-10 py-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-subtle">
                        <?php if (empty($reservations)): ?>
                            <tr>
                                <td colspan="4" class="px-10 py-20 text-center text-muted-custom text-sm font-medium italic opacity-60">
                                    Aucune réservation en attente pour le moment.
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($reservations as $r): ?>
                            <tr class="group hover:bg-white/[0.02] transition-colors">
                                <td class="px-10 py-7">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-xs font-bold text-white border border-subtle">
                                            <?= strtoupper(substr($r['prenom'], 0, 1) . substr($r['nom'], 0, 1)) ?>
                                        </div>
                                        <span class="text-sm font-semibold text-white"><?= htmlspecialchars($r['prenom'].' '.$r['nom']) ?></span>
                                    </div>
                                </td>
                                <td class="px-10 py-7 text-sm font-medium text-muted-custom">
                                    <?= date('d.m.Y', strtotime($r['date'])) ?>
                                </td>
                                <td class="px-10 py-7 text-sm font-medium text-white">
                                    <?= substr($r['heure_debut'], 0, 5) ?> <span class="text-muted-custom/40 mx-1">-</span> <?= substr($r['heure_fin'], 0, 5) ?>
                                </td>
                                <td class="px-10 py-7 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="reservation_id" value="<?= $r['id'] ?>">
                                            <button name="action" value="accepter" class="px-4 py-2 bg-green-500/10 text-green-400 border border-green-500/20 text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-green-500 hover:text-white transition-all">
                                                Accepter
                                            </button>
                                        </form>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="reservation_id" value="<?= $r['id'] ?>">
                                            <button name="action" value="refuser" class="px-4 py-2 bg-red-500/10 text-red-400 border border-red-500/20 text-[10px] font-bold uppercase tracking-widest rounded-lg hover:bg-red-500 hover:text-white transition-all">
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>
</html>
