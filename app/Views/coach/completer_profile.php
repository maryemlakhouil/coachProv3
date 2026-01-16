<?php /** @var array $profile */ ?>
<?php /** @var string|null $error */ ?>


<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compléter mon profil | Coach</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(20, 20, 20, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-focus {
            transition: all 0.2s ease;
        }
        .input-focus:focus {
            border-color: #640D5F;
            box-shadow: 0 0 0 2px rgba(100, 13, 95, 0.2);
        }
    </style>
</head>

<body class="bg-[#0A0A0A] text-gray-200 min-h-screen flex items-center justify-center p-4">
    <!-- Ajout d'un fond décoratif avec des dégradés subtils -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-[#640D5F]/10 blur-[120px] rounded-full"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-[#640D5F]/5 blur-[120px] rounded-full"></div>
    </div>

    <div class="max-w-xl w-full relative z-10">
        <!-- En-tête avec logo ou icône -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#640D5F]/20 rounded-2xl mb-4 border border-[#640D5F]/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-[#640D5F]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight">Compléter mon profil</h1>
            <p class="text-gray-400 mt-2">Présentez-vous à vos futurs sportifs</p>
        </div>

        <?php if ($message): ?>
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl mb-6 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire avec style "glassmorphism" et champs raffinés -->
        <form method="POST" class="glass-card p-8 rounded-[2rem] shadow-2xl space-y-6">
            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-300 ml-1">Biographie</label>
                <textarea name="biographie" required
                    placeholder="Décrivez votre approche et votre passion..."
                    class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white placeholder-gray-500 focus:outline-none input-focus resize-none"
                    rows="4"><?= htmlspecialchars($profile['biographie'] ?? '')?></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 ml-1">Années d'expérience</label>
                    <div class="relative">
                        <input type="number" name="experience" min="0" required
                            value="<?= (int)($profile['experience'] ?? 0) ?>"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:outline-none input-focus pl-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-4 w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-300 ml-1">Certification</label>
                    <div class="relative">
                        <input type="text" name="certification" placeholder="Ex: BPJEPS AF"
                            value="<?= htmlspecialchars($profile['certification'] ?? '')?>"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:outline-none input-focus pl-12">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-4 w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-gray-300 ml-1">Photo de profil (URL)</label>
                <div class="relative">
                    <input type="text" name="photo" placeholder="https://..."
                        value="<?= htmlspecialchars(($profile['photo'] ?? '') )?>"
                        class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:outline-none input-focus pl-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-4 w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <!-- Bouton de soumission stylisé avec dégradé et ombre -->
            <button class="w-full bg-[#640D5F] hover:bg-[#7a1074] text-white font-semibold py-4 rounded-2xl transition-all shadow-lg shadow-[#640D5F]/20 flex items-center justify-center gap-2 mt-4 group">
                Enregistrer le profil
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>
        
        <p class="text-center text-gray-500 text-sm mt-8">
            En continuant, vous acceptez nos conditions d'utilisation.
        </p>
    </div>
</body>
</html>