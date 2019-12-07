import {HttpClient}  from "@angular/common/http";
import {CompteCourant} from "../modeles_conseiller/comptesCourants";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class CompteCourantService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/conseiller_comptes_courants.php';

    constructor(private http: HttpClient){}

    findAll():Observable<CompteCourant[]>
    {
        return this.http.get<CompteCourant[]>(this.apiUrl);
    }
}