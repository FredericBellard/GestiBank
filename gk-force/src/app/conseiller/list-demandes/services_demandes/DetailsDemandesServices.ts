import {HttpClient}  from "@angular/common/http";
import {DetailsDemande} from "../modeles_demandes/DetailsDemandes";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class DetailsDemandesService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/details_demandes_ouverture.php';
    private getapiUrl='http://localhost/gkForce/details_demandes_ouverture.php';

    constructor(private http: HttpClient){}

    findAll():Observable<DetailsDemande[]>
    {
        return this.http.get<DetailsDemande[]>(this.apiUrl);
    }
    
    findDemandebyRefDemande(refDemande):Observable<DetailsDemande[]>
    {
        return this.http.get<DetailsDemande[]>(this.getapiUrl+"/?ref_demande="+refDemande);
    }
}