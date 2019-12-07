import {HttpClient}  from "@angular/common/http";
import {CompteRem} from "../modeles_conseiller/comptesRems";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class CptesRemsService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/conseiller_comptes_rems.php';

    constructor(private http: HttpClient){}

    findAll():Observable<CompteRem[]>
    {
        return this.http.get<CompteRem[]>(this.apiUrl);
    }
}