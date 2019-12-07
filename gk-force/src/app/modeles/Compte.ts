export class Compte
{ 
    id_compte : number;
    rib : number;
    date_creation : string;
    solde : number;
    type_compte : number;
    id_client : number;

    constructor(id_compte : number, rib : number, date_creation : string, 
                solde : number,type_compte : number,id_client : number)
    {
        this.id_compte = id_compte;
        this.rib = rib;
        this.date_creation = date_creation;
        this.solde = solde;
        this.type_compte = type_compte;
        this.id_client = id_client;
    }
}