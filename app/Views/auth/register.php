<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription | CoachPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-dark-900 { background-color: #0A0A0A; }
        .bg-dark-800 { background-color: #141414; }
        .border-dark-700 { border-color: #262626; }
        .text-brand-purple { color: #640D5F; }
        .bg-brand-purple { background-color: #640D5F; }
    </style>
</head>

<body class="min-h-screen bg-dark-900 text-gray-100 flex items-center justify-center p-4">

    <!-- Background Decorative Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-brand-purple/10 blur-[120px] rounded-full"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] bg-brand-purple/10 blur-[120px] rounded-full"></div>
    </div>

    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 bg-dark-800 rounded-[2.5rem] border border-dark-700 overflow-hidden shadow-2xl relative z-10">
        
        <!-- LEFT : Info Panel -->
        <div class="hidden md:flex flex-col justify-between p-12 bg-cover bg-center relative"
            style="background-image: linear-gradient(rgba(100, 13, 95, 0.8), rgba(0, 0, 0, 0.9)), url('../images/Sport1.jpg');">
            <div>
                <div class="text-2xl font-bold flex items-center gap-2 mb-8">
                    <div class="w-8 h-8 bg-brand-purple rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <span>CoachPro</span>
                </div>
                <h2 class="text-4xl font-extrabold leading-tight mb-6 text-balance">
                    Propulsez votre <span class="text-brand-purple">potentiel</span> sportif au niveau supérieur.
                </h2>
                <p class="text-gray-300 text-lg max-w-md">
                    Rejoignez une communauté de passionnés et accédez à des outils de coaching professionnels conçus pour la performance.
                </p>
            </div>

            <div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-2xl">
                <p class="text-sm italic text-gray-400">"La différence entre l'impossible et le possible réside dans la détermination."</p>
            </div>
        </div>

        <!-- RIGHT : Form -->
        <div class="flex items-center justify-center p-8 md:p-12 bg-dark-800">
            <div class="w-full max-w-sm">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold mb-2">Créer un compte</h1>
                    <p class="text-gray-500">Rejoignez la communauté CoachPro dès aujourd'hui.</p>
                </div>

                <?php if ($error) : ?>
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <?php if ($success) : ?>
                    <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl mb-6 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-400 ml-1">Nom</label>
                            <input type="text" name="nom" placeholder="Doe" class="w-full bg-dark-900 border border-dark-700 p-3 rounded-xl focus:outline-none focus:border-brand-purple transition-colors text-sm">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-medium text-gray-400 ml-1">Prénom</label>
                            <input type="text" name="prenom" placeholder="John" class="w-full bg-dark-900 border border-dark-700 p-3 rounded-xl focus:outline-none focus:border-brand-purple transition-colors text-sm">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-gray-400 ml-1">Email</label>
                        <input type="email" name="email" placeholder="john@example.com" class="w-full bg-dark-900 border border-dark-700 p-3 rounded-xl focus:outline-none focus:border-brand-purple transition-colors text-sm">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-gray-400 ml-1">Mot de passe</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-dark-900 border border-dark-700 p-3 rounded-xl focus:outline-none focus:border-brand-purple transition-colors text-sm">
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-medium text-gray-400 ml-1">Rôle</label>
                        <select name="role" class="w-full bg-dark-900 border border-dark-700 p-3 rounded-xl focus:outline-none focus:border-brand-purple transition-colors text-sm appearance-none cursor-pointer">
                            <option value="">Choisir un rôle</option>
                            <option value="sportif">Sportif</option>
                            <option value="coach">Coach</option>
                        </select>
                    </div>

                    <button class="w-full bg-brand-purple hover:bg-brand-purple/90 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-brand-purple/20 mt-2">
                        Créer mon compte
                    </button>
                </form>

                <p class="text-sm text-gray-500 mt-8 text-center">
                    Déjà inscrit ?
                    <a href="login.php" class="text-brand-purple font-semibold hover:underline decoration-brand-purple/30">Se connecter</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>





