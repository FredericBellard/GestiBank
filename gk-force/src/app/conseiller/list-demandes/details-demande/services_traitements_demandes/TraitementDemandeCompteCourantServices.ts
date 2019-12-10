import {HttpClient}  from "@angular/common/http";
import {ValidationCompteCourant} from "../modeles_traitements_demandes/TraitementDemandeCompteCourant";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class TraitementDemandeCompteCourantService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/traitement_demande_compte_courant.php';
    private getapiUrl='http://localhost/gkForce/traitement_demande_compte_courant.php';

    constructor(private http: HttpClient){}

    findAll():Observable<ValidationCompteCourant[]>
    {
        return this.http.get<ValidationCompteCourant[]>(this.apiUrl);
    }

    findValidation(refDemande):Observable<ValidationCompteCourant[]>
    {
        return this.http.get<ValidationCompteCourant[]>(this.getapiUrl+"/?ref_demande="+refDemande);
    }

}