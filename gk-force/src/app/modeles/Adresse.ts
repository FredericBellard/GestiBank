export class Adresse
{ 
    id_adresse : number;
    num_rue : number;
    nom_rue : string;
    code_postal : number;
    ville : number;
    id_user : number;

    constructor(id_adresse : number, num_rue : number, nom_rue : string, code_postal : number, 
                ville : number, id_user : number)
    {
        this.id_adresse=id_adresse;
        this.num_rue=num_rue;
        this.nom_rue=nom_rue;
        this.code_postal=code_postal;
        this.ville=ville;
        this.id_user=id_user;
    }
}