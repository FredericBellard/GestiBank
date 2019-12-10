export class DetailsClient{
    numero_compte : number;
    date_creation : string;
    nom : string;
    prenom : string;
    num_rue : number;
    nom_rue : string;
    code_postal : number;
    ville : string;
    telephone : string;
    statut : string;
    nb_enfants : number;
    solde : number;
	
    constructor(numero_compte : number, date_creation : string, nom : string, prenom : string, num_rue : number, nom_rue : string, code_postal : number, ville : string, telephone : string, statut : string, nb_enfants : number, solde : number, ){
        this.numero_compte = numero_compte;
        this.date_creation = date_creation;
        this.nom = nom;
        this.prenom = prenom;
        this.num_rue = num_rue;
        this.nom_rue = nom_rue;
        this.code_postal = code_postal;
        this.ville = ville;
        this.telephone = telephone;
        this.statut = statut;
        this.nb_enfants = nb_enfants;
        this.solde = solde;
    }
}