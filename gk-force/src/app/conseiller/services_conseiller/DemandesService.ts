import {HttpClient}  from "@angular/common/http";
import {Demande} from "../modeles_conseiller/demandes";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class DemandesService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/conseiller_demandes.php';

    constructor(private http: HttpClient){}

    findAll():Observable<Demande[]>
    {
        return this.http.get<Demande[]>(this.apiUrl);
    }
}