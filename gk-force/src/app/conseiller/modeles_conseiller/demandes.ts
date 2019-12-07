export class Demande{
    ref_demande : number;
    date_demande : string;
    id_user : number;
    nom : string;
    prenom : string;
    type_compte : number;
	
    constructor(ref_demande : number, date_demande : string, id_user : number, nom : string, prenom : string, type_compte : number){
        this.ref_demande = ref_demande;
        this.date_demande = date_demande;
        this.id_user = id_user;
        this.nom = nom;
        this.prenom = prenom;
        this.type_compte = type_compte;
    }
}