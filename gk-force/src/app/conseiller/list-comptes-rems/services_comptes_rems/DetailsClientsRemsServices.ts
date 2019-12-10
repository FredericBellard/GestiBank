import {HttpClient}  from "@angular/common/http";
import {DetailsClientRem} from "../modeles_comptes_rems/DetailsClientsRem";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class DetailsClientRemService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/details_clients_rem.php';
    private getapiUrl='http://localhost/gkForce/details_clients_rem.php';

    constructor(private http: HttpClient){}

    findAll():Observable<DetailsClientRem[]>
    {
        return this.http.get<DetailsClientRem[]>(this.apiUrl);
    }

    findClientRembyIdCompte(idCompteRem):Observable<DetailsClientRem[]>
    {
        return this.http.get<DetailsClientRem[]>(this.getapiUrl+"/?id_compte_rem="+idCompteRem);
    }
}