<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Bien extends Model
{
    //
    use HasFactory;

    // === CONFIGURATION DU MODÈLE ===
    
    /**
     * Les attributs qui peuvent être assignés en masse (mass assignment)
     * Sécurité: seuls ces champs peuvent être remplis via create() ou fill()
     */
    protected $fillable = [
        // Informations générales
        'titre',
        'description',
        'type',
        
        // Tarification
        'prix_par_nuit',
        
        // Caractéristiques physiques
        'nb_chambres',
        'nb_lits',
        'superficie',
        
        // Localisation
        'adresse',
        'ville',
        'code_postal',
        
      
        
        // Statut et disponibilité
        'statut',
        'disponible',
        
        // Propriétaire
        'proprietaire_id',
    ];
    protected $casts = [
        'prix_par_nuit' => 'decimal:2',
        'superficie' => 'decimal:2',
        'disponible' => 'boolean',
        'statut'=> 'string',
    ];
    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }
    // public function images(): HasMany
    // {
    //     return $this->hasMany(BienImage::class)->orderBy('ordre');
    // }

    // public function imagePrincipale()
    // {
    //     return $this->hasOne(BienImage::class)->where('image_principale', true);
    // }
    // Scopes pour les requêtes fréquentes
    public function scopeDisponible($query)
    {
        return $query->where('disponible', true)->where('statut', 'actif');
    }

    public function scopeParVille($query, $ville)
    {
        return $query->where('ville', 'like', "%{$ville}%");
    }

    public function scopeParType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopePrixMax($query, $prix)
    {
        return $query->where('prix_par_nuit', '<=', $prix);
    }


    // Accesseurs
    public function getPrixFormatteAttribute()
    {
        return number_format($this->prix_par_nuit, 2) . ' DA';
    }

    public function getAdresseCompleteAttribute()
    {
        return "{$this->adresse}, {$this->ville} {$this->code_postal}, {$this->pays}";
    }

    public function getTypeFormatteAttribute()
    {
        $types = [
            'appartement' => 'Appartement',
            'maison' => 'Maison',
            'villa' => 'Villa',
            'studio' => 'Studio',
            'bureau' => 'Bureau',
            'local_commercial' => 'Local commercial',
        ];

        return $types[$this->type] ?? $this->type;
    }

    // Méthodes utiles
    public function estDisponible($dateDebut = null, $dateFin = null)
    {
        if (!$this->disponible || $this->statut !== 'actif') {
            return false;
        }

        // Si pas de dates spécifiées, juste vérifier le statut général
        if (!$dateDebut || !$dateFin) {
            return true;
        }

        // Vérifier les réservations existantes (sera implémenté plus tard)
        return true;
    }

    public function incrementerVues()
    {
        $this->increment('vues');
    }

    public function calculerPrixTotal($dateDebut, $dateFin)
    {
        $jours = \Carbon\Carbon::parse($dateDebut)->diffInDays(\Carbon\Carbon::parse($dateFin));
        return $this->prix_par_nuit * $jours;
    }
}
