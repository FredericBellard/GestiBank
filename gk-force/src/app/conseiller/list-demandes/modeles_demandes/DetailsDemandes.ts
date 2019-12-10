export class DetailsDemande{
    ref_demande : number;
    date_demande : string;
    type_compte : number;
    nom : string;
    prenom : string;
    num_rue : number;
    nom_rue : string;
    code_postal : number;
    ville : string;
    telephone : string;
    statut : string;
    nb_enfants : number;
    type_document : string;
    contenu_document : string; 
    
    constructor(ref_demande : number, date_demande : string, type_compte : number, nom : string, prenom : string, num_rue : number, nom_rue : string, code_postal : number, ville : string, telephone : string, statut : string, nb_enfants : number, type_document : string, contenu_document : string ){
        this.ref_demande = ref_demande;
        this.date_demande = date_demande;
        this.type_compte = type_compte;
        this.nom = nom;
        this.prenom = prenom;
        this.num_rue = num_rue;
        this.nom_rue = nom_rue;
        this.code_postal = code_postal;
        this.ville = ville;
        this.telephone = telephone;
        this.statut = statut;
        this.nb_enfants = nb_enfants;
        this.type_document = type_document;
        this.contenu_document = contenu_document;
    }
}