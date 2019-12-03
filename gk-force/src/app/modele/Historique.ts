export class Historique
{
	id_histo:number;
	date_operation:string;
	nature_operation:string;
	debit:number; 
	credit:number;
	num_compte:number;
	num_transaction:number;

    constructor(id_histo:number,date_operation:string,nature_operation:string,debit:number,credit:number,num_compte:number,num_transaction:number)
    {
		this.id_histo=id_histo;
		this.date_operation=date_operation;
		this.nature_operation=nature_operation;
		this.debit=debit; 
		this.credit=credit;
		this.num_compte=num_compte;
		this.num_transaction=num_transaction;
    }
}