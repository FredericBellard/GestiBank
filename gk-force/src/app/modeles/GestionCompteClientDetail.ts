export class GestionCompteClientDetail
{
    date_transaction : string;
    type_transaction : string;
    montant_transaction : number;

    constructor(date_transaction:string, type_transaction:string, montant_transaction : number)
    {
        this.date_transaction=date_transaction;
        this.type_transaction=type_transaction;
        this.montant_transaction=montant_transaction;
    }
}