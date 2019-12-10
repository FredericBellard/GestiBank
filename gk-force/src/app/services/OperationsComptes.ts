export class OperationsComptes
{
    id_transaction : number;
    date_transaction : string;
    type_transaction : string;
    montant_transaction : number;
    id_compte : number;
    solde : number;

    constructor(id_transaction : number,date_transaction : string, type_transaction : string,
              montant_transaction : number, id_compte : number, solde : number)
    {
        this.id_transaction=id_transaction;
        this.date_transaction=date_transaction;
        this.type_transaction=type_transaction;
        this.montant_transaction=montant_transaction;
        this.id_compte=id_compte;
        this.solde=solde;
    }

}