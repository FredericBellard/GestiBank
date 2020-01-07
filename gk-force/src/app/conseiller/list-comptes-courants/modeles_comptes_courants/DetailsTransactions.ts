export class DetailsTransactions{
    numero_compte : number;
    date_transaction : string;
    type_transaction : string;
    montant_transaction : string;
    nom : string;
    prenom : string;
	
    constructor(numero_compte : number, date_transaction : string, type_transaction : string, montant_transaction : string, nom : string, prenom : string){
        this.numero_compte = numero_compte;
        this.date_transaction = date_transaction;
        this.type_transaction = type_transaction;
        this.montant_transaction = montant_transaction;
        this.nom = nom;
        this.prenom = prenom;
    }
}