import {HttpClient}  from "@angular/common/http";
import {DetailsClient} from "../modeles_comptes_courants/DetailsClient";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class DetailsClientService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/details_clients.php';
    private getapiUrl='http://localhost/gkForce/details_clients.php';

    constructor(private http: HttpClient){}

    findAll():Observable<DetailsClient[]>
    {
        return this.http.get<DetailsClient[]>(this.apiUrl);
    }
    
    findClientbyIdCompte(idCompte):Observable<DetailsClient[]>
    {
        return this.http.get<DetailsClient[]>(this.getapiUrl+"/?id_compte="+idCompte);
    }
}