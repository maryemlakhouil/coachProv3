<?php
/** @var array $reservations */
/** @var string $message */
?>


<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations - CoachPro</title>
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
        <a href="/sportif/mes_reservations" class="flex items-center gap-3 bg-[#640D5F] text-white px-4 py-3 rounded-xl transition-all font-medium shadow-lg shadow-[#640D5F]/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Mes réservations
        </a>
    </nav>

    <div class="mt-auto pt-6 border-t border-white/5">
        <a href="index.php?page=logout" class="flex items-center gap-3 text-red-400/80 hover:text-red-400 hover:bg-red-400/10 px-4 py-3 rounded-xl transition-all">
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
            <h1 class="text-4xl font-extrabold tracking-tight mb-2">Mes réservations</h1>
            <p class="text-gray-400">Gérez vos séances et votre historique avec CoachPro.</p>
        </div>
    </header>

    <?php if ($message): ?>
        <div class="mb-8 p-4 rounded-2xl glass-card border-white/5 flex items-center gap-3 shadow-xl
            <?= str_contains($message, 'succès') ? 'text-green-400' : 'text-red-400' ?>">
            <span class="w-2 h-2 rounded-full <?= str_contains($message, 'succès') ? 'bg-green-500' : 'bg-red-500' ?> animate-pulse"></span>
            <p class="font-medium"><?= htmlspecialchars($message) ?></p>
        </div>
    <?php endif; ?>

    <div class="glass-card rounded-[2.5rem] overflow-hidden border-white/5 shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-white/5 border-b border-white/5">
                        <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Coach</th>
                        <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Date & Heure</th>
                        <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest">Statut</th>
                        <th class="p-6 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/5">
                <?php if (empty($reservations)): ?>
                    <tr>
                        <td colspan="4" class="p-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center text-3xl opacity-20">📅</div>
                                <p class="text-gray-500 font-medium">Aucune réservation trouvée</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($reservations as $r): ?>
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="p-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-[#640D5F] to-purple-600 flex items-center justify-center font-bold text-white shadow-lg">
                                    <?= strtoupper(substr($r['prenom'], 0, 1)) ?>
                                </div>
                                <div>
                                    <span class="block font-bold text-white group-hover:text-purple-400 transition-colors">
                                        <?= htmlspecialchars($r['prenom'] . ' ' . $r['nom']) ?>
                                    </span>
                                    <span class="text-xs text-gray-500 uppercase font-semibold">Coach Sportif</span>
                                </div>
                            </div>
                        </td>

                        <td class="p-6">
                            <div class="flex flex-col gap-1">
                                <span class="text-white font-medium italic"> <?= $r['date'] ?></span>
                                <span class="text-xs text-purple-400 font-bold bg-purple-400/10 px-2 py-0.5 rounded w-fit">
                                     <?= $r['heure_debut'] ?> - <?= $r['heure_fin'] ?>
                                </span>
                            </div>
                        </td>

                        <td class="p-6">
                            <?php
                                $statusStyles = [
                                    'en_attente' => ['bg' => 'bg-yellow-500/10', 'text' => 'text-yellow-500', 'label' => 'En attente'],
                                    'acceptee'   => ['bg' => 'bg-green-500/10', 'text' => 'text-green-500', 'label' => 'Acceptée'],
                                    'refusee'    => ['bg' => 'bg-red-500/10', 'text' => 'text-red-500', 'label' => 'Refusée'],
                                    'annulee'    => ['bg' => 'bg-white/5', 'text' => 'text-gray-500', 'label' => 'Annulée']
                                ];
                                $s = $statusStyles[$r['status']] ?? ['bg' => 'bg-white/5', 'text' => 'text-gray-400', 'label' => $r['status']];
                            ?>
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest <?= $s['bg'] ?> <?= $s['text'] ?> border border-white/5">
                                <?= $s['label'] ?>
                            </span>
                        </td>

                        <td class="p-6 text-right">
                            <?php if ($r['status'] === 'en_attente'): ?>
                                <form method="POST" action="/sportif/mes_reservations">
                                    <input type="hidden" name="reservation_id" value="<?= $r['id'] ?>">
                                    <button name="annuler"
                                        class="bg-white/5 border border-white/10 text-red-400 hover:bg-red-500 hover:text-white hover:border-red-500 px-6 py-2 rounded-xl text-xs font-bold transition-all uppercase tracking-widest">
                                        Annuler
                                    </button>
                                </form>
                            <?php else: ?>
                                <span class="text-gray-700 italic text-sm">Action indisponible</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
