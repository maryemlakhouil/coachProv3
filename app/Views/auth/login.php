<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | CoachPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
        <style>
            body { font-family: 'Inter', sans-serif; }
            .bg-custom-dark { background-color: #0A0A0A; }
            .bg-card-dark { background-color: #141414; }
            .border-custom-purple { border-color: rgba(100, 13, 95, 0.3); }
            .text-custom-purple { color: #640D5F; }
            .bg-custom-purple { background-color: #640D5F; }
        </style>
</head>
 <body class="bg-custom-dark text-gray-100 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
        <!-- Background Orbs -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute bottom-0 -right-4 w-72 h-72 bg-pink-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 bg-card-dark rounded-[2.5rem] border border-white/10 shadow-2xl overflow-hidden relative z-10">
            
            <!-- LEFT : Form -->
            <div class="flex items-center justify-center p-8 md:p-12 lg:p-16">
                <div class="w-full max-w-sm">
                    <div class="mb-10 text-center md:text-left">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-custom-purple mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                        </div>
                        <h2 class="text-3xl font-bold tracking-tight text-white mb-2">Bienvenue</h2>
                        <p class="text-gray-400">Connectez-vous pour accéder à CoachPro</p>
                    </div>
                    
                    <?php if (!empty($error)) : ?>
                        <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl mb-6 text-sm">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                <?= htmlspecialchars($error) ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-300 ml-1">Adresse email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-custom-purple transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </div>
                                <input type="email" name="email" 
                                    class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-custom-purple/50 focus:border-custom-purple transition-all placeholder:text-gray-600" 
                                    placeholder="nom@exemple.com" required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-sm font-medium text-gray-300">Mot de passe</label>
                                <a href="#" class="text-xs text-custom-purple hover:underline opacity-80">Oublié ?</a>
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-custom-purple transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                </div>
                                <input type="password" name="password" 
                                    class="w-full bg-white/5 border border-white/10 rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-custom-purple/50 focus:border-custom-purple transition-all placeholder:text-gray-600" 
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <button class="w-full bg-custom-purple hover:bg-custom-purple/90 text-white py-3.5 rounded-xl font-semibold transition-all shadow-lg shadow-purple-900/20 active:scale-[0.98]">
                            Se connecter
                        </button>
                    </form>

                    <p class="text-sm text-gray-500 mt-10 text-center">
                        Pas encore de compte ?
                        <a href="register.php" class="text-custom-purple font-semibold hover:text-custom-purple/80 transition-colors">Créer un compte</a>
                    </p>
                </div>
            </div>

            <!-- RIGHT : Aesthetic Panel -->
            <div class="hidden md:block relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-custom-purple/40 to-black/80 z-10"></div>
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=2070&auto=format&fit=crop" 
                    alt="Sport Training" 
                    class="absolute inset-0 w-full h-full object-cover scale-105 hover:scale-110 transition-transform duration-10000">
                
                <div class="absolute bottom-0 left-0 right-0 p-12 z-20">
                    <div class="backdrop-blur-md bg-white/5 border border-white/10 p-6 rounded-2xl">
                        <p class="text-white text-lg font-medium italic mb-2">"Le succès n'est pas final, l'échec n'est pas fatal : c'est le courage de continuer qui compte."</p>
                        <p class="text-gray-400 text-sm">— Winston Churchill</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>



