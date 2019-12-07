export class CompteCourant{
    id_compte : number;
    nom : string;
    prenom : string;
    date_creation : string;
    solde : number;
	
    constructor(id_compte : number, nom : string, prenom : string, date_creation : string, solde : number, ){
        this.id_compte = id_compte;
        this.nom = nom;
        this.prenom = prenom;
        this.date_creation = date_creation;
        this.solde = solde;
    }
}