import {HttpClient}  from "@angular/common/http";
import {RefusCompteCourant} from "../modeles_traitements_demandes/RefusDemandeCompteCourant";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class RefusDemandeCompteCourantService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private delapiUrl='http://localhost/gkForce/traitement_demande_compte_courant.php';

    constructor(private http: HttpClient){}

    deleteDemande(refDemande):Observable<RefusCompteCourant[]>
    {
        return this.http.delete<RefusCompteCourant[]>(this.delapiUrl+"/?ref_demande="+refDemande);
    }
}