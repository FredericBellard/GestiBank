export class ValidationCompteCourant{
    ref_demande : number;
    date_demande : string;
	
    constructor(ref_demande : number, date_demande : string){
        this.ref_demande = ref_demande;
        this.date_demande = date_demande;
    }
}