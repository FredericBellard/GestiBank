import { Utilisateur } from './Utilisateur';

export class Conseiller
{ 
    id_conseiller : number = -1;
    mle_conseiller : number = -1;
    date_deb_contrat : string = '';
    id_user : number = -1;
    nom : string= '';
    prenom : string= '';
    email : string= '';
    pseudonyme : string= '';
    password : string= '';
    type: number =1;
    

    constructor(id_conseiller : number, mle_conseiller : number, date_deb_contrat : string, user : Utilisateur)
    {
        this.id_conseiller = id_conseiller;
        this.mle_conseiller = mle_conseiller;
        this.date_deb_contrat = date_deb_contrat;
        this.id_user = user.id_user;
        this.nom = user.nom;
        this.prenom = user.prenom;
        //...
    }
}