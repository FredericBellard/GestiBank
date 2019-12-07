export class GestionCompteClient
{
    nom : string;//user
    prenom : string;
    
    num_rue : number;//adresse
    nom_rue : string;
    code_postal : number;
    ville : string;

    id_compte : number;//compte
    rib : number;
    solde : number;
    type_compte : number;

    constructor(nom : string, prenom : string, num_rue : number, 
        nom_rue : string,code_postal : number, ville : string , 
        id_compte : number,  rib : number, solde : number,
        type_compte : number)
    {
        this.nom=nom;
        this.prenom=prenom;
        
        this.num_rue=num_rue;
        this.nom_rue=nom_rue;
        this.code_postal=code_postal;
        this.ville=ville;
    
        this.id_compte=id_compte;
        this.rib=rib;
        this.solde=solde;
        this.type_compte=type_compte;
    }
}