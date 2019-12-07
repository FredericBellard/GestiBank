export class Transaction
{
    id_transaction : number;
    date_transaction : string;
    type_transaction : number;
    montant_transaction : number;
    id_compte : number;

    constructor(id_transaction:number,date_transaction:string,
                type_transaction:number, montant_transaction : number, id_compte : number)
    {
        this.id_transaction=id_transaction;
        this.date_transaction=date_transaction;
        this.type_transaction=type_transaction;
        this.montant_transaction=montant_transaction;
        this.id_compte=id_compte;
    }
}
