import {HttpClient}  from "@angular/common/http";
import {Conseiller} from "../modeles/Conseiller";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
// Classe qui va nous permettre d'aller récupérer les services
export class ConseillerService
{
    // Url qui nous permet de récupérer les services dans Postman : 
    private apiUrl='http://localhost/gkForce/conseiller.php';

    constructor(private http: HttpClient){}

    findAll():Observable<Conseiller[]>
    {
        return this.http.get<Conseiller[]>(this.apiUrl);
    }

}