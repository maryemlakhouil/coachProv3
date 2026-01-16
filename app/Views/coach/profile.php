
<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil | CoachHub</title>
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

    <!-- Sidebar (Same as Dashboard for consistency) -->
    <aside class="w-72 border-r border-subtle flex flex-col fixed h-full bg-[#0f0f0f] z-20">
        <div class="p-8">
            <div class="flex items-center gap-4 mb-12">
                <div class="w-10 h-10 brand-purple rounded-xl flex items-center justify-center shadow-lg shadow-purple-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="m3.34 19 1.4-1.4"/><path d="m19 3.34-1.4 1.4"/><circle cx="12" cy="12" r="10"/><path d="m8 10 4 4"/></svg>
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-white">Coach<span class="text-purple-400">Hub</span></h2>
            </div>
            
            <nav class="space-y-1.5">
                <a href="/coach/dashbord_coach" class="flex items-center gap-3.5 px-4 py-3 text-sm font-medium text-muted-custom hover:text-white hover:bg-white/5 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Dashboard
                </a>
                <a href="/coach/profile" class="flex items-center gap-3.5 px-4 py-3 text-sm font-semibold rounded-xl bg-purple-600/10 text-purple-400 border border-purple-500/20 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Mon Profil
                </a>
                <a href="/coach/reservations" class="flex items-center gap-3.5 px-4 py-3 text-sm font-medium text-muted-custom hover:text-white hover:bg-white/5 rounded-xl transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Réservations
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 ml-72 p-12 max-w-[1000px] mx-auto w-full">
        <header class="mb-14">
            <p class="text-[11px] font-bold text-purple-400 mb-2 uppercase tracking-[0.2em]">Paramètres du compte</p>
            <h1 class="text-4xl font-extrabold tracking-tight text-white">Mon Profil</h1>
        </header>

        <?php if ($message): ?>
            <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3 text-sm font-medium animate-in fade-in slide-in-from-top-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" class="space-y-10">
            <!-- Basic Info Card -->
            <section class="bg-card-custom border border-subtle rounded-[2.5rem] p-10 shadow-2xl shadow-black/40 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 brand-purple/5 blur-3xl rounded-full"></div>
                
                <div class="grid md:grid-cols-4 gap-12 items-start">
                    <!-- Photo Upload Area -->
                    <div class="md:col-span-1 space-y-6">
                        <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em] block text-center md:text-left">Photo de profil</label>
                        <div class="relative group mx-auto md:mx-0 w-40 h-40">
                            <?php if ($coach->getPhoto()): ?>
                                <img src="<?= htmlspecialchars($coach->getPhoto()) ?>" class="w-40 h-40 object-cover rounded-[2.5rem] border-2 border-subtle shadow-xl group-hover:border-purple-500/40 transition-all">
                            <?php else: ?>
                                <div class="w-40 h-40 bg-white/5 rounded-[2.5rem] border-2 border-dashed border-subtle flex items-center justify-center group-hover:border-purple-500/40 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#a1a1aa" stroke-width="1.5"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                            <?php endif; ?>
                            <div class="mt-4">
                                <label class="cursor-pointer text-[10px] font-bold text-purple-400 uppercase tracking-widest text-center block hover:text-white transition-colors">
                                    Modifier
                                    <input type="file" name="photo" accept="image/*" class="hidden">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Fields -->
                    <div class="md:col-span-3 space-y-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em]">Biographie professionnelle</label>
                            <textarea name="biographie" rows="5" class="w-full bg-[#121212] border border-subtle rounded-2xl p-5 text-sm text-white focus:ring-2 focus:ring-purple-500/40 outline-none transition-all placeholder:text-muted-custom/30" placeholder="Décrivez votre parcours et votre approche du coaching..."><?= htmlspecialchars($coach->getBiographie()) ?></textarea>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em]">Expérience (Années)</label>
                                <div class="relative">
                                    <input type="number" name="experience" value="<?= $coach->getExperience() ?>" class="w-full bg-[#121212] border border-subtle rounded-2xl p-5 text-sm text-white focus:ring-2 focus:ring-purple-500/40 outline-none transition-all pr-12">
                                    <span class="absolute right-5 top-1/2 -translate-y-1/2 text-muted-custom/40 text-[10px] font-bold uppercase">ans</span>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <label class="text-[10px] font-black text-muted-custom uppercase tracking-[0.15em]">Certification (.png, .jpg)</label>
                                <div class="relative h-[62px]">
                                    <input type="file" name="certification" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                    <div class="absolute inset-0 bg-[#121212] border border-subtle rounded-2xl flex items-center justify-between px-5 transition-all group-hover:border-purple-500/40">
                                        <span class="text-xs text-muted-custom italic truncate max-w-[150px]">
                                            <?= $coach->getCertification() ? 'Certification chargée' : 'Choisir un fichier...' ?>
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-purple-400"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                                    </div>
                                </div>
                                <?php if ($coach->getCertification()): ?>
                                    <p class="text-[9px] text-green-400 font-bold uppercase tracking-widest mt-2 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                        Vérifiée
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="flex justify-end pt-4">
                <button type="submit" class="brand-purple text-white px-10 py-5 rounded-2xl text-sm font-bold uppercase tracking-widest hover:brightness-125 transition-all shadow-xl shadow-purple-900/40 active:scale-[0.98]">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </main>

</body>
</html>
