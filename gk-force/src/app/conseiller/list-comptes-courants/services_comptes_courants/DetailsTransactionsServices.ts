import {HttpClient}  from "@angular/common/http";
import {DetailsTransactions} from "../modeles_comptes_courants/DetailsTransactions";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class DetailsTransactionsService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/details_transactions.php';
    private getapiUrl='http://localhost/gkForce/details_transactions.php';

    constructor(private http: HttpClient){}

    findAll():Observable<DetailsTransactions[]>
    {
        return this.http.get<DetailsTransactions[]>(this.apiUrl);
    }
    
    findTransactionsbyIdCompte(idCompte):Observable<DetailsTransactions[]>
    {
        return this.http.get<DetailsTransactions[]>(this.getapiUrl+"/?id_compte="+idCompte);
    }
}