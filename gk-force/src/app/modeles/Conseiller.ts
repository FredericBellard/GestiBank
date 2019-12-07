export class Conseiller
{ 
    id_conseiller : number;
    mle_conseiller : number;
    date_deb_contrat : string;
    id_user : number;

    constructor(id_conseiller : number, mle_conseiller : number, date_deb_contrat : string, id_user : number)
    {
        this.id_conseiller = id_conseiller;
        this.mle_conseiller = mle_conseiller;
        this.date_deb_contrat = date_deb_contrat;
        this.id_user = id_user;
    }
}