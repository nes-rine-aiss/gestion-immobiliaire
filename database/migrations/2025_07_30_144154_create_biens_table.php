<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->string('titre'); // Titre du bien (ex: "Appartement moderne centre-ville")
            $table->text('description'); // Description détaillée du bien (équipements, ambiance, etc.)
            // Type de bien avec valeurs limitées pour garantir la cohérence des données
            $table->enum('type', [
                'appartement',     // Appartement classique
                'maison',          // Maison individuelle
                'villa',           // Villa avec jardin/piscine
                'studio',          // Studio (1 pièce)
                'bureau',          // Espace de travail
                'local_commercial' // Commerce, magasin
            ]);
            // === INFORMATIONS TARIFAIRES ===
            // Prix par nuit en DA (decimal(10,2) = jusqu'à 99,999,999.99 DA)
            $table->decimal('prix_par_nuit', 10, 2);
            
            // === CARACTÉRISTIQUES PHYSIQUES DU BIEN ===
            // Nombre de chambres (nullable car un studio n'a pas de chambre séparée)
            $table->integer('nb_chambres')->nullable();
            
            // Superficie en m² (optionnelle, decimal(8,2) = jusqu'à 999,999.99 m²)
            $table->decimal('superficie', 8, 2)->nullable();
            
            // === INFORMATIONS D'ADRESSE ET LOCALISATION ===
            $table->string('adresse'); // Adresse complète (rue, numéro)
            $table->string('ville'); // Ville où se situe le bien
            $table->string('code_postal', 10); // Code postal (string pour gérer différents formats)
           
        
            // === STATUT ET DISPONIBILITÉ ===
            // Statut du bien dans le système
            $table->enum('statut', [
                'actif',         // Visible et réservable
                'inactif',       // Masqué temporairement
                'en_maintenance' // En travaux/réparation
            ])->default('actif');
            
            // Disponibilité générale (peut être désactivé sans changer le statut)
            $table->boolean('disponible')->default(true);
            
            // === RELATIONS AVEC D'AUTRES TABLES ===
            // Lien vers le propriétaire du bien (table users)
            // onDelete('cascade') = si l'utilisateur est supprimé, ses biens aussi
            $table->foreignId('proprietaire_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // === MÉTADONNÉES ET STATISTIQUES ===
            // Compteur de vues (pour les statistiques)
            $table->integer('vues')->default(0);
            
            // Note moyenne des avis (calculée automatiquement)
            // decimal(3,2) = notes de 0.00 à 9.99
            $table->decimal('note_moyenne', 3, 2)->default(0);
            
            
            
            // === TIMESTAMPS AUTOMATIQUES ===
            // created_at et updated_at gérés automatiquement par Laravel
            $table->timestamps();
            
            // // === INDEX POUR OPTIMISER LES PERFORMANCES ===
            // // Index composé pour les recherches fréquentes par ville, type et statut
            // $table->index(['ville', 'type', 'statut'], 'idx_recherche_biens');
            
            // // Index pour les filtres de prix et capacité
            // $table->index(['prix_par_nuit', 'capacite_max'], 'idx_prix_capacite');
            
            // // Index pour les biens disponibles (requête très fréquente)
            // $table->index(['disponible', 'statut'], 'idx_disponibilite');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens');
    }
};
