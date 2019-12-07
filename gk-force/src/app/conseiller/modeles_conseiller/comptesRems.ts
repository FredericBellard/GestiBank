export class CompteRem{
    id_compte : number;
    nom : string;
    prenom : string;
    date_creation : string;
    taux_interet : number;
    facilite_caisse : number;
    montant_debit : number;                                                
    solde : number;
	
    constructor(id_compte : number, nom : string, prenom : string, date_creation : string, taux_interet : number, facilite_caisse : number, montant_debit : number, solde : number){
        this.id_compte = id_compte;
        this.nom = nom;
        this.prenom = prenom;
        this.date_creation = date_creation;
        this.taux_interet = taux_interet;
        this.facilite_caisse = facilite_caisse;
        this.montant_debit = montant_debit;                                                
        this.solde = solde;
    }
}